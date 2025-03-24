<script setup>
// Layout
definePageMeta({
  layout: "authenticated-layout",
  path: "/admin/product",
  name: "Product",
});

// Fetching the API
const { data: items } = await useFetch("http://127.0.0.1:8000/api/Items");
</script>

<template>
  <div>
    <ProductNavigation />

    <!-- Table -->
    <div class="w-full mx-auto rounded-sm mt-4">
      <div class="p-4">
        <div class="">
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
              <tr v-for="item in items" :key="item.id">
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
      </div>
    </div>
  </div>
</template>
