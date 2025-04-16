<script setup>
const isSidebarOpen = ref(false);
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
  localStorage.removeItem('slots');
  localStorage.removeItem('cart');
  window.location.reload();
};
</script>

<template>
  <div class="w-screen h-screen">
    <div class="flex">
      <!-- Sidebar -->
      <aside
        :class="isSidebarOpen ? 'w-[15vw]' : 'w-19 xl:visible xl:block hidden'"
        class="bg-white flex flex-col justify-between rounded-lg transition-all duration-300"
      >
        <nav
          class="border-r-1 border-slate-200 flex flex-col justify-between h-screen"
        >
          <!-- top -->
          <div class="px-4 py-2 space-y-4">
            <SwitchAccount />

            <!-- Navigations -->
            <div class="space-y-1">
              <ResponsiveNavLink
                class="items-center"
                :href="'/dashboard'"
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

              <ResponsiveNavLink class="items-center" :href="'/transactionsummary'">
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
                      d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0 0 20.25 18V6A2.25 2.25 0 0 0 18 3.75H6A2.25 2.25 0 0 0 3.75 6v12A2.25 2.25 0 0 0 6 20.25Z"
                    />
                  </svg>
                </div>
                <span class="truncate">Transaction Summary</span>
              </ResponsiveNavLink>

              <ResponsiveNavLink class="items-center" :href="'/'">
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
                      d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"
                    />
                  </svg>
                </div>
                <span class="truncate">Code & Pin</span>
              </ResponsiveNavLink>

              <ResponsiveNavLink class="items-center" :href="'/'">
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
                <span class="truncate">Genealogy</span>
              </ResponsiveNavLink>

              <ResponsiveNavLink class="items-center" :href="'/'">
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
                      d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z"
                    />
                  </svg>
                </div>
                <span class="truncate">Referrals</span>
              </ResponsiveNavLink>

              <ResponsiveNavLink class="items-center" :href="'/'">
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
                      d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"
                    />
                  </svg>
                </div>
                <span class="truncate">E-Commerce</span>
              </ResponsiveNavLink>

              <ResponsiveNavLink class="items-center" :href="'/'">
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
                      d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"
                    />
                  </svg>
                </div>
                <span class="truncate">My Order</span>
              </ResponsiveNavLink>
            </div>
          </div>

          <!-- Bottom -->
          <div>
            <Dropdown
              :align="'right'"
              :width="'48'"
              contentClasses="bg-white"
              direction="top"
            >
              <!-- Trigger Slot -->
              <template #trigger>
                <hr class="h-px w-full bg-slate-200 border-0" />
                <div class="px-4 py-2">
                  <button
                    class="cursor-pointer hover:bg-slate-200 px-2 py-1 rounded-md w-full text-md font-base flex justify-between"
                  >
                    <div class="flex space-x-1 w-full">
                      <div class="bg-black rounded-full">as..</div>
                      <span class="truncate">{{ data.first_name }} {{ data.last_name }}</span>
                    </div>
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
                        d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"
                      />
                    </svg>
                  </button>
                </div>
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
        </nav>
      </aside>

      <!-- Main -->
      <main class="flex-1 overflow-auto">
        <!-- top navigation -->
        <nav class="border-b-1 border-slate-200 w-full">
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
            <NuxtLink
              to="/Cart"
              class="cursor-pointer hover:bg-slate-200 p-1 rounded-lg"
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
                  d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"
                />
              </svg>
            </NuxtLink>
          </div>
        </nav>
        <slot />
      </main>
    </div>
    <!-- Optional -->
    <!-- <footer>...</footer> -->
  </div>
</template>
