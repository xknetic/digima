<script setup>
import { useRouter } from "vue-router";

const router = useRouter();

// Logout function
const logout = () => {
  // Remove token and expiration time from localStorage
  localStorage.removeItem('auth_token');
  localStorage.removeItem('auth_token_expiry');

  // Redirect user to the login page
  router.push('/login');
};
</script>

<template>
  <div class="flex flex-col bg-slate-100 w-screen h-screen">
    <!-- top navigation -->
    <nav class="flex justify-between items-center py-4 px-5">
      <div class="w-auto flex justify-between space-x-5 items-center pl-4">
        <Burger />
        <h4>LIVEWELL</h4>
      </div>

      <div class="flex space-x-2 items-center">
        <Dropdown :align="'right'" :width="'48'" contentClasses="p-2 bg-white">
          <!-- Trigger Slot -->
          <template #trigger>
            <button class="cursor-pointer flex items-center space-x-2">
              <h4>Administrator</h4>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                fill="currentColor"
                class="bi bi-caret-down"
                viewBox="0 0 16 16"
              >
                <path
                  d="M3.204 5h9.592L8 10.481zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659"
                />
              </svg>
            </button>
          </template>

          <!-- Content Slot -->
          <template #content>
            <DangerButton @click="logout">
              <span>
                Sign out
              </span>
            </DangerButton>
          </template>
        </Dropdown>
      </div>
    </nav>
    <main class="flex-1 flex flex-row space-x-5 px-5">
      <!-- Left sidebar -->
      <!-- <aside class="w-[40vh] h-full bg-white shadow-md rounded-lg">
                <nav class="p-4">
                    sasd
                </nav>
            </aside> -->
      <aside class="w-[10vh] h-full bg-white shadow-md rounded-lg pt-4">
        <nav class="p-4 flex flex-col justify-center items-center space-y-2">
          <ResponsiveNavLink :href="'/dashboard'">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="25"
              height="25"
              fill="currentColor"
              class="bi bi-pie-chart"
              viewBox="0 0 16 16"
            >
              <path
                d="M7.5 1.018a7 7 0 0 0-4.79 11.566L7.5 7.793zm1 0V7.5h6.482A7 7 0 0 0 8.5 1.018M14.982 8.5H8.207l-4.79 4.79A7 7 0 0 0 14.982 8.5M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8"
              />
            </svg>
          </ResponsiveNavLink>
          <ResponsiveNavLink :href="'/memberlist'">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="25"
              height="25"
              fill="currentColor"
              class="bi bi-person"
              viewBox="0 0 16 16"
            >
              <path
                d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"
              />
            </svg>
          </ResponsiveNavLink>
          <ResponsiveNavLink :href="'/product'">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="25"
              height="25"
              fill="currentColor"
              class="bi bi-box-seam"
              viewBox="0 0 16 16"
            >
              <path
                d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.426L5.596 5 8 5.961 14.154 3.5zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z"
              />
            </svg>
          </ResponsiveNavLink>
          <ResponsiveNavLink :href="'/rewardpoints'">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="25"
              height="25"
              fill="currentColor"
              class="bi bi-cash"
              viewBox="0 0 16 16"
            >
              <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
              <path
                d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2z"
              />
            </svg>
          </ResponsiveNavLink>
          <ResponsiveNavLink :href="'/achieversreward'">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="25"
              height="25"
              fill="currentColor"
              class="bi bi-trophy"
              viewBox="0 0 16 16"
            >
              <path
                d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5q0 .807-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33 33 0 0 1 2.5.5m.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935m10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935M3.504 1q.01.775.056 1.469c.13 2.028.457 3.546.87 4.667C5.294 9.48 6.484 10 7 10a.5.5 0 0 1 .5.5v2.61a1 1 0 0 1-.757.97l-1.426.356a.5.5 0 0 0-.179.085L4.5 15h7l-.638-.479a.5.5 0 0 0-.18-.085l-1.425-.356a1 1 0 0 1-.757-.97V10.5A.5.5 0 0 1 9 10c.516 0 1.706-.52 2.57-2.864.413-1.12.74-2.64.87-4.667q.045-.694.056-1.469z"
              />
            </svg>
          </ResponsiveNavLink>
          <ResponsiveNavLink :href="'/cashinprocessing'">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="25"
              height="25"
              fill="currentColor"
              class="bi bi-basket3"
              viewBox="0 0 16 16"
            >
              <path
                d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM3.394 15l-1.48-6h-.97l1.525 6.426a.75.75 0 0 0 .729.574h9.606a.75.75 0 0 0 .73-.574L15.056 9h-.972l-1.479 6z"
              />
            </svg>
          </ResponsiveNavLink>
          <ResponsiveNavLink :href="'/marketingplan'">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="25"
              height="25"
              fill="currentColor"
              class="bi bi-calendar-range"
              viewBox="0 0 16 16"
            >
              <path
                d="M9 7a1 1 0 0 1 1-1h5v2h-5a1 1 0 0 1-1-1M1 9h4a1 1 0 0 1 0 2H1z"
              />
              <path
                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"
              />
            </svg>
          </ResponsiveNavLink>
        </nav>
      </aside>

      <!-- Main content -->
      <article class="flex-1 w-full">
        <slot />
      </article>

      <!-- Right sidebar (optional) -->
      <!-- <nav class="w-[25%]">...</nav> -->
    </main>
    <!-- Optional -->
    <!-- <footer>...</footer> -->
  </div>
</template>
