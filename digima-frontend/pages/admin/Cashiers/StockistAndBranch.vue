<script setup>
import { ref } from "vue";

// Layout
definePageMeta({
  layout: "authenticated-layout",
  path: "/stockist&branches",
});

// Fetching the API
const {
  data: slots,
  error,
  refresh,
} = await useFetch("http://127.0.0.1:8000/api/Slots");

// Modals Scripts
const showModalPlaceSlot = ref(false);
const showModalCreateSlot = ref(false);
const showModalLimit = ref(false);
const showModalAddMember = ref(false);
const showModalMore = ref(false);

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
  const { data, error: fetchError } = await useFetch(
    "http://127.0.0.1:8000/api/Slots",
    {
      method: "POST",
      body: JSON.stringify({
        slot_username: form.value.slot_username,
        slot_sponsor: form.value.slot_sponsor,
        email: form.value.email,
        password: form.value.password,
        first_name: form.value.first_name,
        middle_name: form.value.middle_name,
        last_name: form.value.last_name,
      }),
      headers: {
        "Content-Type": "application/json",
      },
    }
  );
};
</script>

<template>
  <div class="bg-white min-w-full h-full p-6 rounded-md shadow-md">
    <div class="flex justify-between items-center">
      <h3 class="text-2xl font-semibold text-gray-800">Stockist and Branches</h3>

      <div class="flex items-center space-x-4">
        <SecondaryButton @click="showModalPlaceSlot = true">
          <p class="text-xs font-medium">Manage Cashier Payment Methods</p>
        </SecondaryButton>

        <SecondaryButton @click="showModalCreateSlot = true">
          <p class="text-xs font-medium">Manage Stockist Levels</p>
        </SecondaryButton>

        <SecondaryButton @click="showModalLimit = true">
          <p class="text-xs font-medium">Manage Locations</p>
        </SecondaryButton>

        <SecondaryButton @click="showModalAddMember = true">
          <p class="text-xs font-medium">Edit Company Info</p>
        </SecondaryButton>

        <SecondaryButton @click="showModalAddMember = true">
          <p class="text-xs font-medium">Add Branch / Stockist</p>
        </SecondaryButton>
      </div>
    </div>
    <hr class="h-px my-3 bg-gray-200 border-0" />

    <!-- Bottom Table -->
    <div class="overflow-x-auto w-[120vh] rounded-md">
      <table
        class="min-w-full table-auto text-sm text-center border-collapse text-gray-600"
      >
        <thead class="bg-slate-100 text-gray-700">
          <tr>
            <th class="px-4 py-2 border-b border-slate-100">Stockist / Branch Name</th>
            <th class="px-4 py-2 border-b border-slate-100">Location</th>
            <th class="px-4 py-2 border-b border-slate-100">Type</th>
            <th class="px-4 py-2 border-b border-slate-100">Branch / Stockist Cashier Count</th>
            <th class="px-4 py-2 border-b border-slate-100">Available Membership Code</th>
            <th class="px-4 py-2 border-b border-slate-100">Available Product Code</th>
            <th class="px-4 py-2 border-b border-slate-100">Sold Membership Code</th>
            <th class="px-4 py-2 border-b border-slate-100">Sold Product Code</th>
            <th class="px-4 py-2 border-b border-slate-100">Total Sale</th>
            <th class="px-4 py-2 border-b border-slate-100"></th>
          </tr>
        </thead>
        <tbody class="striped">
          <tr v-for="slot in slots" :key="slot.id">
            <td
              class="px-4 py-2 border-b border-slate-200 font-medium text-gray-900"
            >
              {{ slot.slot_username }}
            </td>
            <td class="px-4 py-2 border-b border-slate-200">
              {{ slot.users.first_name }} {{ slot.users.last_name }}
            </td>
            <td class="px-4 py-2 border-b border-slate-200">
              {{ slot.users.first_name }} {{ slot.users.last_name }}
            </td>
            <!-- <td
              class="px-4 py-2 border-b border-slate-200"
              v-if="slot.slot_sponsor != null"
            >
              {{ slot.sponsor_info.slot_username }}
            </td> -->

            <td class="px-4 py-2 border-b border-slate-200">
              {{ slot.memberships ? slot.memberships.membership_name : "--" }}
            </td>
            <td class="px-4 py-2 border-b border-slate-200">PS</td>
            <td class="px-4 py-2 border-b border-slate-200">
              01/03/2025 (10:12 PM)
            </td>
            <td class="px-4 py-2 border-b border-slate-200">---</td>
            <td class="px-4 py-2 border-b border-slate-200">14,500.00</td>
            <td class="px-4 py-2 border-b border-slate-200">14,500.00</td>
            <td
              class="px-4 py-2 border-b border-slate-200 font-medium text-gray-900"
            >
              <button @click="showModalMore = true" class="cursor-pointer">
                More
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>
</template>
