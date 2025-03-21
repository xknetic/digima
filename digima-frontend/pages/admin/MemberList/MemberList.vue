<script setup>
import { ref } from "vue";

// Layout
definePageMeta({
  layout: "authenticated-layout",
  path: "/admin/memberlist",
  name: "Member List",
});

// Fetching the API
const { data: slots } = await useFetch("http://127.0.0.1:8000/api/Slots");
</script>

<template>
  <div>
    <MemberNavigation />

    <!-- Table -->
    <div class="w-full mx-auto rounded-sm mt-4">
      <div class="p-4">
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
                  {{ slot.users.first_name }} {{ slot.users.last_name }}
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
  </div>
</template>
