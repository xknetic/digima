<script setup>
import { ref } from "vue";

// Layout
definePageMeta({
  layout: "authenticated-layout",
  path: "/admin/memberlist",
  middleware: "auth",
  name: "Member List",
});

// Fetching the API
const { data: slots } = await useFetch("http://127.0.0.1:8000/api/Slots");
const { data: codes } = await useFetch("http://127.0.0.1:8000/api/Codes");
// Fetch User
const cookies = useCookie("auth_user_token");
const data = ref(null);
const result = await $fetch("http://127.0.0.1:8000/api/user", {
  headers: {
    Authorization: `Bearer ${cookies.value.token}`,
  },
});
data.value = result;

// Get first Null by code_slot_used
const firstNullCode = codes.value.find((code) => code.code_used_by === null);

// Get the ID
// const firstNullCodeId = firstNullCode ? firstNullCode.id : null;

// Create Slot Form
const form = ref({
  slot_id: "",
  slot_sponsor: 5,
});

const submitForm = async (event) => {
  event.preventDefault();
  const result = await useFetch(
    `http://127.0.0.1:8000/api/Codes/${firstNullCode.code_id}`,
    {
      method: "PUT",
      body: {
        slot_id: form.value.slot_id,
        slot_sponsor: form.value.slot_sponsor,
      },
    }
  );
  console.log(result);
};

// Modal
const showCreateSlot = ref(false);
</script>

<template>
  <div>
    <MemberNavigation />

    <div class="flex justify-between items-center px-5 py-3">
      <div>
        <p class="font-semibold">Search</p>
      </div>
      <div class="flex flex-col space-y-2 justify-end items-end">
        <div class="flex space-x-2">
          <button
            @click="showModalAddMember = true"
            class="cursor-pointer bg-black text-white px-4 py-1 text-sm font-semibold rounded-lg"
          >
            Place Slot
          </button>

          <button
            @click="showCreateSlot = true"
            class="cursor-pointer bg-black text-white px-4 py-1 text-sm font-semibold rounded-lg"
          >
            Create Slot
          </button>

          <button
            @click="showModalAddMember = true"
            class="cursor-pointer bg-black text-white px-4 py-1 text-sm font-semibold rounded-lg"
          >
            Slot Limit/Member
          </button>
        </div>

        <div>
          <button
            @click="showModalAddMember = true"
            class="cursor-pointer bg-black text-white px-4 py-1 text-sm font-semibold rounded-lg"
          >
            Add Member
          </button>
        </div>
      </div>
    </div>

    <!-- Table -->
    <div class="w-full mx-auto rounded-sm">
      <div class="px-4">
        <div class="overflow-x-auto">
          <table class="table-auto w-full">
            <thead
              class="text-sm font-medium bg-gray-50 border border-slate-200"
            >
              <tr>
                <th class="py-3 px-4 whitespace-normal">Username</th>
                <th class="p-2 whitespace-normal">Member Name</th>
                <th class="p-2 whitespace-normal">Sponsor</th>
                <th class="p-2 whitespace-normal">Placement</th>
                <th class="p-2 whitespace-normal">Position</th>
                <th class="p-2 whitespace-normal">Membership</th>
                <th class="p-2 whitespace-normal">Type</th>
                <th class="p-2 whitespace-normal">Date Created</th>
                <th class="p-2 whitespace-normal">KYC Status</th>
                <th class="p-2 whitespace-normal">Wallet</th>
                <th class="p-2 whitespace-normal">Total Earnings</th>
                <th class="p-2 whitespace-normal"></th>
              </tr>
            </thead>
            <tbody class="text-sm text-center divide-y divide-slate-200">
              <tr v-for="slot in slots" :key="slot.id">
                <td class="p-2 whitespace-normal">
                  {{ slot.slot_username }}
                </td>
                <td class="p-2 whitespace-normal">
                  {{ slot.users?.first_name || "---" }}
                  {{ slot.users?.last_name || "" }}
                </td>
                <td class="p-2 whitespace-normal">
                  {{
                    slot.sponsor_info ? slot.sponsor_info.slot_username : "--"
                  }}
                </td>
                <td class="p-2 whitespace-normal">
                  {{ slot.slot_placement }}
                </td>
                <td class="p-2 whitespace-normal">
                  {{ slot.slot_position }}
                </td>
                <td class="p-2 whitespace-normal">
                  {{
                    slot.memberships ? slot.memberships.membership_name : "--"
                  }}
                </td>
                <td class="p-2 whitespace-normal">PS</td>
                <td class="p-2 whitespace-normal">01/03/2025 (10:12 PM)</td>
                <td class="p-2 whitespace-normal">---</td>
                <td class="p-2 whitespace-normal">14,500.00</td>
                <td class="p-2 whitespace-normal">14,500.00</td>
                <td class="p-2 whitespace-normal">
                  <button @click="showModalMore = true" class="cursor-pointer">
                    More
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <Modal
      :show="showCreateSlot"
      :closeable="true"
      @close="showCreateSlot = false"
    >
      <div class="bg-white rounded-lg p-10">
        <div class="flex justify-between items-center">
          <div>
            <p class="font-semibold">Create Slot</p>
            <span class="font-medium text-sm text-gray-700">Description</span>
          </div>
          <button
            @click="submitForm"
            class="cursor-pointer bg-black text-white px-4 py-1 text-sm font-semibold rounded-lg"
          >
            Create Slot
          </button>
        </div>

        <Card>
          <form>
            <div class="space-y-4">
              <div class="flex space-x-30 items-center justify-between">
                <div>
                  <InputLabel for="code_activation">Code</InputLabel>
                  <span class="font-medium text-sm text-gray-700"
                    >Description</span
                  >
                </div>
                <TextInput
                  id="code_activation"
                  :placeholder="firstNullCode.code_activation"
                  :disabled="true"
                />
              </div>

              <hr class="h-px bg-gray-200 border-0" />

              <div class="flex space-x-10 items-center justify-between">
                <div>
                  <InputLabel for="code_pin">Pin</InputLabel>
                  <span class="font-medium text-sm text-gray-700"
                    >Description</span
                  >
                </div>
                <TextInput
                  id="code_pin"
                  :placeholder="firstNullCode.code_pin"
                  :disabled="true"
                />
              </div>

              <hr class="h-px bg-gray-200 border-0" />

              <div class="flex space-x-10 items-center justify-between">
                <div>
                  <InputLabel for="slot_owner">Slot Owner</InputLabel>
                  <span class="font-medium text-sm text-gray-700"
                    >Description</span
                  >
                </div>
                <div class="mb-4">
                  <!-- <label for="slotUser" class="block text-sm font-semibold"
                    >Select Slot by User</label
                  > -->
                  <select
                    v-model="form.slot_id"
                    id="slotUser"
                    class="mt-2 p-2 border border-gray-300 rounded-lg w-full"
                  >
                    <option disabled value="">Please select a slot</option>
                    <option
                      v-for="slot in slots"
                      :key="slot.slot_id"
                      :value="slot.slot_id"
                    >
                      {{ slot.slot_id }}
                    </option>
                  </select>
                </div>
              </div>

              <hr class="h-px bg-gray-200 border-0" />

              <div class="flex space-x-10 items-center justify-between">
                <div>
                  <InputLabel for="sponsor">Sponsor</InputLabel>
                  <span class="font-medium text-sm text-gray-700"
                    >Description</span
                  >
                </div>
                <TextInput
                  id="sponsor"
                  placeholder=""
                  v-model="form.slot_sponsor"
                />
              </div>
            </div>
          </form>
        </Card>
      </div>
    </Modal>
  </div>
</template>
