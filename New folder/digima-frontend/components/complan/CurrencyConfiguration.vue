<script setup>
// const props = defineProps({
//   convertFrom: {
//     type: String,
//     default: "usd",
//   },
//   convertTo: {
//     type: String,
//     default: "php",
//   },
// });

// Fetch exchange rates from CoinGecko
// const { data: currency } = await useFetch(
//   "https://api.coingecko.com/api/v3/exchange_rates"
// );

// Compute the conversion value
// const currentCurrency = computed(() => {
//   if (!currency.value || !currency.value.rates) return null;

//   const fromRate = currency.value.rates[props.convertFrom]?.value;
//   const toRate = currency.value.rates[props.convertTo]?.value;

//   if (!fromRate || !toRate) return null;

//   return fromRate / toRate;
// });

const currency = ref([]);
const selectedBuyingId = ref(null);
const selectedDefaultId = ref(null);

onMounted(async () => {
  const result = await $fetch("http://127.0.0.1:8000/api/Currencies");
  currency.value = result;

  // Set initial selected IDs based on loaded data
  const buying = currency.value.find((c) => c.currency_buying === 1);
  const defaultCurrency = currency.value.find((c) => c.currency_default === 1);
  if (buying) selectedBuyingId.value = buying.currency_id;
  if (defaultCurrency) selectedDefaultId.value = defaultCurrency.currency_id;
});

const submitForm = async (currencies) => {
  try {
    await $fetch(
      `http://127.0.0.1:8000/api/Currencies/${currencies.currency_id}`,
      {
        method: "PUT",
        body: {
          currency_buying: currencies.currency_buying,
          currency_default: currencies.currency_default,
          currency_enable: currencies.currency_enable,
        },
      }
    );
  } catch (error) {
    console.error(error);
  }
};

const handleBuyingChange = (currencies) => {
  currency.value.forEach((c) => {
    c.currency_buying = c.currency_id === currencies.currency_id ? 1 : 0;
  });
  selectedBuyingId.value = currencies;
  const selectedCurrency = currency.value.find(
    (c) => c.currency_id === currencies.currency_id
  );
  if (selectedCurrency) submitForm(selectedCurrency);
};

const handleDefaultChange = (currencies) => {
  currency.value.forEach((c) => {
    c.currency_default = c.currency_id === currencies.currency_id ? 1 : 0;
  });
  selectedDefaultId.value = currencies;
  const selectedCurrency = currency.value.find(
    (c) => c.currency_id === currencies.currency_id
  );
  if (selectedCurrency) submitForm(selectedCurrency);
};
</script>

<template>
  <div>
    <!-- <p v-if="currentCurrency !== null">
      {{ currentCurrency }}
    </p>
    <p v-else>Loading or invalid currency...</p> -->
    <div class="flex justify-between items-center">
      <div>
        <p class="font-semibold">Currency Configuration</p>
        <span class="font-medium text-sm text-gray-700">Description</span>
      </div>
      <button
        class="cursor-pointer bg-black text-white px-4 py-1 text-sm font-semibold rounded-lg"
      >
        Add Currency
      </button>
    </div>

    <!-- Table -->
    <Card>
      <form @submit.prevent="submitForm">
        <div class="w-full mx-auto rounded-sm">
          <div class="px-4">
            <div class="overflow-x-auto">
              <table class="table-auto w-full">
                <thead
                  class="text-sm font-medium bg-gray-50 border border-slate-200"
                >
                  <tr>
                    <th class="py-3 px-4 whitespace-normal">Currency Name</th>
                    <th class="p-2 whitespace-normal">Currency for Buying</th>
                    <th class="p-2 whitespace-normal">Currency for Earning</th>
                    <th class="p-2 whitespace-normal">Currency Enable</th>
                  </tr>
                </thead>
                <tbody class="text-sm text-center divide-y divide-slate-200">
                  <tr
                    v-for="currencies in currency"
                    :key="currencies.currency_id"
                  >
                    <td class="p-2 whitespace-normal">
                      {{ currencies.currency_name }} ({{
                        currencies.currency_abbreviation
                      }})
                    </td>
                    <td class="p-2 whitespace-normal">
                      <input
                        type="radio"
                        v-model="currencies.currency_buying"
                        name="currency_buying"
                        :value="1"
                        @change="handleBuyingChange(currencies)"
                      />
                    </td>
                    <td class="p-2 whitespace-normal">
                      <input
                        type="radio"
                        v-model="currencies.currency_default"
                        name="currency_default"
                        :value="1"
                        @change="handleDefaultChange(currencies)"
                      />
                    </td>
                    <td class="p-2 whitespace-normal">
                      <input
                        type="checkbox"
                        v-model="currencies.currency_enable"
                        :true-value="1"
                        :false-value="0"
                        @change="submitForm(currencies)"
                      />
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </form>
    </Card>
  </div>
</template>
