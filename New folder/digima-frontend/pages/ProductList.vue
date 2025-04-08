<script setup>
// Layout
definePageMeta({
  layout: "guest-layout",
});

// Fetching the API
const { data: items } = await useFetch("http://127.0.0.1:8000/api/Items");
const { data: categories } = await useFetch(
  "http://127.0.0.1:8000/api/ProductCategory"
);
const { data: subCategories } = await useFetch(
  "http://127.0.0.1:8000/api/ProductSubCategory"
);
</script>

<template>
  <div class="space-y-5">
    <div>
      <p class="text-2xl font-medium">Trial Package</p>
    </div>
    <div class="flex">
      <!-- Sidebar -->
      <aside class="w-[30%]">
        <div class="space-y-2">
          <p class="text-lg font-medium">Type</p>
          <div class="flex flex-col items-start">
            <button class="cursor-pointer hover:underline">
              <span class="text-medium font-medium">Products/Items Only</span>
            </button>
            <button class="cursor-pointer hover:underline">
              <span class="text-medium font-medium"
                >Membership Package Only</span
              >
            </button>
          </div>

          <p class="text-lg font-medium">Category</p>
          <div class="flex flex-col items-start">
            <button class="cursor-pointer hover:underline">
              <span class="text-medium font-medium">All</span>
            </button>
            <div v-for="category in categories" :key="category.category_id">
              <button class="cursor-pointer hover:underline">
                <span class="text-medium font-medium">{{
                  category.category_name
                }}</span>
              </button>
            </div>
          </div>

          <p class="text-lg font-medium">SubCategory</p>
          <div class="flex flex-col items-start">
            <button class="cursor-pointer hover:underline">
              <span class="text-medium font-medium">All</span>
            </button>
            <div
              v-for="subCategory in subCategories"
              :key="subCategory.subcategory_id"
            >
              <button class="cursor-pointer hover:underline">
                <span class="text-medium font-medium">{{
                  subCategory.sub_category_name
                }}</span>
              </button>
            </div>
          </div>
        </div>
      </aside>

      <!-- Main -->
      <main class="flex-1">
        <!-- Products -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
          <div v-for="item in items" :key="item.item_id">
            <NuxtLink :to="`/productdescription${item.item_id}`">
              <Card>
                <div class="space-y-4">
                  <Logo class="w-auto h-50" />
                  <div>
                    <p class="text-lg font-bold">{{ item.item_sku }}</p>
                    <div v-if="item.item_category">
                      <p class="text-md font-base text-gray-500">
                        {{ item.categories.category_name }}
                        <span v-if="item.subcategories?.sub_category_name">
                          > {{ item.subcategories.sub_category_name }}
                        </span>
                      </p>
                    </div>
                    <div v-else>
                      <p class="text-md font-base text-gray-500">--</p>
                    </div>
                    <p class="text-md font-medium">₱ {{ item.item_price }}</p>
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
