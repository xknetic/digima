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

    <div class="flex justify-center items-center m-10">
      <div class="space-y-5">
        <div class="flex justify-between items-center">
          <div>
            <p class="font-semibold">Add Product</p>
            <span class="font-medium text-sm text-gray-700">Description</span>
          </div>
          <button
            @click="submitForm"
            class="cursor-pointer bg-black text-white px-4 py-1 text-sm font-semibold rounded-lg"
          >
            Add
          </button>
        </div>
        <Card>
          <div v-for="code in codes" :key="code.id">
            {{ code.inventories?.branches }}
          </div>

          <!-- <form @submit.prevent="submitForm">
            <div class="space-y-4">
              <div class="flex space-x-30 items-center justify-between">
                <div>
                  <InputLabel for="slot_username">Sponsor Username</InputLabel>
                  <span class="font-medium text-sm text-gray-700"
                    >Description</span
                  >
                </div>
                <TextInput
                  id="slot_username"
                  placeholder=""
                  v-model="form.slot_username"
                />
              </div>

              <hr class="h-px bg-gray-200 border-0" />

              <div class="flex space-x-10 items-center justify-between">
                <div>
                  <InputLabel for="username">Username</InputLabel>
                  <span class="font-medium text-sm text-gray-700"
                    >Description</span
                  >
                </div>
                <TextInput
                  id="username"
                  placeholder=""
                  v-model="form.username"
                />
              </div>

              <hr class="h-px bg-gray-200 border-0" />

              <div class="flex space-x-10 items-center justify-between">
                <div>
                  <InputLabel for="email">Email</InputLabel>
                  <span class="font-medium text-sm text-gray-700"
                    >Description</span
                  >
                </div>
                <TextInput
                  id="email"
                  placeholder=""
                  type="email"
                  v-model="form.email"
                />
              </div>

              <hr class="h-px bg-gray-200 border-0" />

              <div class="flex space-x-10 items-center justify-between">
                <div>
                  <InputLabel for="first_name">First Name</InputLabel>
                  <span class="font-medium text-sm text-gray-700"
                    >Description</span
                  >
                </div>
                <TextInput
                  id="first_name"
                  placeholder=""
                  v-model="form.first_name"
                />
              </div>

              <hr class="h-px bg-gray-200 border-0" />

              <div class="flex space-x-10 items-center justify-between">
                <div>
                  <InputLabel for="middle_name">Middle Name</InputLabel>
                  <span class="font-medium text-sm text-gray-700"
                    >Description</span
                  >
                </div>
                <TextInput
                  id="middle_name"
                  placeholder=""
                  v-model="form.middle_name"
                />
              </div>

              <hr class="h-px bg-gray-200 border-0" />

              <div class="flex space-x-10 items-center justify-between">
                <div>
                  <InputLabel for="last_name">Last Name</InputLabel>
                  <span class="font-medium text-sm text-gray-700"
                    >Description</span
                  >
                </div>
                <TextInput
                  id="last_name"
                  placeholder=""
                  v-model="form.last_name"
                />
              </div>

              <hr class="h-px bg-gray-200 border-0" />

              <div class="flex space-x-10 items-center justify-between">
                <div>
                  <InputLabel for="password">Password</InputLabel>
                  <span class="font-medium text-sm text-gray-700"
                    >Description</span
                  >
                </div>
                <TextInput
                  id="password"
                  placeholder=""
                  v-model="form.password"
                  type="password"
                />
              </div>
            </div>
          </form> -->
        </Card>
      </div>
    </div>
    <TextInput v-model="count" />
    <button @click="submitForm">Generate</button>
  </div>
</template>
