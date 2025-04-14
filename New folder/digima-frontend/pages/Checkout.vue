<script setup>
// Layout
definePageMeta({
  layout: "guest-layout",
});

// Fetch user
const cookies = useCookie("auth_user_token");

// Fetching the API
const { data: items } = await useFetch("http://127.0.0.1:8000/api/Items");
const { data: carts } = await useFetch("http://127.0.0.1:8000/api/Carts");

const getItem = (id) => {
  return items.value ? items.value.find((item) => item.item_id === id) : null;
};

const cartData = ref([]);

onMounted(() => {
  const itemStorage = localStorage.getItem("cart");
  cartData.value = itemStorage ? JSON.parse(itemStorage) : [];
});

const increment = async (itemData, index) => {
  cartData.value[index].cart_quantity++;
  // updateLocalStorage();
  localStorage.setItem("cart", JSON.stringify(cartData.value));

  const getCartId = computed(() => {
    return carts.value.find((cart) => {
      return (
        cart.item_id === itemData.item_id && cart.slot_id === itemData.slot_id
      );
    });
  });

  const result = await $fetch(
    `http://127.0.0.1:8000/api/Carts/${getCartId.value.cart_id}`,
    {
      method: "PUT",
      body: {
        cart_quantity: cartData.value[index].cart_quantity,
      },
    }
  );
};

const decrement = async (itemData, index) => {
  if (cartData.value[index].cart_quantity > 1) {
    cartData.value[index].cart_quantity--;
    // updateLocalStorage();
    localStorage.setItem("cart", JSON.stringify(cartData.value));

    const getCartId = computed(() => {
      return carts.value.find((cart) => {
        return (
          cart.item_id === itemData.item_id && cart.slot_id === itemData.slot_id
        );
      });
    });

    const result = await $fetch(
      `http://127.0.0.1:8000/api/Carts/${getCartId.value.cart_id}`,
      {
        method: "PUT",
        body: {
          cart_quantity: cartData.value[index].cart_quantity,
        },
      }
    );
  }
};

const subtotalAllItems = computed(() => {
  const total = cartData.value.reduce((sum, item) => {
    const product = getItem(item.item_id);
    return sum + (product?.item_price || 0) * item.cart_quantity;
  }, 0);

  return Math.round(total * 100) / 100;
});

const deleteItemFromLocalStorage = async (itemData, itemId) => {
  const storedItems = JSON.parse(localStorage.getItem("cart")) || [];

  const updatedItems = storedItems.filter((item) => item.item_id !== itemId);

  localStorage.setItem("cart", JSON.stringify(updatedItems));

  cartData.value = updatedItems;

  const getCartId = computed(() => {
    return carts.value.find((cart) => {
      return (
        cart.item_id === itemData.item_id && cart.slot_id === itemData.slot_id
      );
    });
  });

  const result = await $fetch(
    `http://127.0.0.1:8000/api/Carts/${getCartId.value.cart_id}`,
    {
      method: "DELETE",
    }
  );
};

const submitForm = async () => {
  try {
    for (const item of cartData.value) {
      const getItem = items.value.find((item) => item.item_id === item.item_id);
      const subtotalPerItem = item.cart_quantity * getItem.item_price;

      const itemsForm = {
        item_id: item.item_id,
        quantity: item.cart_quantity,
        order_item_subtotal: subtotalPerItem,
        order_item_price: getItem.item_price,
      };

      const informationForm = {
        item_id: item.item_id,
        quantity: item.cart_quantity,
        order_item_subtotal: subtotalPerItem,
        order_item_price: getItem.item_price,
      };

      const result = await $fetch("http://127.0.0.1:8000/api/OrderItems", {
        method: "POST",
        body: itemsForm,
      });

      console.log("Submitted:", result);
      localStorage.clear();
    }
  } catch (error) {
    console.error("Submission failed:", error);
  }
};
</script>

<template>
  <div>
    <div class="space-y-20">
      <div class="flex justify-center space-x-10">
        <!-- Main -->
        <main class="">
          <p class="text-2xl font-base">Order Information</p>
          <form @submit.prevent="submitForm">
            <div class="space-y-10">
              <div>
                <div class="flex space-x-10 items-center justify-between">
                  <div>
                    <InputLabel for="first_name">First Name</InputLabel>
                    <TextInput id="first_name" placeholder="" />
                  </div>
                  <div>
                    <InputLabel for="last_name">Last Name</InputLabel>
                    <TextInput id="last_name" placeholder="" />
                  </div>
                </div>

                <div>
                  <InputLabel for="contact">Contacts</InputLabel>
                  <TextInput id="contact" placeholder="" />
                </div>

                <div>
                  <InputLabel for="address">Address</InputLabel>
                  <TextInput id="address" placeholder="" />
                </div>

                <div class="flex space-x-10 items-center justify-between">
                  <div>
                    <InputLabel for="province">State/Province</InputLabel>
                    <TextInput id="province" placeholder="" />
                  </div>
                  <div>
                    <InputLabel for="city">City Municipality</InputLabel>
                    <TextInput id="city" placeholder="" />
                  </div>
                </div>

                <div class="flex space-x-10 items-center justify-between">
                  <div>
                    <InputLabel for="postal">Postal Code</InputLabel>
                    <TextInput id="postal" placeholder="" />
                  </div>
                  <div>
                    <InputLabel for="barangay">Barangay/District</InputLabel>
                    <TextInput id="barangay" placeholder="" />
                  </div>
                </div>
              </div>

              <div>
                <NuxtLink>
                  <PrimaryButton>Place Order</PrimaryButton>
                </NuxtLink>
              </div>
            </div>
          </form>
        </main>

        <!-- Sidebar -->
        <aside class="">
          <div class="space-y-2">
            <p class="text-2xl font-base">Order Summary</p>

            <div class="flex justify-between">
              <p class="text-lg font-medium">Subtotal</p>
              <p class="text-md font-base">₱</p>
            </div>

            <div class="flex justify-between">
              <p class="text-lg font-medium">Shipping Fee</p>
              <p class="text-md font-base">₱ 85.00</p>
            </div>

            <hr class="h-px w-full bg-slate-200 border-0" />

            <div class="flex justify-between">
              <p class="text-lg font-medium">Total</p>
              <p class="text-md font-base">₱ 585.00</p>
            </div>

            <hr class="h-px w-full bg-slate-200 border-0" />

            <div>
              <div v-if="cartData[0]">
                <div class="flex justify-center">
                  <!-- Main -->
                  <main class="">
                    <div v-for="(itemData, index) in cartData" :key="index">
                      <div class="space-y-2">
                        <div class="flex justify-between space-x-2 gap-40">
                          <div class="flex space-x-2">
                            <Logo class="w-auto h-30" />
                            <!-- Short Description -->
                            <div>
                              <p href="" class="text-base font-semibold">
                                {{ getItem(itemData.item_id)?.item_sku }}
                              </p>
                              <div
                                v-if="
                                  getItem(itemData.item_id)?.categories
                                    ?.category_name
                                "
                              >
                                <p class="text-md font-base text-gray-500">
                                  {{
                                    getItem(itemData.item_id)?.categories
                                      .category_name
                                  }}
                                  <span
                                    v-if="
                                      getItem(itemData.item_id)?.subcategories
                                        ?.sub_category_name
                                    "
                                  >
                                    >
                                    {{
                                      getItem(itemData.item_id)?.subcategories
                                        ?.sub_category_name
                                    }}
                                  </span>
                                </p>
                              </div>
                              <div v-else>
                                <p class="text-md font-base text-gray-500">
                                  --
                                </p>
                              </div>
                              <p class="text-md font-base text-gray-500">
                                Qty {{ itemData.cart_quantity }}
                              </p>
                              <p class="text-md font-base text-gray-500">
                                ₱ {{ getItem(itemData.item_id)?.item_price }}
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </main>
                </div>
              </div>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </div>
</template>
