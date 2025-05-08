<script setup>
// Layout
definePageMeta({
  layout: "authenticated-layout",
  path: "/admin/marketingplan",
  middleware: "auth",
  name: "Marketing Plan",
});

// Get api exchange rates to btc only but can convert to usd then to php or any other currency
const { data: currency } = await useFetch('https://api.coingecko.com/api/v3/exchange_rates');

const currentCurrency = computed(() => {
  const usd = 1 / currency.value.rates.usd.value;
  const php = 1 / currency.value.rates.php.value;
  const currentValue = usd / php;
  return currentValue;
});

console.log(currency);
</script>

<template>
  <div>
    <CurrencyConfiguration convertFrom="php" convertTo="usd" />

    <!-- Table -->
    <div class="w-full mx-auto rounded-sm">
      <div class="px-4">
        <div class="overflow-x-auto">
          <table class="table-auto w-full">
            <thead
              class="text-sm font-medium bg-gray-50 border border-slate-200"
            >
              <tr>
                <th class="py-3 px-4 whitespace-normal">Complain Name</th>
                <th class="p-2 whitespace-normal">Earning Label</th>
                <th class="p-2 whitespace-normal">Genealogy Type</th>
                <th class="p-2 whitespace-normal">Trigger</th>
                <th class="p-2 whitespace-normal">Status</th>
                <th class="p-2 whitespace-normal"></th>
              </tr>
            </thead>
            <tbody class="text-sm text-center divide-y divide-slate-200">
              <tr >
                <td class="p-2 whitespace-normal">
                  
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
