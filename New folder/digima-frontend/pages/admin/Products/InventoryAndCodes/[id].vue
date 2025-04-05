<script setup>
import { useRoute } from "vue-router";

const route = useRoute();
// const itemId = route.params.id;

// Layout
definePageMeta({
  layout: "authenticated-layout",
  middleware: "auth",
  name: "Inventory And Codes",
});

// Fetching the API
const { data: codes } = await useFetch("http://127.0.0.1:8000/api/Codes");
const { data: inventories } = await useFetch(
  "http://127.0.0.1:8000/api/Inventories"
);

const showModalMore = ref(false);

const branchId = ref(null);
const itemId = ref(null);

const openModal = (id) => {
  branchId.value = id;
  showModalMore.value = true;
};

// inventory Filter
const inventoryFilter = computed(() => {
  const seen = new Set();
  return inventories.value.filter((inventory) => {
    if (
      inventory.items.item_id == route.params.id &&
      !seen.has(inventory.inventory_id)
    ) {
      seen.add(inventory.inventory_id);
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
  secondPage,
  nextPage,
  prevPage,
  firstPage,
  lastPage,
} = usePagination(inventoryFilter, itemsPerPage);
</script>

<template>
  <div>
    <ProductNavigation />

    <div class="flex justify-center items-center m-10">
      <div class="space-y-5">
        <div class="flex justify-between items-center">
          <div>
            <p class="font-semibold">Inventory Per Branch</p>
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
                      <th class="p-2 whitespace-normal">Branch Name</th>
                      <th class="p-2 whitespace-normal">Location</th>
                      <th class="p-2 whitespace-normal">Type</th>
                      <th class="p-2 whitespace-normal">Quantity Sold</th>
                      <th class="p-2 whitespace-normal">Quantity Used</th>
                      <th class="p-2 whitespace-normal">Available</th>
                      <th class="p-2 whitespace-normal">Quantity Unclaimed</th>
                      <th class="p-2 whitespace-normal"></th>
                    </tr>
                  </thead>
                  <tbody class="text-sm divide-y divide-slate-200">
                    <tr
                      v-for="inventory in paginatedItems"
                      :key="inventory.inventory_id"
                    >
                      <td class="p-2 whitespace-normal">
                        {{ inventory.branches.branch_name }}
                      </td>
                      <td class="p-2 whitespace-normal">
                        {{ inventory.branches.branch_location }}
                      </td>
                      <td class="p-2 whitespace-normal">
                        {{ inventory.branches.branch_type }}
                      </td>
                      <td class="p-2 whitespace-normal">
                        <!-- {{ inventory.inventory_sold }} -->
                      </td>
                      <td class="p-2 whitespace-normal">106</td>
                      <td class="p-2 whitespace-normal">
                        {{ inventory.inventory_quantity }}
                      </td>
                      <td class="p-2 whitespace-normal">0</td>

                      <td class="p-2 whitespace-normal">
                        <button
                          class="cursor-pointer hover:bg-slate-200 px-2 py-1 rounded-lg flex space-x-2 items-center"
                          @click.prevent="
                            openModal(inventory.branches.branch_id)
                          "
                        >
                          Show Codes
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div
            v-if="paginatedItems == itemsPerPage"
            class="flex justify-end items-center space-x-1"
          >
            <button
              @click="firstPage"
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

            <div v-if="currentPage != totalPages">
              <button
                @click="nextPage"
                :disabled="currentPage === totalPages"
                class="cursor-pointer hover:bg-slate-200 px-[10px] py-[2px] rounded-lg flex space-x-2 items-center border border-slate-300"
              >
                {{ secondPage }}
              </button>
            </div>

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

        <Modal
          :show="showModalMore"
          @close="showModalMore = false"
          :closeable="true"
        >
          <div class="bg-white rounded-lg p-10 space-y-5">
            <GenerateCode :branchId="branchId" />
          </div>
        </Modal>
      </div>
    </div>
  </div>
</template>
