<script setup>
import { useRoute } from "vue-router";
// Layout
definePageMeta({
  layout: "guest-layout",
});

const route = useRoute();

// Fetching the API
const { data: items } = await useFetch("http://127.0.0.1:8000/api/Items");

const getItem = items.value.filter((item) => item.item_id == route.params.id);

console.log(getItem[0].item_sku);

const handleError = ref(null);
// Submit form for Add Member
const form = ref({
  item_id: getItem[0].item_id,
});

const submitForm = async (event) => {
  event.preventDefault();

  try {
    // Retrieve the existing item_ids from localStorage, or initialize as an empty array if not present
    let existingItemIds = JSON.parse(localStorage.getItem("item_ids")) || [];

    // Add the new item_id to the existing array
    existingItemIds.push(form.value.item_id);

    // Save the updated array back to localStorage
    localStorage.setItem("item_ids", JSON.stringify(existingItemIds));

    console.log("Form data saved to localStorage:", form.value.item_id);
  } catch (error) {
    // Handle error (if any occurs while saving to localStorage)
    handleError.value = "Error saving data to localStorage.";
    console.error("Error:", handleError.value);
  }
};
</script>

<template>
  <div class="flex flex-col space-y-20">
    <div
      class="flex justify-center items-center space-x-10"
      v-for="item in getItem"
      :key="item.id"
    >
      <div class="bg-white shadow-md rounded-lg p-4">
        <Logo />
      </div>
      <div class="flex flex-col space-y-10 w-lg">
        <div class="flex flex-col space-y-2">
          <a href="" class="text-base font-semibold">{{ item.item_type }}</a>
          <div>
            <p class="text-2xl font-bold">{{ item.item_sku }}</p>
            <!-- <p class="text-sm font-bold">1 Capsule</p> -->
          </div>
          <div class="flex flex-end text-lg justify-between">
            <p>₱ {{ item.item_price }}</p>
            <p>★★★★★</p>
          </div>
        </div>

        <div>
          <!-- <p class="text-base font-bold">{{ item_description }}</p> -->
          <hr class="h-px w-full my-2 bg-slate-200 border-0" />
          <p class="text-sm font-medium">
            {{ item.item_thumbnail }}
          </p>
        </div>

        <PrimaryButton> Add to Cart</PrimaryButton>
        <button @click="submitForm"> Add to Cart</button>
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
