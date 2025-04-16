<script setup>
import { ref, computed } from "vue";
// Layout
definePageMeta({
  middleware: ["auth", "guest"],
});

// Fetching the API
const { data: slots } = await useFetch("http://127.0.0.1:8000/api/Slots");
const { data: codes } = await useFetch("http://127.0.0.1:8000/api/Codes");
const { data: memberships } = await useFetch(
  "http://127.0.0.1:8000/api/Memberships"
);

// Fetch User
const cookies = useCookie("auth_user_token");

// Get the Selected accounts based on slot_id
const selectedSlotData = ref(null);
onMounted(() => {
  const slots = localStorage.getItem("slots");
  if (slots) {
    selectedSlotData.value = JSON.parse(slots); // Parse the data
    form.value.slot_sponsor = selectedSlotData.value.slot_username;
  }
});

// Submit form for Add Member
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
  const result = await useFetch("http://127.0.0.1:8000/api/Slots", {
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
};

// Get first Null by code_used_by
const slotCodes = computed(() => {
  if (!selectedSlotData.value || !selectedSlotData.value.users) return null;
  
  // Find the first code matching the criteria
  const result = codes.value.filter((code) => {
    return (
      code.code_used_by === null &&
      code.code_sold_to === selectedSlotData.value.users.id
    );
  });
  // Log to check what is returned
  // console.log(result);
  return result;
});
</script>

<template>
  <div>
    <div class="flex justify-center items-center m-10">
      <div class="space-y-5">
        <div class="flex justify-between items-center">
          <div>
            <p class="font-semibold">Add Member</p>
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
          <form @submit.prevent="submitForm">
            <div class="space-y-4">
              <div v-if="cookies.user.name === 'member'">
                <div class="flex space-x-30 items-center justify-between">
                  <div>
                    <InputLabel for="membership_package"
                      >Membership Package</InputLabel
                    >
                    <span class="font-medium text-sm text-gray-700"
                      >Description</span
                    >
                  </div>
                  <select
                    v-model="form.code_id"
                    id="membership"
                    class="mt-2 p-2 border border-gray-300 rounded-lg w-full"
                  >
                    <option disabled value="">Please select a Membership</option>
                    <option
                      v-for="(code, index) in slotCodes" :key="index"
                      :value="code.code_id"
                    >
                      {{ code.inventories.items.memberships.membership_name }}
                    </option>
                  </select>
                </div>
              </div>

              <hr v-if="cookies.user.name === 'member'" class="h-px bg-gray-200 border-0" />

              <div class="flex space-x-30 items-center justify-between">
                <div>
                  <InputLabel for="slot_sponsor">Sponsor Username</InputLabel>
                  <span class="font-medium text-sm text-gray-700"
                    >Description</span
                  >
                </div>
                <div v-if="cookies.user.name === 'admin'">
                  <TextInput
                    id="slot_sponsor"
                    placeholder=""
                    v-model="form.slot_sponsor"
                  />
                </div>
                <div v-else>
                  <TextInput
                    id="slot_sponsor"
                    placeholder=""
                    v-model="form.slot_sponsor"
                    :value="form.slot_sponsor"
                    :disabled="true"
                  />
                </div>
              </div>

              <hr class="h-px bg-gray-200 border-0" />

              <div class="flex space-x-10 items-center justify-between">
                <div>
                  <InputLabel for="slot_username">Username</InputLabel>
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
          </form>
        </Card>
      </div>
    </div>
  </div>
</template>
