<script setup>
import { ref } from "vue";

// Layout
definePageMeta({
  layout: "authenticated-layout",
  path: "/achieversreward",
});

// Fetching the API
const {
  data: rewardItems,
  error,
  refresh,
} = await useFetch("http://127.0.0.1:8000/api/RewardItems");

// Modal Scripts
const showModalAddProduct = ref(false);
const showModalAddMore = ref(false);
</script>

<template>
  <div class="bg-white min-w-full h-full p-6 rounded-md shadow-md">
    <div class="flex justify-between items-center">
      <h3 class="text-2xl font-semibold text-gray-800">Reward Items Lists</h3>

      <div class="flex items-center space-x-4">
        <!-- <SecondaryButton>
          <p class="text-xs font-medium">Add Items</p>
        </SecondaryButton> -->
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
            <th class="px-4 py-2 border-b border-slate-100">No.</th>
            <th class="px-4 py-2 border-b border-slate-100">Username</th>
            <th class="px-4 py-2 border-b border-slate-100">Full Name</th>
            <th class="px-4 py-2 border-b border-slate-100">Rank Name</th>
            <th class="px-4 py-2 border-b border-slate-100">Left Downline</th>
            <th class="px-4 py-2 border-b border-slate-100">Right Downline</th>
            <th class="px-4 py-2 border-b border-slate-100">Reward</th>
            <th class="px-4 py-2 border-b border-slate-100">status</th>
            <th class="px-4 py-2 border-b border-slate-100"></th>
          </tr>
        </thead>
        <tbody class="striped">
          <tr v-for="rewardItem in rewardItems" :key="rewardItem.id">
            <td
              class="px-4 py-2 border-b border-slate-200 font-medium text-gray-900"
            >
              {{ rewardItem.id }}
            </td>
            <td class="px-4 py-2 border-b border-slate-200">
              {{ rewardItem.username }}
            </td>
            <td class="px-4 py-2 border-b border-slate-200">
              {{ rewardItem.full_name }}
            </td>
            <td class="px-4 py-2 border-b border-slate-200">
              {{ rewardItem.contact_number }}
            </td>
            <td class="px-4 py-2 border-b border-slate-200">
              {{ rewardItem.item_number }}
            </td>
            <td class="px-4 py-2 border-b border-slate-200">
              {{ rewardItem.price }}
            </td>
            <td class="px-4 py-2 border-b border-slate-200">
              {{ rewardItem.claimed_at }}
            </td>
            <td class="px-4 py-2 border-b border-slate-200">
              {{ rewardItem.status }}
            </td>
            <td
              class="px-4 py-2 border-b border-slate-200 font-medium text-gray-900"
            >
              <button class="cursor-pointer" @click="showModalAddMore = true">
                More
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
