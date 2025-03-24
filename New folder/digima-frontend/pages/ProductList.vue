<script setup>
// Layout
definePageMeta({
  layout: "guest-layout",
});

// Fetching the API
const {
  data: items,
  error,
  refresh,
} = await useFetch("http://127.0.0.1:8000/api/Items");
</script>

<template>
  <div class="space-y-5">
    <div>
      <p class="text-2xl font-medium">Trial Package</p>
    </div>
    <div class="flex">
      <!-- Sidebar -->
      <aside class="w-[30%]">
        <div class="">
          <button class="cursor-pointer hover:underline">
            <span class="text-medium font-medium">Trial Package</span>
          </button>
        </div>
      </aside>

      <!-- Main -->
      <main class="flex-1 overflow-auto">
        <!-- Products -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
          <div v-for="item in items" :key="item.id">
            <NuxtLink to="/productdescription">
              <Card>
                <div class="space-y-4">
                  <Logo class="w-auto h-50" />
                  <div>
                    <p class="text-lg font-bold">{{ item.item_sku }}</p>
                    <p class="text-md font-base text-gray-500">Category > Subcategory</p>
                    <p class="text-md font-medium">₱ {{item.item_price}}</p>
                  </div>
                </div>
              </Card>
            </NuxtLink>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>
