<script setup>
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
const { data: memberships } = await useFetch(
  "http://127.0.0.1:8000/api/Memberships"
);

// Fetch User
const cookies = useCookie("auth_user_token");
const data = ref(null);
const result = await $fetch("http://127.0.0.1:8000/api/user", {
  headers: {
    Authorization: `Bearer ${cookies.value.token}`,
  },
});
data.value = result;

// const firstNullMembership = codes.value.find((code) => code.code_used_by === null);

// Get the ID
// const firstNullCodeId = firstNullCode ? firstNullCode.id : null;

// Create Slot Form
const form = ref({
  slot_id: "",
  slot_sponsor: "",
  slot_membership_id: "",
});

// Get first Null by code_used_by
const firstNullCode = computed(() => {
  return codes.value.find((code) => {
    return (
      code.code_used_by === null &&
      code.code_sold_to === null &&
      code.inventories?.items?.membership_id === form.value.slot_membership_id
    );
  });
});

// user Filter
const userFilter = computed(() => {
  const seen = new Set();
  return slots.value.filter((slot) => {
    if (!seen.has(slot.slot_user_id)) {
      seen.add(slot.slot_user_id);
      return true;
    }
    return false;
  });
});

const submitForm = async (event) => {
  event.preventDefault();
  try {
    const result = await useFetch(
      `http://127.0.0.1:8000/api/Slot/Generate/${firstNullCode.value.code_id}`,
      {
        method: "PUT",
        body: {
          slot_id: form.value.slot_id,
          slot_sponsor: form.value.slot_sponsor,
          slot_membership_id: form.value.slot_membership_id,
        },
      }
    );
  } catch (error) {
    console.log(error);
  }
};

const itemsPerPage = 10;
const {
  currentPage,
  totalPages,
  paginatedItems,
  secondPage,
  nextPage,
  prevPage,
  firstPage,
  lastPage,
} = usePagination(slots, itemsPerPage);

const { filtered, filter } = useLocalSearch(paginatedItems);

// Modal
const showCreateSlot = ref(false);
</script>

<template>
  <div>
    <MemberNavigation />

    <div class="flex justify-between items-center px-5 py-3">
      <div>
        <TextInput
          class="w-[50vh]"
          v-model="searchTerm"
          @input="filter(searchTerm)"
          type="text"
          placeholder="Search..."
        />
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
              <tr v-for="slot in filtered" :key="slot.id">
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

        <div
          v-if="paginatedItems == itemsPerPage"
          class="flex justify-end items-center space-x-1"
        >
          <button
            @click="firstPage"
            :disabled="currentPage === totalPages"
            class="cursor-pointer hover:bg-slate-200 p-1 rounded-lg flex space-x-2 items-center border border-slate-300"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="size-5"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="m18.75 4.5-7.5 7.5 7.5 7.5m-6-15L5.25 12l7.5 7.5"
              />
            </svg>
          </button>

          <button
            @click="prevPage"
            :disabled="currentPage === 1"
            class="cursor-pointer hover:bg-slate-200 p-1 rounded-lg flex space-x-2 items-center border border-slate-300"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="size-5"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M15.75 19.5 8.25 12l7.5-7.5"
              />
            </svg>
          </button>

          <button
            :disabled="currentPage"
            class="hover:bg-slate-200 px-[10px] py-[2px] rounded-lg flex space-x-2 items-center border border-slate-300"
          >
            {{ currentPage }}
          </button>

          <div v-if="currentPage != totalPages">
            <button
              @click="nextPage"
              :disabled="currentPage === totalPages"
              class="cursor-pointer hover:bg-slate-200 px-[10px] py-[2px] rounded-lg flex space-x-2 items-center border border-slate-300"
            >
              {{ secondPage }}
            </button>
          </div>

          <button
            @click="nextPage"
            :disabled="currentPage === totalPages"
            class="cursor-pointer hover:bg-slate-200 p-1 rounded-lg flex space-x-2 items-center border border-slate-300"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="size-5"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="m8.25 4.5 7.5 7.5-7.5 7.5"
              />
            </svg>
          </button>

          <button
            @click="lastPage"
            :disabled="currentPage === totalPages"
            class="cursor-pointer hover:bg-slate-200 p-1 rounded-lg flex space-x-2 items-center border border-slate-300"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="size-5"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5"
              />
            </svg>
          </button>
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
              <div class="flex space-x-10 items-center justify-between">
                <div>
                  <InputLabel for="membership">Membership</InputLabel>
                  <span class="font-medium text-sm text-gray-700"
                    >Description</span
                  >
                </div>
                <div class="mb-4">
                  <select
                    v-model="form.slot_membership_id"
                    id="membership"
                    class="mt-2 p-2 border border-gray-300 rounded-lg w-full"
                  >
                    <option disabled value="">
                      Please select a Membership
                    </option>
                    <option
                      v-for="membership in memberships"
                      :key="membership.id"
                      :value="membership.membership_id"
                    >
                      {{ membership.membership_name }}
                    </option>
                  </select>
                </div>
              </div>

              <hr class="h-px bg-gray-200 border-0" />

              <div class="flex space-x-30 items-center justify-between">
                <div>
                  <InputLabel for="code_activation">Code</InputLabel>
                  <span class="font-medium text-sm text-gray-700"
                    >Description</span
                  >
                </div>
                <TextInput
                  id="code_activation"
                  :placeholder="firstNullCode?.code_activation"
                  :value="firstNullCode?.code_activation"
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
                  :placeholder="firstNullCode?.code_pin"
                  :value="firstNullCode?.code_pin"
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
                    id="slot_owner"
                    class="mt-2 p-2 border border-gray-300 rounded-lg w-full"
                  >
                    <option disabled value="">Please select a slot</option>
                    <option
                      v-for="slot in userFilter"
                      :key="slot.slot_id"
                      :value="slot.slot_id"
                    >
                      {{ slot.users?.email }}
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
