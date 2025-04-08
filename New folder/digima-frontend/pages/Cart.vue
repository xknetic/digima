<script setup>
// Layout
definePageMeta({
  layout: "guest-layout",
});

// Fetch user
const cookies = useCookie("auth_user_token");

// Fetching the API
const { data: items } = await useFetch("http://127.0.0.1:8000/api/Items");

const count = ref(0);

function increment() {
  count.value++;
}

function decrement() {
  count.value--;
}

const storedItemIds = ref([]);

const fetchStoredItemIds = () => {
  const savedItemIds = JSON.parse(localStorage.getItem("item_ids")) || [];
  storedItemIds.value = savedItemIds;
};

onMounted(fetchStoredItemIds);

const getItem = (id) => {
  return items.value ? items.value.find((item) => item.item_id === id) : null;
};

// Function to delete an item ID from localStorage
const deleteItemFromLocalStorage = (id) => {
  // Remove the item ID from the storedItemIds array
  storedItemIds.value = storedItemIds.value.filter((itemId) => itemId !== id);

  // Update localStorage with the new list of item IDs
  localStorage.setItem("item_ids", JSON.stringify(storedItemIds.value));
};

const submitForm = async (event) => {
  event.preventDefault();

  if (!cookies) {
    console.log("success");
  } else {
    console.log("failed");
  }
};
</script>

<template>
  <!-- <div>
    <ul>
      <li v-for="(id, index) in storedItemIds" :key="index">
        <div >
          <p>Name: {{ getItem(id).item_sku }}</p>
          <p>Description: {{ getItem(id).categories.category_name }}</p>
          <button @click="deleteItemFromLocalStorage(id)">Delete</button>
        </div>
      </li>
    </ul>
  </div> -->
  <div class="space-y-20">
    <div class="flex justify-center space-x-10">
      <!-- Main -->
      <main class="">
        <p class="text-2xl font-medium">Cart</p>
        <div v-for="(id, index) in storedItemIds" :key="index">
          <div class="space-y-2">
            <div class="flex justify-between space-x-2 gap-40">
              <div class="flex space-x-2">
                <Logo class="w-auto h-40" />
                <!-- Short Description -->
                <div>
                  <p href="" class="text-base font-semibold">
                    {{ getItem(id).item_sku }}
                  </p>
                  <div v-if="getItem(id).categories.category_name">
                    <p class="text-md font-base text-gray-500">
                      {{ getItem(id).categories.category_name }}
                      <span v-if="getItem(id).subcategories?.sub_category_name">
                        > {{ getItem(id).subcategories?.sub_category_name }}
                      </span>
                    </p>
                  </div>
                  <div v-else>
                    <p class="text-md font-base text-gray-500">--</p>
                  </div>
                </div>
              </div>
              <p class="text-md font-medium">₱ {{ getItem(id).item_price }}</p>
            </div>
            <!-- Quantity Buttons -->
            <span
              class="space-x-3 border border-gray-300 rounded-full flex items-center"
            >
              <span>
                <button
                  class="cursor-pointer rounded-full p-2 hover:bg-gray-200"
                  @click="decrement"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    fill="currentColor"
                    class="bi bi-dash"
                    viewBox="0 0 16 16"
                  >
                    <path
                      d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8"
                    />
                  </svg>
                </button>
              </span>

              <span> {{ count ? count : "" }} </span>

              <div>
                <button
                  class="cursor-pointer rounded-full p-2 hover:bg-gray-200"
                  @click="increment"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    fill="currentColor"
                    class="bi bi-plus"
                    viewBox="0 0 16 16"
                  >
                    <path
                      d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"
                    />
                  </svg>
                </button>
              </div>
            </span>

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
            <p class="text-md font-base">₱ 500.00</p>
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
          <PrimaryButton>Guest Checkout</PrimaryButton>
          <PrimaryButton @click="submitForm">Member Checkout</PrimaryButton>
        </div>
      </aside>
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
