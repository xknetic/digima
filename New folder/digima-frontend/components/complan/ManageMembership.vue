<script setup>
const { data: memberships } = await useFetch(
  "http://127.0.0.1:8000/api/Memberships"
);

const submitForm = async (event) => {
  event.preventDefault();
  const result = await useFetch(`http://127.0.0.1:8000/api/Memberships`, {
    method: "POST",
    body: {
      membership_name: memberships.membership_name,
      hierarchy: memberships.hierarchy,
    },
  });
  console.log(result);
};
</script>

<template>
  <div>
    <form @submit.prevent="submitForm">
      <!-- Table -->
      <div class="w-full mx-auto rounded-sm">
        <div class="px-4">
          <div class="overflow-x-auto">
            <table class="table-auto w-full">
              <thead
                class="text-sm font-medium bg-gray-50 border border-slate-200"
              >
                <tr>
                  <th class="py-3 px-4 whitespace-normal">Membership Name</th>
                  <th class="p-2 whitespace-normal">Hierarchy</th>
                  <th class="p-2 whitespace-normal">Add</th>
                </tr>
              </thead>
              <tbody class="text-sm text-center divide-y divide-slate-200">
                <tr
                  v-for="membership in memberships"
                  :key="membership.membership_id"
                >
                  <td class="p-2 whitespace-normal">
                    <TextInput
                      id=""
                      placeholder=""
                      v-model="membership.membership_name"
                    />
                  </td>
                  <td class="p-2 whitespace-normal">
                    <TextInput
                      id=""
                      placeholder=""
                      v-model="membership.hierarchy"
                    />
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <ButtonPrimarySmall> Submit </ButtonPrimarySmall>
    </form>
  </div>
</template>
