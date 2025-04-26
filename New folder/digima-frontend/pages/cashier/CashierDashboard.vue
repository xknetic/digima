<script setup>
// Layout
definePageMeta({
  layout: "cashier-layout",
  path: "/cashierdashboard",
  name: "Cashier",
  middleware: "cashier",
});

// Fetch user
const cookies = useCookie("auth_user_token");
const data = ref(null);

const result = await $fetch("http://127.0.0.1:8000/api/user", {
  headers: {
    Authorization: `Bearer ${cookies.value.token}`,
  },
});
data.value = result;

const itemPickedUp = ref([
  { label: "Yes", value: true },
  { label: "No", value: false },
]);

const vatable = ref([
  { label: "None", value: null },
  { label: "Inclusive", value: true },
  { label: "Exclusive", value: false },
]);
</script>

<template>
  <div>
    <div class="flex p-10">
      <!-- Main -->
      <main class="flex-1">
        <div class="">
          <div class="flex-1 overflow-auto">asd</div>
        </div>
      </main>

      <!-- Sidebar -->
      <aside>
        <Card>
          <div class="flex space-x-4 items-center">
            <div>
              <InputLabel for="sales_person">Sales Person</InputLabel>
              <!-- <span class="font-medium text-sm text-gray-700">Description</span> -->
            </div>
            <TextInput
              id="sales_person"
              :value="data.first_name"
              :disabled="true"
            />
          </div>

          <div class="flex space-x-4 items-center">
            <div>
              <InputLabel for="item_sku">Item Picked Up</InputLabel>
              <!-- <span class="font-medium text-sm text-gray-700">Description</span> -->
            </div>
            <Uselect
              id="type"
              :options="itemPickedUp"
              placeholder="Select a Type"
            />
          </div>

          <div class="flex space-x-4 items-center">
            <div>
              <InputLabel for="item_sku">VATable</InputLabel>
              <!-- <span class="font-medium text-sm text-gray-700">Description</span> -->
            </div>
            <Uselect id="type" :options="vatable" placeholder="Select a Type" />
          </div>
        </Card>

        <Card>
          <div class="flex space-x-4 items-center">
            <div>
              <InputLabel for="item_sku">VATable</InputLabel>
            </div>
            <Uselect
              id="type"
              :options="itemPickedUp"
              placeholder="Select a Type"
            />
          </div>
        </Card>
      </aside>
    </div>
  </div>
</template>
