<script setup>
import { ref, onMounted } from "vue";

// Layout
definePageMeta({
  layout: "member-layout",
  path: "/dashboard",
  name: "Dashboard",
  middleware: "member",
});

// Fetching the API
const { data: slots } = await useFetch("http://127.0.0.1:8000/api/Slots");

// Get the Selected accounts based on slot_id
const selectedSlotData = ref(null);

onMounted(() => {
  const storedSlotData = localStorage.getItem("selectedSlotData");
  if (storedSlotData) {
    selectedSlotData.value = JSON.parse(storedSlotData); // Parse the data
  }
});

const showAddMember = ref(false);
</script>

<template>
  <div class="p-5">
    <!-- Card -->
    <div class="flex space-x-4 min-h-full">
      <div class="flex-1">
        <div
          class="border border-slate-200 rounded-lg p-5 flex justify-between"
        >
          <!-- Left Side -->
          <div class="flex space-x-2">
            <Logo class="w-auto h-[15vh]" />
            <div class="text-md font-medium">
              <span class="font-bold"
                >{{
                  selectedSlotData ? selectedSlotData.users.first_name : "--"
                }}
                {{
                  selectedSlotData ? selectedSlotData.users.middle_name : "--"
                }}
                {{
                  selectedSlotData ? selectedSlotData.users.last_name : "--"
                }}</span
              >
              <p>
                Username:
                {{ selectedSlotData ? selectedSlotData.slot_username : "--" }}
              </p>
              <p>
                Package:
                {{
                  selectedSlotData && selectedSlotData.memberships
                    ? selectedSlotData.memberships.membership_name || "--"
                    : "--"
                }}
              </p>
              <p>
                Sponsor Username:
                {{
                  selectedSlotData && selectedSlotData.sponsor_info
                    ? selectedSlotData.sponsor_info.slot_username || "--"
                    : "--"
                }}
              </p>
              <p>Rank: {{}}</p>
              <p class="font-semibold text-gray-600">Main Account</p>
            </div>
          </div>

          <!-- Links -->
          <div class="flex flex-col justify-center items-center">
            <ResponsiveNavLink :href="'/'"> Referral Link </ResponsiveNavLink>
            <ResponsiveNavLink @click="showAddMember = true">
              Add Member
            </ResponsiveNavLink>
            <ResponsiveNavLink :href="'/'"> Settings </ResponsiveNavLink>
          </div>
        </div>

        <!-- Table -->
        <div class="">
          <div class="flex flex-col justify-center h-full">
            <!-- Table -->
            <div class="w-full mx-auto rounded-sm">
              <div class="p-3">
                <div class="overflow-x-auto">
                  <table class="table-auto w-full">
                    <thead
                      class="text-xs font-medium uppercase bg-gray-50 border border-slate-200"
                    >
                      <tr>
                        <th class="py-3 px-4 whitespace-nowrap">
                          <div class="text-left">POSTING DATE</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                          <div class="font-semibold text-left">DETAIL</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                          <div class="font-semibold text-left">AMOUNT</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                          <div class="font-semibold text-center">BALANCE</div>
                        </th>
                      </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                      <tr>
                        <td class="p-2 whitespace-nowrap">
                          <div class="flex items-center">
                            <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3">
                              <img
                                class="rounded-full"
                                src="https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-05.jpg"
                                width="40"
                                height="40"
                                alt="Alex Shatov"
                              />
                            </div>
                            <div class="font-medium text-gray-800">
                              Alex Shatov
                            </div>
                          </div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                          <div class="text-left">alexshatov@gmail.com</div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                          <div class="text-left font-medium text-green-500">
                            $2,890.66
                          </div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                          <div class="text-lg text-center">🇺🇸</div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="w-[25vh]">
        <!-- Wallets -->
        <span class="text-sm font-medium">Wallets</span>
        <div class="space-y-2 overflow-y-auto h-[50vh]">
          <!-- Available Wallet -->
          <div
            class="border border-slate-200 rounded-lg p-5 flex justify-between items-center"
          >
            <div>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="size-6"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3"
                />
              </svg>
            </div>
            <div class="flex flex-col items-end">
              <p class="text-xs font-medium">Available Wallet</p>
              <span> 14,500.00 </span>
            </div>
          </div>

          <!-- Accumulated Earnings -->
          <div
            class="border border-slate-200 rounded-lg p-5 flex justify-between items-center"
          >
            <div>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="size-6"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3"
                />
              </svg>
            </div>
            <div class="flex flex-col items-end">
              <p class="text-xs font-medium">Accumulated Earnings</p>
              <span> 14,500.00 </span>
            </div>
          </div>

          <!-- Us Dollar -->
          <div
            class="border border-slate-200 rounded-lg p-5 flex justify-between items-center"
          >
            <div>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="size-6"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                />
              </svg>
            </div>
            <div class="flex flex-col items-end">
              <p class="text-xs font-medium">US Dollar</p>
              <span> 0.00 </span>
            </div>
          </div>

          <!-- Available GC -->
          <div
            class="border border-slate-200 rounded-lg p-5 flex justify-between items-center"
          >
            <div>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="size-6"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                />
              </svg>
            </div>
            <div class="flex flex-col items-end">
              <p class="text-xs font-medium">Available GC</p>
              <span> 0.00 </span>
            </div>
          </div>

          <!-- Bitcoin -->
          <div
            class="border border-slate-200 rounded-lg p-5 flex justify-between items-center"
          >
            <div>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="size-6"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                />
              </svg>
            </div>
            <div class="flex flex-col items-end">
              <p class="text-xs font-medium">Bitcoin</p>
              <span> 0.00 </span>
            </div>
          </div>

          <!-- Available Cashin Wallet -->
          <div
            class="border border-slate-200 rounded-lg p-5 flex justify-between items-center"
          >
            <div>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="size-6"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                />
              </svg>
            </div>
            <div class="flex flex-col items-end">
              <p class="text-xs font-medium">Available Cashin Wallet</p>
              <span> 0.00 </span>
            </div>
          </div>

          <!-- CD Wallet -->
          <div
            class="border border-slate-200 rounded-lg p-5 flex justify-between items-center"
          >
            <div>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="size-6"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                />
              </svg>
            </div>
            <div class="flex flex-col items-end">
              <p class="text-xs font-medium">CD Wallet</p>
              <span> 0.00 </span>
            </div>
          </div>

          <!-- Direct Referral Donus -->
          <div
            class="border border-slate-200 rounded-lg p-5 flex justify-between items-center"
          >
            <div>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="size-6"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                />
              </svg>
            </div>
            <div class="flex flex-col items-end">
              <p class="text-xs font-medium">Direct Referral Donus</p>
              <span> 0.00 </span>
            </div>
          </div>

          <!-- Indirect Referral Bonus -->
          <div
            class="border border-slate-200 rounded-lg p-5 flex justify-between items-center"
          >
            <div>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="size-6"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                />
              </svg>
            </div>
            <div class="flex flex-col items-end">
              <p class="text-xs font-medium">Indirect Referral Bonus</p>
              <span> 0.00 </span>
            </div>
          </div>

          <!-- Unilevel Bonus -->
          <div
            class="border border-slate-200 rounded-lg p-5 flex justify-between items-center"
          >
            <div>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="size-6"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                />
              </svg>
            </div>
            <div class="flex flex-col items-end">
              <p class="text-xs font-medium">Unilevel Bonus</p>
              <span> 0.00 </span>
            </div>
          </div>

          <!-- Unilevel Matrix Bonus -->
          <div
            class="border border-slate-200 rounded-lg p-5 flex justify-between items-center"
          >
            <div>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="size-6"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                />
              </svg>
            </div>
            <div class="flex flex-col items-end">
              <p class="text-xs font-medium">Unilevel Matrix Bonus</p>
              <span> 0.00 </span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <Modal
      :show="showAddMember"
      :closeable="true"
      @close="showAddMember = false"
    >
      <div class="bg-white py-1 rounded-lg">
        <AddMemberForm />
      </div>
    </Modal>
  </div>
</template>
