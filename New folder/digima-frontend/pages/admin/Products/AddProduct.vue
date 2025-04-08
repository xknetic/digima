<script setup>
// Layout
definePageMeta({
  layout: "authenticated-layout",
  path: "/admin/product/addproduct",
  name: "Add Product",
  middleware: "auth",
});

// Fetching the API
const { data: categories } = await useFetch(
  "http://127.0.0.1:8000/api/ProductCategory"
);
const { data: memberships } = await useFetch(
  "http://127.0.0.1:8000/api/Memberships"
);

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
  membership_id: "",
  slot_qty: "",
  code_user: "",
  upgrade_own: "",
  is_kit_upgrade: "",
});

const handleError = ref(null);

const submitForm = async (event) => {
  event.preventDefault();
  try {
    const result = await $fetch("http://127.0.0.1:8000/api/Items", {
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
        membership_id: form.value.membership_id,
        slot_qty: form.value.slot_qty,
        code_user: form.value.code_user,
        upgrade_own: form.value.upgrade_own,
        is_kit_upgrade: form.value.is_kit_upgrade,
      },
    });
    // console.error(result);
  } catch (error) {
    // console.log(error.data);
    handleError.value = error.data.errors;
    // console.error(handleError.value);
  }
};

// Define the options for the select component
const options = ref([
  { label: "Product/Items Only", value: "product" },
  { label: "Membership Package Only", value: "membership" },
]);

const formattedCategories = ref([
  { label: "None", value: null },
  ...categories.value.map((category) => ({
    label: category.category_name,
    value: category.category_id,
  })),
]);

const formattedMemberships = ref([
  { label: "None", value: null },
  ...memberships.value.map((membership) => ({
    label: membership.membership_name,
    value: membership.membership_id,
  })),
]);

const codeUser = ref([
  { label: "Everyone", value: "everyone" },
  { label: "Buyer Only", value: "buyer" },
]);

const upgradeAndKit = ref([
  { label: "Yes", value: 1 },
  { label: "No", value: 0 },
]);
</script>

<template>
  <div>
    <ProductNavigation />

    <div v-if="handleError" class="absolute top-15 right-5">
      <div v-for="(error, index) in handleError" :key="index">
        <!-- Each error message is wrapped in its own div with styling for spacing and background color -->
        <div class="mt-2">
          <ErrorHandler>
            {{ error }}
          </ErrorHandler>
        </div>
      </div>
    </div>

    <div class="m-5">
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
        <form @submit.prevent="submitForm">
          <div class="flex space-x-4">
            <Card>
              <div class="space-y-4">
                <div class="flex space-x-4">
                  <div class="space-x-10 items-center justify-between">
                    <div>
                      <InputLabel for="item_sku">Product SKU</InputLabel>
                      <span class="font-medium text-sm text-gray-700"
                        >Description</span
                      >
                    </div>
                    <TextInput
                      id="item_sku"
                      placeholder=""
                      v-model="form.item_sku"
                    />
                  </div>

                  <div class="space-x-10 items-center justify-between">
                    <div>
                      <InputLabel for="item_barcode">Barcode</InputLabel>
                      <span class="font-medium text-sm text-gray-700"
                        >Description</span
                      >
                    </div>
                    <TextInput
                      id="item_barcode"
                      placeholder=""
                      v-model="form.item_barcode"
                    />
                  </div>

                  <div class="space-x-10 items-center justify-between">
                    <div>
                      <InputLabel for="item_price">Price</InputLabel>
                      <span class="font-medium text-sm text-gray-700"
                        >Description</span
                      >
                    </div>
                    <TextInput
                      id="item_price"
                      placeholder=""
                      v-model="form.item_price"
                    />
                  </div>
                </div>

                <hr class="h-px bg-gray-200 border-0 hidden" />

                <div class="space-x-10 items-center justify-between hidden">
                  <div>
                    <InputLabel for="item_description">
                      Product Details</InputLabel
                    >
                    <span class="font-medium text-sm text-gray-700"
                      >Description</span
                    >
                  </div>
                  <TextAreaInput
                    id="item_description"
                    placeholder=""
                    v-model="form.item_description"
                  />
                </div>

                <hr class="h-px bg-gray-200 border-0 hidden" />

                <div class="space-x-10 items-center justify-between hidden">
                  <div>
                    <InputLabel for="item_inclusion_details">
                      Product Inclusion Details</InputLabel
                    >
                    <span class="font-medium text-sm text-gray-700"
                      >Description</span
                    >
                  </div>
                  <TextAreaInput
                    id="item_inclusion_details"
                    placeholder=""
                    v-model="form.item_inclusion_details"
                  />
                </div>

                <hr class="h-px bg-gray-200 border-0" />

                <div class="flex space-x-4">
                  <div class="space-x-10 items-center justify-between">
                    <div>
                      <InputLabel for="item_pv">Item PV</InputLabel>
                      <span class="font-medium text-sm text-gray-700"
                        >Description</span
                      >
                    </div>
                    <TextInput
                      id="item_pv"
                      placeholder=""
                      v-model="form.item_pv"
                    />
                  </div>

                  <div class="space-x-10 items-center justify-between">
                    <div>
                      <InputLabel for="type">Type</InputLabel>
                      <span class="font-medium text-sm text-gray-700"
                        >Description</span
                      >
                    </div>
                    <div>
                      <Uselect
                        id="type"
                        :options="options"
                        v-model="form.item_type"
                        placeholder="Select a Type"
                      />
                    </div>
                  </div>

                  <div class="space-x-10 items-center justify-between">
                    <div>
                      <InputLabel for="item_category">Category</InputLabel>
                      <span class="font-medium text-sm text-gray-700"
                        >Description</span
                      >
                    </div>
                    <div>
                      <Uselect
                        id="type"
                        :options="formattedCategories"
                        v-model="form.item_category"
                        placeholder="Select a Category"
                      />
                    </div>
                  </div>
                </div>

                <hr class="h-px bg-gray-200 border-0" />

                <div class="flex space-x-4">
                  <div class="space-x-10 items-center justify-between">
                    <div>
                      <InputLabel for="item_sub_category"
                        >Sub-Category</InputLabel
                      >
                      <span class="font-medium text-sm text-gray-700"
                        >Description</span
                      >
                    </div>
                    <TextInput
                      id="item_sub_category"
                      placeholder=""
                      v-model="form.item_sub_category"
                    />
                  </div>

                  <div class="space-x-10 items-center justify-between">
                    <div>
                      <InputLabel for="item_availability"
                        >Availability</InputLabel
                      >
                      <span class="font-medium text-sm text-gray-700"
                        >Description</span
                      >
                    </div>
                    <TextInput
                      id="item_availability"
                      placeholder=""
                      v-model="form.item_availability"
                    />
                  </div>

                  <div class="space-x-10 items-center justify-between">
                    <div>
                      <InputLabel for="bind_membership_id"
                        >Bind Membership</InputLabel
                      >
                      <span class="font-medium text-sm text-gray-700"
                        >Description</span
                      >
                    </div>
                    <div>
                      <Uselect
                        id="type"
                        :options="formattedMemberships"
                        v-model="form.bind_membership_id"
                        placeholder="Select a Membership"
                      />
                    </div>
                  </div>
                </div>

                <hr class="h-px bg-gray-200 border-0" />

                <div class="flex space-x-4">
                  <div class="space-x-10 items-center justify-between">
                    <div>
                      <InputLabel for="item_charged">Item Charged</InputLabel>
                      <span class="font-medium text-sm text-gray-700"
                        >Description</span
                      >
                    </div>
                    <TextInput
                      id="item_charged"
                      placeholder=""
                      v-model="form.item_charged"
                    />
                  </div>

                  <div class="space-x-10 items-center justify-between">
                    <div>
                      <InputLabel for="qty_charged">Qty Charged (%)</InputLabel>
                      <span class="font-medium text-sm text-gray-700"
                        >Description</span
                      >
                    </div>
                    <TextInput
                      id="qty_charged"
                      placeholder=""
                      v-model="form.qty_charged"
                    />
                  </div>
                </div>
              </div>
            </Card>

            <div v-if="form.item_type === 'membership'">
              <Card>
                <div class="space-y-4">
                  <div class="flex space-x-4">
                    <div class="space-x-10 items-center justify-between">
                      <div>
                        <InputLabel for="membership">Membership</InputLabel>
                        <span class="font-medium text-sm text-gray-700"
                          >Description</span
                        >
                      </div>
                      <div>
                        <Uselect
                          id="membership"
                          :options="formattedMemberships"
                          v-model="form.membership_id"
                          placeholder="Select a Membership"
                        />
                      </div>
                    </div>

                    <div class="space-x-10 items-center justify-between">
                      <div>
                        <InputLabel for="slotQuantity">Slot Quantity</InputLabel>
                        <span class="font-medium text-sm text-gray-700"
                          >Description</span
                        >
                      </div>
                      <div>
                        <TextInput
                          id="slotQuantity"
                          placeholder=""
                          v-model="form.slot_qty"
                        />
                      </div>
                    </div>

                    <div class="space-x-10 items-center justify-between">
                      <div>
                        <InputLabel for="codeUser">Code User</InputLabel>
                        <span class="font-medium text-sm text-gray-700"
                          >Description</span
                        >
                      </div>
                      <div>
                        <Uselect
                          id="codeUser"
                          :options="codeUser"
                          v-model="form.code_user"
                          placeholder="Select a User"
                        />
                      </div>
                    </div>
                  </div>

                  <hr class="h-px bg-gray-200 border-0" />

                  <div class="flex space-x-4">
                    <div class="space-x-10 items-center justify-between">
                      <div>
                        <InputLabel for="upgrade">Upgrade</InputLabel>
                        <span class="font-medium text-sm text-gray-700"
                          >Description</span
                        >
                      </div>
                      <div>
                        <Uselect
                          id="upgrade"
                          :options="upgradeAndKit"
                          v-model="form.upgrade_own"
                          placeholder=""
                        />
                      </div>
                    </div>

                    <div class="space-x-10 items-center justify-between">
                      <div>
                        <InputLabel for="kitUpgrade">Use Kit To Upgrade Membership</InputLabel>
                        <span class="font-medium text-sm text-gray-700"
                          >Description</span
                        >
                      </div>
                      <div>
                        <Uselect
                          id="kitUpgrade"
                          :options="upgradeAndKit"
                          v-model="form.is_kit_upgrade"
                          placeholder=""
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </Card>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
