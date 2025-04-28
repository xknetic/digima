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
const cookies = useCookie("auth_user_token");
const data = ref(null);

const result = await $fetch("http://127.0.0.1:8000/api/user", {
  headers: {
    Authorization: `Bearer ${cookies.value.token}`,
  },
});
data.value = result;

const itemsIndex = ref([]);

onMounted(() => {
  localStorage.removeItem("itemStorage");
  const itemStorage = localStorage.getItem("itemStorage");
  itemsIndex.value = itemStorage ? JSON.parse(itemStorage) : [];
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
    value: item,
  })),
]);

const form = ref({
  items: null,
  quantity: 1,
});

const submitForm = async (event) => {
  // event.preventDefault();
  const selectedItem = form.value.items;
  const itemInventory = inventories.value.find(
    (inv) => inv.inventory_item_id === selectedItem.item_id
  );

  const stock = itemInventory ? itemInventory.inventory_quantity : 0;
  const itemStorage = JSON.parse(localStorage.getItem("itemStorage")) || [];

  try {
    itemStorage.push({
      item: form.value.items,
      stock: stock,
      quantity: form.value.quantity,
      subtotal: form.value.items.item_price * form.value.quantity,
    });

    localStorage.setItem("itemStorage", JSON.stringify(itemStorage));
    itemsIndex.value = itemStorage;
    // const result = await useFetch("http://127.0.0.1:8000/api/Orders", {
    //   method: "POST",
    //   body: {
    //     slot_username: form.value.slot_username,
    //     slot_sponsor: form.value.slot_sponsor,
    //     email: form.value.email,
    //     password: form.value.password,
    //     first_name: form.value.first_name,
    //     middle_name: form.value.middle_name,
    //     last_name: form.value.last_name,
    //     code_id: form.value.code_id,
    //     slot_membership_id: form.value.slot_membership_id,
    //   },
    // });
    // console.log(result);
  } catch (error) {}
};

const updateQuantity = () => {
  itemsIndex.value.forEach((entry) => {
    entry.subtotal = entry.item.item_price * entry.quantity;
  });

  localStorage.setItem("itemStorage", JSON.stringify(itemsIndex.value));
};

const totalAmount = computed(() => {
  return itemsIndex.value.reduce((sum, item) => {
    return sum + item.item.item_price * item.quantity;
  }, 0);
});
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
              @selected="submitForm"
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
                        {{ item.item.item_sku }}
                      </td>
                      <td class="p-2 whitespace-normal">
                        {{ item.item.item_price }}
                      </td>
                      <td class="p-2 whitespace-normal flex justify-center">
                        <TextInput
                          class="w-15"
                          v-model.number="item.quantity"
                          @change="updateQuantity"
                          :value="item.quantity"
                        />
                      </td>
                      <td class="p-2 whitespace-normal">PHP No Discount</td>
                      <td class="p-2 whitespace-normal">₱ {{ item.subtotal.toFixed(2) }}</td>
                      <td class="p-2 whitespace-normal">{{ item.stock }}</td>
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
        <div class="space-y-4">
          <Card>
            <div class="grid grid-cols-2 items-center">
              <div>
                <InputLabel for="sales_person">Sales Person</InputLabel>
                <!-- <span class="font-medium text-sm text-gray-700">Description</span> -->
              </div>
              <TextInput
                id="sales_person"
                :value="data.first_name"
                :disabled="true"
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
                <TextInput
                  id="sales_person"
                  :value="data.first_name"
                  :disabled="true"
                />
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
                  placeholder="Select a Type"
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
                  placeholder="Select a Type"
                />
              </div>

              <div class="grid grid-cols-2 items-center">
                <span class="font-semibold text-md">Subtotal</span>
                <span class="font-medium text-sm">P 123.00</span>
              </div>

              <div class="grid grid-cols-2 items-center">
                <span class="font-semibold text-md">TOTAL</span>
                <span class="font-medium text-sm">P 123.00</span>
              </div>
            </div>
          </Card>

          <Card>
            <div class="space-y-2">
              <div class="space-y-2 items-center justify-between">
                <div>
                  <InputLabel for="item_inclusion_details"> Remarks</InputLabel>
                </div>
                <TextAreaInput id="item_inclusion_details" placeholder="" />
              </div>

              <PrimaryButton> Process Sale </PrimaryButton>
            </div>
          </Card>
        </div>
      </aside>
    </div>
  </div>
</template>
