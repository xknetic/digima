<script setup>
// Layout
definePageMeta({
  layout: "authenticated-layout",
  path: "/admin/dashboard",
  name: "Home",
  middleware: "auth",
})
</script>

<template>
  <div>
    <div>

    </div>
    
    <div class="flex justify-between">
      <!-- Total Members -->
      <Card>
        <p> Total Members </p>
        <h2> 133 </h2>
        <hr class="h-px my-2 bg-gray-200 border-0">
        <div class="flex justify-end">
          0 this week
        </div>
      </Card>

      <!-- Total Active Slots -->
      <Card>
        <p> Total Active Slots </p>
        <h2> 205 </h2>
        <hr class="h-px my-2 bg-gray-200 border-0">
        <div class="flex justify-end">
          0 this week
        </div>
      </Card>

      <!-- Inactive Slots -->
      <Card>
        <p> Total Inactive Slots </p>
        <h2> 26 </h2>
        <hr class="h-px my-2 bg-gray-200 border-0">
        <div class="flex justify-end">
          0 this week
        </div>
      </Card>

      <!-- Total Sales -->
      <Card>
        <p> Total Sales </p>
        <h2> 48.5k </h2>
        <hr class="h-px my-2 bg-gray-200 border-0">
        <div class="flex justify-end">
          0 this week
        </div>
      </Card>
    </div>
  </div>
</template>
