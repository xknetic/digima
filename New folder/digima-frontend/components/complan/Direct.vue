<script setup>
const props = defineProps({
  complan: {
    type: Object,
    required: true,
  },
});

const { data: memberships } = await useFetch(
  "http://127.0.0.1:8000/api/Memberships"
);

const { data: directIncomes } = await useFetch(
  "http://127.0.0.1:8000/api/MembershipDirectIncome"
);

const membershipFiltered = memberships.value.filter((m) => m.archive != 1);

const entryIds = [...new Set(directIncomes.value.map(item => item.membership_entry_id))];

const incomeMatrix = {};
entryIds.forEach(entryId => {
  incomeMatrix[entryId] = {};
  membershipFiltered.forEach(m => {
    const found = directIncomes.value.find(
      di => di.membership_entry_id === entryId && di.membership_id === m.membership_id
    );
    incomeMatrix[entryId][m.membership_id] = found ? found.membership_direct_income : '';
  });
});

console.log(entryIds);
</script>

<template>
  <div>
    <form @submit.prevent="submitForm">
      <div class="space-y-2">
        <InputLabel for="slot_sponsor">Earning Label</InputLabel>
        <!-- <span class="font-medium text-sm text-gray-700">Description</span> -->
        <TextInput id="slot_sponsor" placeholder="" />
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
                  <th class="py-3 px-4 whitespace-normal">
                    Membership of Recipient
                  </th>
                  <th
                    v-for="membership in membershipFiltered"
                    :key="'head-' + membership.membership_id"
                    class="p-2 whitespace-normal"
                  >
                    {{ membership.membership_name }}
                  </th>
                </tr>
              </thead>
              <tbody class="text-sm text-center divide-y divide-slate-200">
                <tr
                  v-for="(entryId, index) in entryIds"
                  :key="'row-' + entryId"
                >
                  <td class="p-2 font-semibold">#{{ entryId }}</td>
                  <td
                    v-for="membership in membershipFiltered"
                    :key="'cell-' + entryId  + membership.membership_id"
                    class="p-2 whitespace-normal"
                  >
                    <!-- {{ incomeMatrix[entryId][membership.membership_id] }} -->
                    <TextInput v-model="incomeMatrix[entryId][membership.membership_id]" />
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>
