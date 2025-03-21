<script setup>
// Layout
definePageMeta({
  layout: "guest-layout",
});
</script>

<template>
  <div class="flex flex-col space-y-20">
    <div class="flex flex-col items-center space-y-8">
      <p class="text-7xl font-bold">LIVEWELL MARKETING</p>
      <p class="font-semibold">Be Part of our Team</p>
      <!-- <Logo /> -->

      
    </div>

    <!-- Newly Added Products -->
    <div class="">
      <p class="text-2xl font-medium">Newly Added Products</p>
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
