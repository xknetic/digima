<script setup>

const props = defineProps({
    convertTo: {
      type: String,
      default: 'usd',
    },
    convertFrom: {
      type: String,
      default: 'php',
    },
  });

// Get api exchange rates to btc only but can convert to usd then to php or any other currency
const { data: currency } = await useFetch('https://api.coingecko.com/api/v3/exchange_rates');

const currentCurrency = computed(() => {
  const convertFrom = 1 / currency.value.rates.convertFrom.value;
  const convertTo = 1 / currency.value.rates.convertTo.value;
  const currentValue = convertFrom / convertTo;
  return currentValue;
});

console.log(currentCurrency);
</script>

<template>
  <div>
    <p v-if="currentCurrency !== null">
      {{ convertFrom.toUpperCase() }} to {{ convertTo.toUpperCase() }}: {{ currentCurrency }}
    </p>
    <p v-else>
      Loading or invalid currency...
    </p>
  </div>
</template>
