<script setup>
import { useRoute } from "vue-router";
import { ref, computed } from "vue";

const route = useRoute();
const itemId = route.params.id;

// Get id of branch
const props = defineProps({
  branchId: {
    type: Number,
    required: true,
  },
});
const { branchId } = props;

// Fetching the API
const { data: codes } = await useFetch("http://127.0.0.1:8000/api/Codes");

const form = ref({
  inventory_item_id: itemId,
  inventory_branch_id: branchId,
  inventory_quantity: "",
});

const submitForm = async (event) => {
  event.preventDefault();

  const result = await $fetch("http://127.0.0.1:8000/api/Codes", {
    method: "POST",
    body: {
      inventory_item_id: form.value.inventory_item_id,
      inventory_branch_id: form.value.inventory_branch_id,
      inventory_quantity: form.value.inventory_quantity,
    },
  });
  console.log(result);
};

console.log(codes);

// inventory Filter
const inventoryFilter = computed(() => {
  const seen = new Set();
  return codes.value.filter((code) => {
    if (code.inventories.branches.branch_id === branchId && !seen.has(code.code_id)) {
      seen.add(code.code_id);
      return true;
    }
    return false;
  });
});

const itemsPerPage = 5;
const {
  currentPage,
  totalPages,
  paginatedItems,
  nextPage,
  prevPage,
  secondPage,
  firstPage,
  lastPage,
} = usePagination(inventoryFilter, itemsPerPage);
</script>

<template>
  <div class="flex justify-between items-center">
    <div>
      <p class="font-semibold">Generate Code</p>
      <span class="font-medium text-sm text-gray-700">Description</span>
    </div>
    <button
      @click="submitForm"
      class="cursor-pointer bg-black text-white px-4 py-1 text-sm font-semibold rounded-lg"
    >
      Generate
    </button>
  </div>
  <Card>
    <form @submit.prevent="submitForm">
      <div class="space-y-4">
        <div class="flex space-x-30 items-center justify-between">
          <div>
            <InputLabel for="generateCode">Generate Code</InputLabel>
            <span class="font-medium text-sm text-gray-700">Description</span>
          </div>
          <TextInput
            id="generateCode"
            placeholder=""
            v-model="form.inventory_quantity"
          />
        </div>
      </div>
    </form>
  </Card>

  <div class="flex justify-between items-center">
    <div>
      <p class="font-semibold">Code List</p>
      <span class="font-medium text-sm text-gray-700">Description</span>
    </div>
  </div>
  <Card>
    <!-- Table -->
    <div class="w-full mx-auto rounded-sm">
      <div class="">
        <div class="">
          <table class="table-auto w-full">
            <thead
              class="text-sm font-medium bg-gray-50 border border-slate-200"
            >
              <tr>
                <th class="p-2 whitespace-normal">Code</th>
                <th class="p-2 whitespace-normal">Pin</th>
                <th class="p-2 whitespace-normal">Sold To</th>
                <th class="p-2 whitespace-normal">Transfer To</th>
                <th class="p-2 whitespace-normal">Used To</th>
                <th class="p-2 whitespace-normal"></th>
              </tr>
            </thead>
            <tbody class="text-sm divide-y divide-slate-200">
              <tr v-for="code in paginatedItems" :key="code.code_id">
                <td class="p-2 whitespace-normal">
                  {{ code?.code_activation }}
                </td>
                <td class="p-2 whitespace-normal">
                  {{ code?.code_pin }}
                </td>
                <td class="p-2 whitespace-normal">
                  {{ code?.code_sold_to }}
                </td>
                <td class="p-2 whitespace-normal">
                  {{ code?.org_code_sold_to }}
                </td>
                <td class="p-2 whitespace-normal">
                  {{ code?.users?.first_name }}
                  {{ code?.users?.last_name }}
                </td>
                <td class="p-2 whitespace-normal"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="flex justify-end items-center space-x-1">
      <button
        @click="firstPage"
        :disabled="currentPage === 1"
        class="cursor-pointer hover:bg-slate-200 p-1 rounded-lg flex space-x-2 items-center border border-slate-300"
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
            d="m18.75 4.5-7.5 7.5 7.5 7.5m-6-15L5.25 12l7.5 7.5"
          />
        </svg>
      </button>

      <button
        @click="prevPage"
        :disabled="currentPage === 1"
        class="cursor-pointer hover:bg-slate-200 p-1 rounded-lg flex space-x-2 items-center border border-slate-300"
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
            d="M15.75 19.5 8.25 12l7.5-7.5"
          />
        </svg>
      </button>

      <button
        :disabled="currentPage"
        class="hover:bg-slate-200 px-[10px] py-[2px] rounded-lg flex space-x-2 items-center border border-slate-300"
      >
        {{ currentPage }}
      </button>

      <button
        @click="nextPage"
        :disabled="currentPage === totalPages"
        class="cursor-pointer hover:bg-slate-200 px-[10px] py-[2px] rounded-lg flex space-x-2 items-center border border-slate-300"
      >
        {{ secondPage }}
      </button>

      <button
        @click="nextPage"
        :disabled="currentPage === totalPages"
        class="cursor-pointer hover:bg-slate-200 p-1 rounded-lg flex space-x-2 items-center border border-slate-300"
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
            d="m8.25 4.5 7.5 7.5-7.5 7.5"
          />
        </svg>
      </button>

      <button
        @click="lastPage"
        :disabled="currentPage === totalPages"
        class="cursor-pointer hover:bg-slate-200 p-1 rounded-lg flex space-x-2 items-center border border-slate-300"
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
            d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5"
          />
        </svg>
      </button>
    </div>
  </Card>
</template>
