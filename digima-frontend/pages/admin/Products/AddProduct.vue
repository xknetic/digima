<script setup>
// Layout
definePageMeta({
  layout: "authenticated-layout",
  path: "/admin/product/addproduct",
  name: "Add Product",
});

// Submit form for Add Member
const form = ref({
  item_sku: "",
  item_thumbnail: "",
  item_description: "",
  item_inclusion_details: "",
  item_barcode: "",
  item_price: "",
  item_charged: "",
  qty_charged: "",
  item_type: "",
  item_category: "",
  item_sub_category: "",
  item_pv: "",
  item_availability: "",
  bind_membership_id: "",
});

const submitForm = async (event) => {
  event.preventDefault();
  const result = await useFetch("http://127.0.0.1:8000/api/Items", {
    method: "POST",
    body: {
      item_sku: form.value.item_sku,
      item_thumbnail: form.value.item_thumbnail,
      item_description: form.value.item_description,
      item_inclusion_details: form.value.item_inclusion_details,
      item_barcode: form.value.item_barcode,
      item_price: form.value.item_price,
      item_charged: form.value.item_charged,
      qty_charged: form.value.qty_charged,
      item_type: form.value.item_type,
      item_category: form.value.item_category,
      item_sub_category: form.value.item_sub_category,
      item_pv: form.value.item_pv,
      item_availability: form.value.item_availability,
      bind_membership_id: form.value.bind_membership_id,
    },
  });
  console.log(result);
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
            <span class="font-medium text-sm text-gray-700"
                    >Description</span
                  >
          </div>
          <button @click="submitForm" class="cursor-pointer bg-black text-white px-4 py-1 text-sm font-semibold rounded-lg">Add</button>
        </div>
        <Card>
          <form @submit.prevent="submitForm">
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
                <TextInput id="email" placeholder="" type="email" v-model="form.email" />
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
          </form>
        </Card>
      </div>
    </div>
  </div>
</template>
