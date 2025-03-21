<script setup>
// Layout
definePageMeta({
  layout: "guest-layout",
});

const count = ref(0);

function increment() {
  count.value++;
}

function decrement() {
  count.value--;
}
</script>

<template>
  <div class="space-y-20">
    <div class="flex justify-center space-x-10">
      <!-- Main -->
      <main class="">
        <div class="space-y-2">
          <p class="text-2xl font-medium">Cart</p>
          <div class="flex justify-between space-x-2 gap-40">
            <div class="flex space-x-2">
              <Logo class="w-auto h-40" />
              <!-- Short Description -->
              <div>
                <p href="" class="text-base font-semibold">Trial Package</p>
                <p class="text-md font-base text-gray-500">
                  Category > Subcategory
                </p>
              </div>
            </div>
            <p class="text-md font-medium">₱ 500.00</p>
          </div>
          <!-- Quantity Buttons -->
          <span
            class="space-x-3 border border-gray-300 rounded-full flex items-center"
          >
            <span>
              <button
                class="cursor-pointer rounded-full p-2 hover:bg-gray-200"
                @click="decrement"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  fill="currentColor"
                  class="bi bi-dash"
                  viewBox="0 0 16 16"
                >
                  <path
                    d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8"
                  />
                </svg>
              </button>
            </span>

            <span> {{ count ? count : "" }} </span>

            <div>
              <button
                class="cursor-pointer rounded-full p-2 hover:bg-gray-200"
                @click="increment"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  fill="currentColor"
                  class="bi bi-plus"
                  viewBox="0 0 16 16"
                >
                  <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"
                  />
                </svg>
              </button>
            </div>
          </span>

          <hr class="h-px w-full bg-slate-200 border-0" />
        </div>

        <!--  -->
      </main>

      <!-- Sidebar -->
      <aside class="w-[25vw]">
        <div class="space-y-2">
          <p class="text-2xl font-medium">Summary</p>
          <div class="flex justify-between">
            <p class="text-lg font-medium">Subtotal</p>
            <p class="text-md font-base">₱ 500.00</p>
          </div>
          <div class="flex justify-between">
            <p class="text-lg font-medium">Shipping Fee</p>
            <p class="text-md font-base">₱ 85.00</p>
          </div>
          <hr class="h-px w-full bg-slate-200 border-0" />
          <div class="flex justify-between">
            <p class="text-lg font-medium">Total</p>
            <p class="text-md font-base">₱ 585.00</p>
          </div>
          <hr class="h-px w-full bg-slate-200 border-0" />
          <PrimaryButton>Guest Checkout</PrimaryButton>
          <PrimaryButton>Member Checkout</PrimaryButton>
        </div>
      </aside>
    </div>

    <!-- You Might Also Like -->
    <div class="">
      <p class="text-2xl font-medium">You Might Also Like</p>
      <div class="flex space-x-4">
        <NuxtLink to="/productdescription">
          <Card>
            <div class="flex flex-col space-y-4">
              <Logo class="w-auto h-50" />
              <div>
                <p class="text-lg font-bold">Pharma Zinc</p>
                <p class="text-md font-base text-gray-500">Trial Package</p>
                <p class="text-md font-medium">₱ 500.00</p>
              </div>
            </div>
          </Card>
        </NuxtLink>
      </div>
    </div>
  </div>
</template>
