<script setup>
import { ref } from "vue";

// Layout
definePageMeta({
  layout: "authenticated-layout",
  path: "/rewardpoints",
});

// Fetching the API
const {
  data: rewardItems,
  error,
  refresh,
} = await useFetch("http://127.0.0.1:8000/api/RewardItems");

// Modal Scripts
const showModalAddItem = ref(false);

// Submit form for Add Item
const form = ref({
  item_name: "",
  price: "",
  thumbnail: "",
});

const submitForm = async (event) => {
  event.preventDefault();
  const { data, error: fetchError } = await useFetch(
    "http://127.0.0.1:8000/api/RewardItems",
    {
      method: "POST",
      body: JSON.stringify({
        item_name: form.value.item_name,
        price: form.value.price,
        thumbnail: form.value.thumbnail,
      }),
      headers: {
        "Content-Type": "application/json",
      },
    }
  );
};
</script>

<template>
  <div class="bg-white min-w-full h-full p-6 rounded-md shadow-md">
    <div class="flex justify-between items-center">
      <h3 class="text-2xl font-semibold text-gray-800">Reward Items Lists</h3>

      <div class="flex items-center space-x-4">
        <SecondaryButton @click="showModalAddItem = true">
          <p class="text-xs font-medium">Add Items</p>
        </SecondaryButton>
      </div>
    </div>
    <hr class="h-px my-3 bg-gray-200 border-0" />

    <!-- Bottom Table -->
    <div class="overflow-x-auto w-full rounded-md">
      <table
        class="min-w-full table-auto text-sm text-center border-collapse text-gray-600"
      >
        <thead class="bg-slate-100 text-gray-700">
          <tr>
            <th class="px-4 py-2 border-b border-slate-100">Item Name</th>
            <th class="px-4 py-2 border-b border-slate-100">Price</th>
            <th class="px-4 py-2 border-b border-slate-100"></th>
          </tr>
        </thead>
        <tbody class="striped">
          <tr v-for="rewardItem in rewardItems" :key="rewardItem.id">
            <td
              class="px-4 py-2 border-b border-slate-200 font-medium text-gray-900"
            >
              {{ rewardItem.item_name }}
            </td>
            <td class="px-4 py-2 border-b border-slate-200">
              {{ rewardItem.price }}
            </td>
            <td
              class="px-4 py-2 border-b border-slate-200 font-medium text-gray-900"
            >
              <button class="cursor-pointer" @click="showModalAddItem = true">
                More
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Modal For Add Member -->
    <Modal
      :show="showModalAddItem"
      @close="showModalAddItem = false"
      :closeable="true"
    >
      <div class="p-5 w-[50vh] bg-white rounded-md overflow-hidden shadow-xl">
        <h4>Add Item</h4>
        <hr class="h-px my-3 bg-gray-200 border-0" />
        <form class="flex flex-col" @submit="submitForm">
            <ImageUpload />
          <div>
            <!-- Slot Sponsor -->
            <InputLabel for="item_name">Item Name</InputLabel>
            <TextInput
              id="item_name"
              placeholder="Item Name"
              v-model="form.item_name"
            />
          </div>

          <div>
            <InputLabel for="price">Price</InputLabel>
            <TextInput id="price" placeholder="Price" v-model="form.price" />
          </div>

          <div class="flex justify-end items-center space-x-5">
            <SecondaryButton @click="showModalAddItem = false">
              Close
            </SecondaryButton>
            <SecondaryButton
              class="bg-[#f9601d] hover:bg-[#30b5bc]"
            >
              Add
            </SecondaryButton>
          </div>
        </form>
      </div>
    </Modal>
  </div>
</template>
