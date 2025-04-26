<script setup>
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
    <header>
      <!-- Right Side -->
      <div>
        <Dropdown :align="'right'" :width="'48'" contentClasses="bg-white">
          <!-- Trigger Slot -->
          <template #trigger>
            <button
              class="cursor-pointer hover:bg-slate-200 px-2 py-1 rounded-lg flex space-x-2 items-center"
            >
              <div class="bg-black rounded-full">as..</div>
              <span class="">{{ data.first_name }} {{ data.last_name }}</span>
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
    </header>
    <slot />
  </div>
</template>
