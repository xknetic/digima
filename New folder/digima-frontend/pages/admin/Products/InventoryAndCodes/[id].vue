<script setup>
import { useRoute } from "vue-router";

const route = useRoute();
const itemId = route.params.id;

// Layout
definePageMeta({
  layout: "authenticated-layout",
  middleware: "auth",
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

    <div class="flex justify-center items-center m-10">
      <div class="space-y-5">
        <div class="flex justify-between items-center">
          <div>
            <p class="font-semibold">Generate Code</p>
            <span class="font-medium text-sm text-gray-700">Description</span>
          </div>
          <button
            @click="submitForm"
            class="cursor-pointer bg-black text-white px-4 py-1 text-sm font-semibold rounded-lg"
          >
            Generate
          </button>
        </div>
        <Card>
          <div v-for="code in codes" :key="code.id">
            {{ code.inventories?.branches }}
          </div>

          <form @submit.prevent="submitForm">
            <div class="space-y-4">
              <div class="flex space-x-30 items-center justify-between">
                <div>
                  <InputLabel for="generateCode">Generate Code</InputLabel>
                  <span class="font-medium text-sm text-gray-700"
                    >Description</span
                  >
                </div>
                <TextInput id="generateCode" placeholder="" v-model="count" />
              </div>
            </div>
          </form>
        </Card>

        <div class="flex justify-between items-center">
          <div>
            <p class="font-semibold">Code List</p>
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
                      <th class="p-2 whitespace-normal">Code</th>
                      <th class="p-2 whitespace-normal">Pin</th>
                      <th class="p-2 whitespace-normal">Sold To</th>
                      <th class="p-2 whitespace-normal">Transfer To</th>
                      <th class="p-2 whitespace-normal">Used To</th>
                      <th class="p-2 whitespace-normal"></th>
                    </tr>
                  </thead>
                  <tbody class="text-sm text-center divide-y divide-slate-200">
                    <tr v-for="code in codes" :key="code.id">
                      <td class="p-2 whitespace-normal">
                        {{ code.code_activation }}
                      </td>
                      <td class="p-2 whitespace-normal">
                        {{ code.code_pin }}
                      </td>
                      <td class="p-2 whitespace-normal">
                        {{ code.code_sold_to }}
                      </td>
                      <td class="p-2 whitespace-normal">
                        {{ code.org_code_sold_to }}
                      </td>
                      <td class="p-2 whitespace-normal">
                        {{ code.code_slot_used }}
                      </td>
                      <td class="p-2 whitespace-normal">
                        
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </Card>
      </div>
    </div>
  </div>
</template>
