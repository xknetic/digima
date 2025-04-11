<script setup>
// Layout
definePageMeta({
  layout: "guest-layout",
});

// Fetch user
const cookies = useCookie("auth_user_token");

// Fetching the API
const { data: items } = await useFetch("http://127.0.0.1:8000/api/Items");

const getItem = (id) => {
  return items.value ? items.value.find((item) => item.item_id === id) : null;
};

const cartData = ref([]);

onMounted(() => {
  const itemStorage = localStorage.getItem("cart");
  cartData.value = itemStorage ? JSON.parse(itemStorage) : [];
});

const increment = (index) => {
  cartData.value[index].quantity++;
  // console.log(cartData.value[index].quantity++)
  // updateLocalStorage();
  localStorage.setItem("cart", JSON.stringify(cartData.value));
};

const decrement = (index) => {
  if (cartData.value[index].quantity > 1) {
    cartData.value[index].quantity--;
    // updateLocalStorage();
    localStorage.setItem("cart", JSON.stringify(cartData.value));
  }
};

const subtotal = computed(() => {
  const total = cartData.value.reduce((sum, item) => {
    const product = getItem(item.item_id);
    return sum + (product?.item_price || 0) * item.quantity;
  }, 0);

  return Math.round(total * 100) / 100;
});

const deleteItemFromLocalStorage = (itemId) => {
  const storedItems = JSON.parse(localStorage.getItem("cart")) || [];

  const updatedItems = storedItems.filter((item) => item.item_id !== itemId);

  localStorage.setItem("cart", JSON.stringify(updatedItems));

  cartData.value = updatedItems; // update UI
};

const submitForm = async () => {
  try {
    for (const item of cartData.value) {
      const form = {
        item_id: item.item_id,
        cart_quantity: item.quantity,
        slot_id: 1,
      };

      const result = await $fetch("http://127.0.0.1:8000/api/Carts", {
        method: "POST",
        body: form,
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
  <!-- <div>
    <ul>
      <li v-for="(itemData, index) in cartData" :key="index">
        <div >
          <p>Name: {{ getItem(itemData.item_id)?.item_sku }}</p>
          <p>Description: {{ getItem(itemData.item_id)?.categories?.category_name }}</p>
          <button @click="deleteItemFromLocalStorage(id)">Delete</button>
          <p>Description: {{ itemData.quantity }}</p>
        </div>
      </li>
    </ul>
  </div> -->
  <div class="space-y-20">
    <div v-if="cartData[0]">
      <div class="flex justify-center space-x-10">
        <!-- Main -->
        <main class="">
          <p class="text-2xl font-medium">Cart</p>
          <div v-for="(itemData, index) in cartData" :key="index">
            <div class="space-y-2">
              <div class="flex justify-between space-x-2 gap-40">
                <div class="flex space-x-2">
                  <Logo class="w-auto h-40" />
                  <!-- Short Description -->
                  <div>
                    <p href="" class="text-base font-semibold">
                      {{ getItem(itemData.item_id)?.item_sku }}
                    </p>
                    <div
                      v-if="
                        getItem(itemData.item_id)?.categories?.category_name
                      "
                    >
                      <p class="text-md font-base text-gray-500">
                        {{
                          getItem(itemData.item_id)?.categories.category_name
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
                      <p class="text-md font-base text-gray-500">--</p>
                    </div>
                  </div>
                </div>
                <p class="text-md font-medium">
                  ₱ {{ getItem(itemData.item_id)?.item_price }}
                </p>
              </div>
              <!-- Quantity Buttons -->
              <div
                class="space-x-3 border border-gray-300 rounded-full flex items-center w-max"
              >
                <div v-if="itemData.quantity != 1">
                  <span>
                    <button
                      class="cursor-pointer rounded-full p-2 hover:bg-gray-200"
                      @click="decrement(index)"
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
                          d="M5 12h14"
                        />
                      </svg>
                    </button>
                  </span>
                </div>
                <div v-else>
                  <span>
                    <button
                      class="cursor-pointer rounded-full p-2 hover:bg-gray-200"
                      @click="deleteItemFromLocalStorage(itemData.item_id)"
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
                  </span>
                </div>

                <span> {{ itemData.quantity }} </span>

                <div>
                  <button
                    class="cursor-pointer rounded-full p-2 hover:bg-gray-200"
                    @click="increment(index)"
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
                        d="M12 4.5v15m7.5-7.5h-15"
                      />
                    </svg>
                  </button>
                </div>
              </div>

              <hr class="h-px w-full bg-slate-200 border-0" />
            </div>
          </div>

          <!--  -->
        </main>

        <!-- Sidebar -->
        <aside class="w-[25vw]">
          <div class="space-y-2">
            <p class="text-2xl font-medium">Summary</p>
            <div class="flex justify-between">
              <p class="text-lg font-medium">Subtotal</p>
              <p class="text-md font-base">₱ {{ subtotal }}</p>
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

            <div v-if="cookies">
              <PrimaryButton @click="submitForm">Checkout</PrimaryButton>
            </div>
            <div v-else class="space-y-2">
              <PrimaryButton>Guest Checkout</PrimaryButton>
              <NuxtLink to="/login">
                <PrimaryButton>Member Checkout</PrimaryButton>
              </NuxtLink>
            </div>
          </div>
        </aside>
      </div>
    </div>

    <div v-else>
      <div class="flex justify-center items-center my-50">
        <h1>You Don't Have Any Items In Your Cart</h1>
      </div>
    </div>

    <!-- You Might Also Like -->
    <div class="">
      <p class="text-2xl font-medium">You Might Also Like</p>
      <div class="flex space-x-4">
        <NuxtLink>
          <Card>
            <div class="flex flex-col space-y-4">
              <Logo class="w-auto h-50" />
              <div>
                <p class="text-lg font-bold">Pharma Zinc</p>
                <p class="text-md font-base text-gray-500">Trial Package</p>
                <p class="text-md font-medium">₱ 500.00</p>
              </div>
            </div>
          </Card>
        </NuxtLink>
      </div>
    </div>
  </div>
</template>
