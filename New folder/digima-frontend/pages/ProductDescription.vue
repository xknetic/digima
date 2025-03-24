<script setup>
// Layout
definePageMeta({
  layout: "guest-layout",
});
</script>

<template>
  <div class="flex flex-col space-y-20">
    <div class="flex justify-center items-center space-x-10">
      <div class="bg-white shadow-md rounded-lg p-4">
        <Logo />
      </div>
      <div class="flex flex-col space-y-10 w-lg">
        <div class="flex flex-col space-y-2">
          <a href="" class="text-base font-semibold">Trial Package</a>
          <div>
            <p class="text-2xl font-bold">Pharma Zinc</p>
            <p class="text-sm font-bold">1 Capsule</p>
          </div>
          <div class="flex flex-end text-lg justify-between">
            <p>₱ 500.00</p>
            <p>★★★★★</p>
          </div>
        </div>

        <div>
          <p class="text-base font-bold">Description</p>
          <hr class="h-px w-full my-2 bg-slate-200 border-0" />
          <p class="text-sm font-medium">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet
            eligendi id error, necessitatibus quia harum, modi ut sed recusandae
            totam illo praesentium, aut vel magnam est ipsa laborum suscipit
            rerum!
          </p>
        </div>

        <PrimaryButton> Add to Cart</PrimaryButton>
      </div>
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
