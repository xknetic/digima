<script setup>
const props = defineProps({
  convertFrom: {
    type: String,
    default: "usd",
  },
  convertTo: {
    type: String,
    default: "php",
  },
});

// Fetch exchange rates from CoinGecko
// const { data: currency } = await useFetch(
//   "https://api.coingecko.com/api/v3/exchange_rates"
// );
const { data: currency } = await useFetch(
  "http://127.0.0.1:8000/api/Currencies"
);

// Compute the conversion value
// const currentCurrency = computed(() => {
//   if (!currency.value || !currency.value.rates) return null;

//   const fromRate = currency.value.rates[props.convertFrom]?.value;
//   const toRate = currency.value.rates[props.convertTo]?.value;

//   if (!fromRate || !toRate) return null;

//   return fromRate / toRate;
// });

const submitForm = async (currencies) => {
  try {
    const result = await $fetch(
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
</script>

<template>
  <div>
    <p v-if="currentCurrency !== null">
      {{ currentCurrency }}
    </p>
    <p v-else>Loading or invalid currency...</p>

    <!-- Table -->
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
                  <td class="p-2 whitespace-normal">{{ currencies.currency_name }} ({{ currencies.currency_abbreviation }})</td>
                  <td class="p-2 whitespace-normal">
                    <input
                      type="radio"
                      v-model="currencies.currency_buying"
                      name="currency_buying"
                      :value="1"
                      @change="submitForm(currencies)"
                    />
                  </td>
                  <td class="p-2 whitespace-normal">
                    <input
                      type="radio"
                      v-model="currencies.currency_default"
                      name="currency_default"
                      :checked="currencies.currency_default === 1"
                      @change="submitForm(currencies)"
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
  </div>
</template>
