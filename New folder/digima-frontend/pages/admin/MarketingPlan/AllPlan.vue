<script setup>
// Layout
definePageMeta({
  layout: "authenticated-layout",
  path: "/admin/allplan",
  middleware: "auth",
  name: "All Plan",
});

const planLabels = ref([]);

onMounted(async () => {
  const { data } = await useFetch("http://127.0.0.1:8000/api/MlmPlanLabels");

  if (data.value) {
    planLabels.value = data.value.filter((label) => label.mlm_plan_id !== null);
  }
});

const searchTerm = ref("");
const { filtered, filter } = useLocalSearch(planLabels, [
  "plan_code",
  "mlm_plans.mlm_genealogy_type",
  "mlm_plans.mlm_plan_trigger",
]);

const showOptions = ref(false);
</script>

<template>
  <div>
    <MarketingPlanNavigation />

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
            @click="showCurrencyConfig = true"
            class="cursor-pointer bg-black text-white px-4 py-1 text-sm font-semibold rounded-lg"
          >
            Currency Configuration
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
                <th class="py-3 px-4 whitespace-normal">Complan Name</th>
                <th class="p-2 whitespace-normal">Earning Label</th>
                <th class="p-2 whitespace-normal">Genealogy Type</th>
                <th class="p-2 whitespace-normal">Trigger</th>
                <th class="p-2 whitespace-normal">Status</th>
                <th class="p-2 whitespace-normal">Action</th>
              </tr>
            </thead>
            <tbody class="text-sm text-center divide-y divide-slate-200">
              <tr
                v-for="mlmplanlabel in filtered"
                :key="mlmplanlabel.mlm_label_id"
              >
                <td class="p-2 whitespace-normal">
                  {{ mlmplanlabel.mlm_plans?.mlm_plan_code }}
                </td>
                <td class="p-2 whitespace-normal">
                  {{ mlmplanlabel.plan_name }}
                </td>
                <td class="p-2 whitespace-normal">
                  {{ mlmplanlabel.mlm_plans?.mlm_genealogy_type }}
                </td>
                <td class="p-2 whitespace-normal">
                  {{ mlmplanlabel.mlm_plans?.mlm_plan_trigger }}
                </td>
                <td class="p-2 whitespace-normal">
                  <span
                    class="text-green-600 text-xs font-medium rounded-sm border border-green-600 px-2 py-1"
                    v-if="mlmplanlabel.mlm_plans?.mlm_plan_enable"
                  >
                    Active
                  </span>
                  <span
                    class="text-red-500 text-xs font-medium rounded-sm border border-red-500 px-2 py-1"
                    v-else
                  >
                    Inactive
                  </span>
                </td>
                <td class="p-2 whitespace-normal">
                  <span>
                    <button
                    @click="showOptions = true"
                      class="cursor-pointer hover:bg-slate-200 px-1 py-1 rounded-lg"
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
                          d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"
                        />
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                        />
                      </svg>
                    </button>
                  </span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- <div
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
        </div> -->
      </div>
    </div>

    <!-- Modal -->
    <Modal :show="showOptions" @close="showOptions = false">
      <div class="bg-white rounded-lg p-10">
        <CurrencyConfiguration />
      </div>
    </Modal>
  </div>
</template>
