<script setup>
// Layout
definePageMeta({
  layout: "authenticated-layout",
  path: "/admin/product",
  name: "Product",
  middleware: "auth",
});

// Fetching the API
const { data: items } = await useFetch("http://127.0.0.1:8000/api/Items");

const itemsPerPage = 10;
const {
  currentPage,
  totalPages,
  paginatedItems,
  secondPage,
  nextPage,
  prevPage,
  firstPage,
  lastPage,
} = usePagination(items, itemsPerPage);
</script>

<template>
  <div>
    <ProductNavigation />

    <!-- Table -->
    <div class="w-full mx-auto rounded-sm">
      <div class="px-4">
        <div class="overflow-x-auto">
          <table class="table-auto w-full">
            <thead
              class="text-sm font-medium bg-gray-50 border border-slate-200"
            >
              <tr>
                <th class="py-3 px-4 whitespace-normal">Product SKU</th>
                <th class="p-2 whitespace-normal">Product Description</th>
                <th class="p-2 whitespace-normal">Type</th>
                <th class="p-2 whitespace-normal">Category</th>
                <th class="p-2 whitespace-normal">Sub-Category</th>
                <th class="p-2 whitespace-normal">Item-Charged</th>
                <th class="p-2 whitespace-normal">Price</th>
                <th class="p-2 whitespace-normal"></th>
              </tr>
            </thead>
            <tbody class="text-sm text-center divide-y divide-slate-200">
              <tr v-for="item in paginatedItems" :key="item.item_id">
                <td class="p-2 whitespace-normal">
                  {{ item.item_sku }}
                </td>
                <td class="p-2 whitespace-normal">
                  {{ item.item_description }}
                </td>
                <td class="p-2 whitespace-normal">
                  {{ item.item_type }}
                </td>
                <td class="p-2 whitespace-normal">
                  {{ item.item_category }}
                </td>
                <td class="p-2 whitespace-normal">
                  {{ item.item_sub_category }}
                </td>
                <td class="p-2 whitespace-normal">
                  {{ item.item_charged }}
                </td>
                <td class="p-2 whitespace-normal">
                  {{ item.item_price }}
                </td>
                <td class="p-2 whitespace-normal">
                  <Dropdown
                    :align="'right'"
                    :width="'48'"
                    contentClasses="bg-white"
                  >
                    <!-- Trigger Slot -->
                    <template #trigger>
                      <button
                        class="cursor-pointer hover:bg-slate-200 px-2 py-1 rounded-lg flex space-x-2 items-center"
                      >
                        More
                      </button>
                    </template>

                    <!-- Content Slot -->
                    <template #content>
                      <div>
                        <hr class="h-px my-1 bg-gray-200 border-0" />

                        <div class="px-1 pb-1">
                          <NuxtLink
                            :to="`/admin/products/inventoryandcodes/${item.item_id}`"
                          >
                            Inventory And Codes
                          </NuxtLink>
                        </div>
                      </div>
                    </template>
                  </Dropdown>
                </td>
              </tr>
            </tbody>
          </table>
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
      </div>
    </div>
  </div>
</template>
