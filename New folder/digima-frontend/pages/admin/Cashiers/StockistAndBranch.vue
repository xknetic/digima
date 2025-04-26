<script setup>
// Layout
definePageMeta({
  layout: "authenticated-layout",
  path: "/admin/stockistandbranches",
  name: "Stockist/Branches",
  middleware: "auth",
});

// Fetching the API
const { data: paymentmethods } = await useFetch(
  "http://127.0.0.1:8000/api/PaymentMethods"
);

// const form = ref({
//   payment_method_status: false,
// });

const submitForm = async (paymentmethod) => {
  // event.preventDefault();
  // console.log(paymentmethod);
  try {
    const result = await $fetch(
      `http://127.0.0.1:8000/api/PaymentMethods/${paymentmethod.payment_method_id}`,
      {
        method: "PUT",
        body: {
          payment_method_status: paymentmethod.payment_method_status,
        },
      }
    );
    console.log(result);
  } catch (error) {
    console.error(error);
  }
};

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
} = usePagination(paymentmethods, itemsPerPage);

const showPaymentMethod = ref(false);
</script>

<template>
  <div>
    <SecondaryButton @click="showPaymentMethod = true">
      <p class="text-xs font-medium">Cashier Payment Methods</p>
    </SecondaryButton>

    <!-- Table -->

    <Modal :show="showPaymentMethod" @close="showPaymentMethod = false">
      <div class="bg-white p-4 rounded-lg">
        <form @submit.prevent="submitForm">
          <!-- Table -->
          <div class="w-full mx-auto rounded-sm">
            <div class="px-4">
              <div class="overflow-x-auto">
                <table class="table-auto w-full">
                  <thead
                    class="text-sm font-medium bg-gray-50 border border-slate-200"
                  >
                    <tr>
                      <th class="py-3 px-4 whitespace-normal">
                        Payment Method
                      </th>
                      <th class="p-2 whitespace-normal">Status</th>
                      <th class="p-2 whitespace-normal"></th>
                    </tr>
                  </thead>
                  <tbody class="text-sm text-center divide-y divide-slate-200">
                    <tr
                      v-for="paymentmethod in paginatedItems"
                      :key="paymentmethod.payment_method_id"
                    >
                      <td class="p-2 whitespace-normal">
                        {{ paymentmethod.payment_method_name }}
                      </td>
                      <td class="p-2 whitespace-normal">
                        <input
                          type="checkbox"
                          v-model="paymentmethod.payment_method_status"
                          :true-value="1"
                          :false-value="0"
                          @click="submitForm(paymentmethod)"
                        />
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

          <button
            @click="submitForm(payment_method_id)"
            class="cursor-pointer bg-black text-white px-4 py-1 text-sm font-semibold rounded-lg"
          >
            Update
          </button>
        </form>
      </div>
    </Modal>
  </div>
</template>
