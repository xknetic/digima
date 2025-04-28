<script setup>
// Layout
definePageMeta({
  layout: "cashier-layout",
  path: "/cashierdashboard",
  name: "Cashier",
  middleware: "cashier",
});

// Fetch user
const { data: paymentmethods } = await useFetch(
  "http://127.0.0.1:8000/api/PaymentMethods"
);

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

const filteredPaymentMethods = computed(() => 
  paymentmethods.value.filter(paymentmethod => paymentmethod.payment_method_status)
);

const paymentmethod = ref([
  // { label: "None", value: null },
  ...filteredPaymentMethods.value.map((paymentmethod) => ({
    label: paymentmethod.payment_method_name,
    value: paymentmethod.payment_method_id,
  })),
]);

const form = ref({
  slot_username: "",
  slot_sponsor: "",
  email: "",
  password: "",
  first_name: "",
  middle_name: "",
  last_name: "",
});

const submitForm = async (event) => {
  event.preventDefault();
  try {
    const result = await useFetch("http://127.0.0.1:8000/api/Orders", {
      method: "POST",
      body: {
        slot_username: form.value.slot_username,
        slot_sponsor: form.value.slot_sponsor,
        email: form.value.email,
        password: form.value.password,
        first_name: form.value.first_name,
        middle_name: form.value.middle_name,
        last_name: form.value.last_name,
        code_id: form.value.code_id,
        slot_membership_id: form.value.slot_membership_id,
      },
    });
    console.log(result);
  } catch (error) {}
};
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
        <div class="space-y-4">
          <Card>
            <div class="grid grid-cols-2 items-center">
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
          </Card>

          <Card>
            <div class="space-y-2">
              <div class="grid grid-cols-2 items-center">
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

              <div class="grid grid-cols-2 items-center">
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

              <div class="grid grid-cols-2 items-center">
                <div>
                  <InputLabel for="item_sku">VATable</InputLabel>
                  <!-- <span class="font-medium text-sm text-gray-700">Description</span> -->
                </div>
                <Uselect
                  id="type"
                  :options="vatable"
                  placeholder="Select a Type"
                />
              </div>
            </div>
          </Card>

          <Card>
            <div class="space-y-2">
              <div class="grid grid-cols-2 items-center">
                <div>
                  <InputLabel for="paymentmethod">Payment Method</InputLabel>
                </div>
                <Uselect
                  id="paymentmethod"
                  :options="paymentmethod"
                  placeholder="Select a Type"
                />
              </div>

              <div class="grid grid-cols-2 items-center">
                <span class="font-semibold text-md">Subtotal</span>
                <span class="font-medium text-sm">P 123.00</span>
              </div>

              <div class="grid grid-cols-2 items-center">
                <span class="font-semibold text-md">TOTAL</span>
                <span class="font-medium text-sm">P 123.00</span>
              </div>
            </div>
          </Card>

          <Card>
            <div class="space-y-2">
              <div class="space-y-2 items-center justify-between">
                <div>
                  <InputLabel for="item_inclusion_details"> Remarks</InputLabel>
                </div>
                <TextAreaInput id="item_inclusion_details" placeholder="" />
              </div>

              <PrimaryButton> Process Sale </PrimaryButton>
            </div>
          </Card>
        </div>
      </aside>
    </div>
  </div>
</template>
