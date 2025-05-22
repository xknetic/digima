<script setup>
import { ref, watch, onMounted } from "vue";

const memberships = ref([]);
const originalMemberships = ref([]);
const lastUsedId = ref(0);

const fetchMemberships = async () => {
  const { data } = await useFetch("http://127.0.0.1:8000/api/Memberships");
  memberships.value = data.value;
  // Deep copy to preserve original

  const membershipFilter = memberships.value.filter(
    (memberships) => memberships.archive != 1
  );
  originalMemberships.value = JSON.parse(JSON.stringify(membershipFilter));
  // console.log(membershipFilter);

  lastUsedId.value = Math.max(
    0,
    ...originalMemberships.value.map((m) => m.membership_id)
  );
};

onMounted(fetchMemberships);

const addNewMembership = () => {
  lastUsedId.value += 1;

  // console.log(newId);
  memberships.value.push({
    membership_id: lastUsedId,
    membership_name: "",
    hierarchy: "",
  });
};

const getChangedMemberships = () => {
  return memberships.value.filter((membership, index) => {
    const original = originalMemberships.value[index];

    if (!original) {
      return true;
    }

    return (
      membership.membership_name !== original.membership_name ||
      membership.hierarchy !== original.hierarchy
    );
  });
};

const submitForm = async (event) => {
  event.preventDefault();
  const changedMemberships = getChangedMemberships();

  for (const membership of changedMemberships) {
    const result = await useFetch(
      `http://127.0.0.1:8000/api/Memberships/${membership.membership_id}`,
      {
        method: "PUT",
        body: {
          membership_name: membership.membership_name,
          hierarchy: membership.hierarchy,
        },
      }
    );
    console.log(result);
  }
};

const archive = async (membership) => {
    const result = await useFetch(
      `http://127.0.0.1:8000/api/Memberships/${membership.membership_id}`,
      {
        method: "DELETE",
      }
    );
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
                  <th class="p-2 whitespace-normal"></th>
                </tr>
              </thead>
              <tbody class="text-sm text-center divide-y divide-slate-200">
                <tr
                  v-for="membership in originalMemberships"
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

                  <td class="p-2 whitespace-normal">
                    <button
                      @click.prevent="archive(membership)"
                      class="cursor-pointer text-red-600 hover:text-red-500 px-1 py-1 rounded-lg"
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
                          d="M6 18 18 6M6 6l12 12"
                        />
                      </svg>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
            <ButtonPrimarySmall @click.prevent="addNewMembership">
              Add Another Member
            </ButtonPrimarySmall>
          </div>
        </div>
      </div>
      <ButtonPrimarySmall> Submit </ButtonPrimarySmall>
    </form>
  </div>
</template>
