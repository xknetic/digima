<script setup>
import { useRoute } from "vue-router";

const route = useRoute();
console.log(route.path)
;const isSidebarOpen = ref(false);
onMounted(() => {
  const savedSidebarState = localStorage.getItem("isSidebarOpen");
  if (savedSidebarState !== null) {
    isSidebarOpen.value = JSON.parse(savedSidebarState);
  }
});

const toggleSidebar = () => {
  isSidebarOpen.value = !isSidebarOpen.value;
  localStorage.setItem("isSidebarOpen", JSON.stringify(isSidebarOpen.value));
};

// Fetch user
const cookies = useCookie("auth_user_token");
const data = ref(null);

const result = await $fetch("http://127.0.0.1:8000/api/user", {
  headers: {
    Authorization: `Bearer ${cookies.value.token}`,
  },
});
data.value = result;

// Logout
const logout = async (event) => {
  event.preventDefault();
  const result = await $fetch("http://127.0.0.1:8000/api/logout", {
    method: "DELETE",
    headers: {
      Authorization: `Bearer ${cookies.value.token}`,
    },
  });
  cookies.value = null;
  window.location.reload();
};
</script>

<template>
  <div class="">
    <div class="flex">
      <!-- Sidebar -->
      <aside
        :class="isSidebarOpen ? 'w-[20vw]' : 'w-19 xl:visible xl:block hidden'"
        class="bg-white flex flex-col justify-between rounded-lg transition-all duration-300"
      >
        <nav
          class="border-r-1 border-slate-200 flex flex-col justify-between h-screen"
        >
          <!-- top -->
          <div class="px-4 py-2 space-y-4">
            <button
              class="hover:bg-slate-200 px-2 py-1 rounded-md w-full text-md font-medium flex space-x-1"
            >
              <div class="bg-black rounded-full">as..</div>
              <!-- Logo -->
              <span class="truncate">Logo Name</span>
            </button>

            <!-- Navigations -->
            <div class="space-y-1">
              <ResponsiveNavLink
                class="items-center"
                :href="'/admin/dashboard'"
              >
                <div class="rounded-full">
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
                      d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"
                    />
                  </svg>
                </div>
                <span class="truncate">Dashboard</span>
              </ResponsiveNavLink>

              <ResponsiveNavLink
                class="items-center"
                :href="'/admin/memberlist'"
              >
                <div class="rounded-full">
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
                      d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"
                    />
                  </svg>
                </div>
                <span class="truncate">Member List</span>
              </ResponsiveNavLink>

              <ResponsiveNavLink class="items-center" :href="'/admin/product'" :active="'/admin/items'">
                <div class="rounded-full">
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
                      d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9"
                    />
                  </svg>
                </div>
                <span class="truncate">Product</span>
              </ResponsiveNavLink>

              <DropDown2nd>
                <template #trigger>
                  <button
                    class="w-full cursor-pointer text-gray-700 hover:text-gray-900 hover:bg-slate-100 px-2 py-1 rounded-md text-md font-medium flex space-x-2 transition duration-150 ease-in-out"
                  >
                    <div class="rounded-full">
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
                          d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9"
                        />
                      </svg>
                    </div>
                    <span class="truncate">Reward Points</span>
                  </button>
                </template>

                <template #content>
                  <div class="flex space-x-2 px-[1.5vw]">
                    <div class="bg-gray-500 w-[1px]" />
                    <div class="space-y-1">
                      <ResponsiveNavLink
                        class="items-center"
                        :href="'/admin/items'"
                      >
                        <span class="truncate">Items</span>
                      </ResponsiveNavLink>

                      <ResponsiveNavLink
                        class="items-center"
                        :href="'/admin/items'"
                      >
                        <span class="truncate">Claimed Reward Points</span>
                      </ResponsiveNavLink>
                    </div>
                  </div>
                </template>
              </DropDown2nd>

              <ResponsiveNavLink
                class="items-center"
                :href="'/admin/achieversreward'"
              >
                <div class="rounded-full">
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
                      d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 0 0 7.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 0 0 2.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 0 1 2.916.52 6.003 6.003 0 0 1-5.395 4.972m0 0a6.726 6.726 0 0 1-2.749 1.35m0 0a6.772 6.772 0 0 1-3.044 0"
                    />
                  </svg>
                </div>
                <span class="truncate">Achievers Rewards</span>
              </ResponsiveNavLink>

              <ResponsiveNavLink class="items-center" :href="'/admin/orders'">
                <div class="rounded-full">
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
                      d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9"
                    />
                  </svg>
                </div>
                <span class="truncate">Cashier</span>
              </ResponsiveNavLink>
            </div>
          </div>

          <!-- Bottom -->
          <!-- <div>
            <hr class="h-px w-full bg-slate-200 border-0" />
            <div class="px-4 py-2">
              <button
                class="hover:bg-slate-200 px-2 py-1 rounded-md w-full text-md font-bold flex space-x-1"
              >
                <div class="bg-black rounded-full">as..</div>
                <span class="truncate">User</span>
              </button>
            </div>
          </div> -->
        </nav>
      </aside>

      <!-- Main -->
      <main class="flex-1">
        <div class="flex flex-col h-screen w-[80vw]">
          <!-- top navigation -->
          <nav class="border-b-1 border-slate-200">
            <div class="flex justify-between p-4 items-center">
              <!-- Left Side -->
              <div class="flex space-x-1 items-center">
                <button
                  @click="toggleSidebar"
                  class="cursor-pointer hover:bg-slate-200 px-2 py-1 rounded-lg flex space-x-2 items-center"
                >
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
                      d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"
                    />
                  </svg>
                </button>
                <span class="font-semibold"> {{ $route.name }} </span>
              </div>

              <!-- Right Side -->
              <div>
                <Dropdown
                  :align="'right'"
                  :width="'48'"
                  contentClasses="bg-white"
                >
                  <!-- Trigger Slot -->
                  <template #trigger>
                    <button
                      class="cursor-pointer hover:bg-slate-200 px-2 py-1 rounded-lg flex space-x-2 items-center"
                    >
                      <div class="bg-black rounded-full">as..</div>
                      <span class=""
                        >{{ data.first_name }} {{ data.last_name }}</span
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
                          d="m19.5 8.25-7.5 7.5-7.5-7.5"
                        />
                      </svg>
                    </button>
                  </template>

                  <!-- Content Slot -->
                  <template #content>
                    <div>
                      <hr class="h-px my-1 bg-gray-200 border-0" />

                      <div class="px-1 pb-1">
                        <ResponsiveNavLink class="items-center" @click="logout">
                          <div class="rounded-full">
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
                                d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"
                              />
                            </svg>
                          </div>
                          <span class="truncate">Logout</span>
                        </ResponsiveNavLink>
                      </div>
                    </div>
                  </template>
                </Dropdown>
              </div>
            </div>
          </nav>

          <div class="flex-1 overflow-auto">
            <slot />
          </div>
        </div>
      </main>
    </div>
    <!-- Optional -->
    <!-- <footer>...</footer> -->
  </div>
</template>
