<script setup>
// Cookies
const cookies = useCookie("auth_user_token");

let prevScrollPos = window.pageYOffset;
const navbar = document.getElementById("navbar");

window.onscroll = function () {
  let currentScrollPos = window.pageYOffset;

  if (prevScrollPos > currentScrollPos) {
    // Scrolling up
    navbar.classList.remove("transform", "-translate-y-full");
  } else {
    // Scrolling down
    navbar.classList.add("transform", "-translate-y-full");
  }

  prevScrollPos = currentScrollPos;
};

// Tracking cookies
const isAuth = ref(false);
watchEffect(() => {
  if (cookies.value) {
    isAuth.value = true;
  } else {
    isAuth.value = false;
  }
});
</script>

<template>
  <div class="h-screen">
    <!-- Top nav (optional) -->
    <div class="bg-slate-200 flex space-x-2 justify-between text-xs p-2">
      <p>
        WELCOME TO THE
        <span class="font-semibold">LIVEWELL MARKETING CORPORATION!</span> BE
        PART OF OUR FAST GROWING COPANY
        <span class="font-semibold"><a href="">JOIN NOW!</a></span>
      </p>
      <div v-if="isAuth">
        <NuxtLink to="/login" class="font-semibold">
          {{ cookies.user.first_name }} {{ cookies.user.last_name }}
        </NuxtLink>
      </div>
      <div v-else>
        <div class="flex space-x-2">
          <NuxtLink to="/register" class=""> REGISTER </NuxtLink>
          <NuxtLink to="/login" class="font-semibold"> LOGIN </NuxtLink>
        </div>
      </div>
    </div>
    <!-- Top Navigation -->
    <div id="navbar" class="">
      <nav class="flex justify-between items-center px-5 my-4">
        <!-- Icon -->
        <div>ICON</div>

        <!-- Navigation -->
        <div class="flex justify-between items-center space-x-2">
          <NuxtLink
            to="/"
            class="text-base font-medium hover:border-b-2 hover:border-radius-full transition ease-in-out delay-150 duration-300"
            >HOME</NuxtLink
          >
          <NuxtLink
            to="/aboutus"
            class="text-base font-medium hover:border-b-2 hover:border-radius-full transition ease-in-out delay-150 duration-300"
            >ABOUT US</NuxtLink
          >
          <NuxtLink
            to="productlist"
            class="text-base font-medium hover:border-b-2 hover:border-radius-full transition ease-in-out delay-150 duration-300"
            >PRODUCTS</NuxtLink
          >
        </div>

        <!-- Left Side Search and Add to Cart -->
        <div class="flex justify-between items-center space-x-2">
          <button class="cursor-pointer hover:bg-slate-100 rounded-md p-2">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="21"
              height="21"
              fill="currentColor"
              class="bi bi-search"
              viewBox="0 0 16 16"
            >
              <path
                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"
              />
            </svg>
          </button>

          <!-- Add to cart button -->
          <NuxtLink
            to="/cart"
            class="cursor-pointer hover:bg-slate-100 rounded-md p-2 relative"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              fill="currentColor"
              class="bi bi-cart2"
              viewBox="0 0 16 16"
            >
              <path
                d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l1.25 5h8.22l1.25-5zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"
              />
            </svg>
          </NuxtLink>
        </div>
      </nav>
    </div>

    <main class="my-8 mx-10">
      <slot />
    </main>

    <footer class="px-10">
      <hr class="h-px w-full mb-10 bg-slate-200 border-0" />
      <div>
        <div class="flex justify-start space-x-10">
          <div class="flex flex-col space-y-2">
            <p class="text-base font-bold">Company</p>
            <a href="" class="text-base font-medium"> About Us</a>
            <a href="" class="text-base font-medium"> Mission</a>
            <a href="" class="text-base font-medium"> Company</a>
          </div>

          <div class="flex flex-col space-y-2">
            <p class="text-base font-bold">TERMS AND CONDITIONS</p>
            <a href="" class="text-base font-medium"> Terms of Service</a>
            <a href="" class="text-base font-medium"> Shipping Policy </a>
            <a href="" class="text-base font-medium"> Refund Policy</a>
          </div>

          <div class="flex flex-col space-y-2">
            <p class="text-base font-bold">OTHERS</p>
            <a
              href=""
              class="text-base font-medium flex items-center space-x-2"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                fill="currentColor"
                class="bi bi-facebook"
                viewBox="0 0 16 16"
              >
                <path
                  d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"
                />
              </svg>
              <span> Facebook </span>
            </a>
            <a
              href=""
              class="text-base font-medium flex items-center space-x-2"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                fill="currentColor"
                class="bi bi-envelope-fill"
                viewBox="0 0 16 16"
              >
                <path
                  d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z"
                />
              </svg>
              <span> Email </span>
            </a>
            <a
              href=""
              class="text-base font-medium flex items-center space-x-2"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                fill="currentColor"
                class="bi bi-telephone-fill"
                viewBox="0 0 16 16"
              >
                <path
                  fill-rule="evenodd"
                  d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"
                />
              </svg>
              <span> Contact Number </span>
            </a>
            <a
              href=""
              class="text-base font-medium flex items-center space-x-2"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                fill="currentColor"
                class="bi bi-geo-alt-fill"
                viewBox="0 0 16 16"
              >
                <path
                  d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"
                />
              </svg>
              <span> Address </span>
            </a>
          </div>
        </div>

        <div class="my-10">
          Copyright 2024 © All Rights Reserved | LiveWell Marketing Corporation
        </div>
      </div>
    </footer>
  </div>
</template>
