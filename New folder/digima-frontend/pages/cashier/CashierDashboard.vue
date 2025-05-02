<script setup>
// Layout
definePageMeta({
  layout: "cashier-layout",
  path: "/cashierdashboard",
  name: "Cashier",
  middleware: "cashier",
});

// Fetch user
const { data: paymentmethods } = await useFetch(
  "http://127.0.0.1:8000/api/PaymentMethods"
);
const { data: items } = await useFetch("http://127.0.0.1:8000/api/Items");
const { data: inventories } = await useFetch(
  "http://127.0.0.1:8000/api/Inventories"
);
const { data: slots } = await useFetch("http://127.0.0.1:8000/api/Slots");
const cookies = useCookie("auth_user_token");
const data = ref({});

const result = await $fetch("http://127.0.0.1:8000/api/user", {
  headers: {
    Authorization: `Bearer ${cookies.value.token}`,
  },
});
data.value = result;

onMounted(() => {
  localStorage.removeItem("itemStorage");
});

const itemPickedUp = ref([
  { label: "Yes", value: true },
  { label: "No", value: false },
]);

const vatable = ref([
  { label: "None", value: null },
  { label: "Inclusive", value: true },
  { label: "Exclusive", value: false },
]);

const filteredPaymentMethods = computed(() =>
  paymentmethods.value.filter(
    (paymentmethod) => paymentmethod.payment_method_status
  )
);

const paymentmethod = ref([
  // { label: "None", value: null },
  ...filteredPaymentMethods.value.map((paymentmethod) => ({
    label: paymentmethod.payment_method_name,
    value: paymentmethod.payment_method_id,
  })),
]);

const filtereditems = ref([
  // { label: "None", value: null },
  ...items.value.map((item) => ({
    label: item.item_sku,
    value: item.item_id,
  })),
]);

const form = ref({
  items: null,
  quantity: "",
  buyer_slot_id: "",
});

const itemsIndex = ref([]);

const submitItems = () => {
  const itemInventory  = computed(() => {
    return inventories.value.find((inventory) => {
      return (
        inventory.items.item_id === form.value.items
      );
    });
  });

  const itemStorage = JSON.parse(localStorage.getItem("itemStorage")) || [];

  itemStorage.push({
    item_name: itemInventory.value.items.item_sku,
    item_price: itemInventory.value.items.item_price,
    stock: itemInventory.value.inventory_quantity,
    quantity: form.value.quantity,
    subtotal: itemInventory.value.items.item_price * form.value.quantity,
  });

  localStorage.setItem("itemStorage", JSON.stringify(itemStorage));
  itemsIndex.value = itemStorage;
};

const updateQuantity = () => {
  itemsIndex.value.forEach((entry) => {
    const inventory = inventories.value.find((inv) => inv.items.item_sku == entry.item_name);
    if (inventory) {
      entry.subtotal = inventory.items.item_price * entry.quantity;
    }
  });

  localStorage.setItem("itemStorage", JSON.stringify(itemsIndex.value));
};

const totalAmount = computed(() => {
  return itemsIndex.value.reduce((sum, item) => {
    const inventoryItem = inventories.value.find(inv => inv.items.item_sku == item.item_name);
    const price = inventoryItem?.items?.item_price || 0;
    return sum + price * item.quantity;
  }, 0);
});

const deleteItemFromLocalStorage = (itemToDelete) => {
  const storedItems = JSON.parse(localStorage.getItem("itemStorage")) || [];

  const updatedItems = storedItems.filter(
    (item) => item.item.item_id !== itemToDelete.item.item_id
  );

  localStorage.setItem("itemStorage", JSON.stringify(updatedItems));

  itemsIndex.value = updatedItems;
};

const getUsers = computed(() => {
  return slots.value?.filter((slot) => slot.slot_sponsor === null) || [];
});

const filteredUsers = ref([
  ...getUsers.value.map((getUser) => ({
    label: getUser.users.email,
    value: getUser,
  })),
]);

const submitForm = async (event) => {
  event.preventDefault();
  try {
    // console.log(itemsIndex.value);
    for (const item of itemsIndex.value) {
      const getItem = items.value.find((items) => items.item_sku === item.item_name);
      // console.log(item);

      const result = await $fetch("http://127.0.0.1:8000/api/Orders", {
        method: "POST",
        body: {
          item_id: getItem.item_id,
          quantity: item.quantity,
          order_item_subtotal: item.subtotal,
          order_item_price: item.item_price,
          buyer_slot_id: form.value.buyer_slot_id,
        },
      });

      console.log("Submitted:", result);
      localStorage.removeItem('cart');
    }
  } catch (error) {
    console.error("Submission failed:", error);
  }
};
</script>

<template>
  <div>
    <div class="flex p-10 space-x-4">
      <!-- Main -->
      <main class="flex-1">
        <div class="space-y-4">
          <div class="flex">
            <SelectMenu
              :options="filtereditems"
              v-model="form.items"
              @selected="submitItems"
              placeholder="Select membership package or product item"
            />
            <!-- <button @click="submitForm">asd</button> -->
          </div>

          <!-- Table -->
          <div class="w-full mx-auto rounded-sm">
            <div class="px-4">
              <div class="overflow-x-auto">
                <table class="table-auto w-full">
                  <thead
                    class="text-sm font-medium bg-gray-50 border border-slate-200"
                  >
                    <tr>
                      <th class="py-3 px-4 whitespace-normal">Item Name</th>
                      <th class="p-2 whitespace-normal">Price</th>
                      <th class="p-2 whitespace-normal">QTY</th>
                      <th class="p-2 whitespace-normal">Discount Per Item</th>
                      <th class="p-2 whitespace-normal">Amount</th>
                      <th class="p-2 whitespace-normal">In Stock</th>
                      <th class="p-2 whitespace-normal"></th>
                    </tr>
                  </thead>
                  <tbody class="text-sm text-center divide-y divide-slate-200">
                    <tr v-for="(item, index) in itemsIndex" :key="index">
                      <td class="p-2 whitespace-normal">
                        {{ item.item_name }}
                      </td>
                      <td class="p-2 whitespace-normal">
                        {{ item.item_price }}
                      </td>
                      <td class="p-2 whitespace-normal flex justify-center">
                        <TextInput
                          type="number"
                          class="w-15"
                          v-model="item.quantity"
                          @change="updateQuantity"
                          :min="0"
                          :max="item.stock"
                          :step="1"
                          :value="item.quantity"
                        />
                      </td>
                      <td class="p-2 whitespace-normal">PHP No Discount</td>
                      <td class="p-2 whitespace-normal">
                        ₱ {{ item.subtotal.toFixed(2) }}
                      </td>
                      <td class="p-2 whitespace-normal">{{ item.stock }}</td>
                      <td class="p-2 whitespace-normal">
                        <button
                          class="cursor-pointer rounded-full p-2 hover:bg-gray-200"
                          @click="deleteItemFromLocalStorage(item)"
                        >
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-5"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                            />
                          </svg>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </main>

      <!-- Sidebar -->
      <aside>
        <form @submit.prevent="submitForm">
          <div class="space-y-4">
            <Card>
              <div class="grid grid-cols-2 items-center">
                <div>
                  <InputLabel for="sales_person">Sales Person</InputLabel>
                  <!-- <span class="font-medium text-sm text-gray-700">Description</span> -->
                </div>
                <SelectMenu
                  :options="filteredUsers"
                  v-model="form.buyer_slot_id"
                  placeholder="Select Username"
                />
              </div>
            </Card>

            <Card>
              <div class="space-y-2">
                <div class="grid grid-cols-2 items-center">
                  <div>
                    <InputLabel for="sales_person">Sales Person</InputLabel>
                    <!-- <span class="font-medium text-sm text-gray-700">Description</span> -->
                  </div>
                  <TextInput id="sales_person" :value="data.first_name" />
                </div>

                <div class="grid grid-cols-2 items-center">
                  <div>
                    <InputLabel for="item_sku">Item Picked Up</InputLabel>
                    <!-- <span class="font-medium text-sm text-gray-700">Description</span> -->
                  </div>
                  <Uselect
                    id="type"
                    :options="itemPickedUp"
                    placeholder="Select a Type"
                  />
                </div>

                <div class="grid grid-cols-2 items-center">
                  <div>
                    <InputLabel for="item_sku">VATable</InputLabel>
                    <!-- <span class="font-medium text-sm text-gray-700">Description</span> -->
                  </div>
                  <Uselect
                    id="type"
                    :options="vatable"
                    placeholder="Select a VAT"
                  />
                </div>
              </div>
            </Card>

            <Card>
              <div class="space-y-2">
                <div class="grid grid-cols-2 items-center">
                  <div>
                    <InputLabel for="paymentmethod">Payment Method</InputLabel>
                  </div>
                  <Uselect
                    id="paymentmethod"
                    :options="paymentmethod"
                    placeholder="Select a Payment"
                  />
                </div>

                <div class="grid grid-cols-2 items-center">
                  <span class="font-semibold text-md">Subtotal</span>
                  <span class="font-medium text-sm"
                    >₱ {{ totalAmount.toFixed(2) }}</span
                  >
                </div>

                <div class="grid grid-cols-2 items-center">
                  <span class="font-semibold text-md">TOTAL</span>
                  <span class="font-medium text-sm"
                    >₱ {{ totalAmount.toFixed(2) }}</span
                  >
                </div>
              </div>
            </Card>

            <Card>
              <div class="space-y-2">
                <div class="space-y-2 items-center justify-between">
                  <div>
                    <InputLabel for="item_inclusion_details">
                      Remarks</InputLabel
                    >
                  </div>
                  <TextAreaInput id="item_inclusion_details" placeholder="" />
                </div>

                <PrimaryButton @click="submitForm"> Process Sale </PrimaryButton>
              </div>
            </Card>
          </div>
        </form>
      </aside>
    </div>
  </div>
</template>
