<script setup>
// Layout
definePageMeta({
  layout: "authenticated-layout",
  middleware: "auth",
  path: "/admin/product/inventoryandcodes",
  name: "Inventory And Codes",
});

// Fetching the API
const { data: codes } = await useFetch("http://127.0.0.1:8000/api/Codes");

const count = ref("");

const submitForm = async (event) => {
  event.preventDefault();

  for (let counter = 1; counter <= count.value; counter++) {
    const result = await $fetch("http://127.0.0.1:8000/api/Codes", {
      method: "POST",
    });
    console.log(result);
  }
};
</script>

<template>
  <div>
    <ProductNavigation />

    <div>
      
    </div>
    <TextInput v-model="count" />
    <button @click="submitForm">Generate</button>
  </div>
</template>
