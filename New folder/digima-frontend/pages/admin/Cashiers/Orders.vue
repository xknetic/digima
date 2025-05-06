<script setup>
// Layout
definePageMeta({
  layout: "authenticated-layout",
  path: "/admin/orders",
  name: "Orders",
  middleware: "auth",
});

const { data: orders } = await useFetch("http://127.0.0.1:8000/api/Orders");

const itemsPerPage = 10;
const {
  currentPage,
  totalPages,
  paginatedItems,
  nextPage,
  prevPage,
  secondPage,
  firstPage,
  lastPage,
} = usePagination(orders, itemsPerPage);
</script>

<template>
  <CashierNavigation />
  <!-- <OrdersNavigation /> -->

  <div>
    <!-- Table -->
    <div class="w-full mx-auto rounded-sm">
      <div class="px-4">
        <div class="overflow-x-auto">
          <table class="table-auto w-full">
            <thead
              class="text-sm font-medium bg-gray-50 border border-slate-200"
            >
              <tr>
                <th class="py-3 px-4 whitespace-normal">Order No.</th>
                <th class="p-2 whitespace-normal">Ordered items</th>
                <th class="p-2 whitespace-normal">Ordered Quantity</th>
                <th class="p-2 whitespace-normal">Username</th>
                <th class="p-2 whitespace-normal">Member Name</th>
                <th class="p-2 whitespace-normal">Receiver's Name</th>
                <th class="p-2 whitespace-normal">Receiver's Contact</th>
                <th class="p-2 whitespace-normal">Receiver's Email</th>
                <th class="p-2 whitespace-normal">Sponsor Username</th>
                <th class="p-2 whitespace-normal">Sponsor Name</th>
                <th class="p-2 whitespace-normal">Date Ordered</th>
                <th class="p-2 whitespace-normal">Total</th>
                <th class="p-2 whitespace-normal">Order Status</th>
                <th class="p-2 whitespace-normal">Order Type</th>
                <th class="p-2 whitespace-normal">Payment Method</th>
                <th class="p-2 whitespace-normal">Address</th>
                <th class="p-2 whitespace-normal">Claim Code</th>
                <th class="p-2 whitespace-normal"></th>
              </tr>
            </thead>
            <tbody class="text-sm text-center divide-y divide-slate-200">
              <tr v-for="order in paginatedItems" :key="order.order_id">
                <td class="p-2 whitespace-normal">
                  {{ order.order_id }}
                </td>
                <td class="p-2 whitespace-normal">

                </td>
                <td class="p-2 whitespace-normal">
                  <button
                    class="cursor-pointer hover:bg-slate-200 px-2 py-1 rounded-lg flex space-x-2 items-center"
                  >
                    More
                  </button>
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
