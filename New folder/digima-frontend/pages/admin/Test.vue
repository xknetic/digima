<script setup>
function handleClick(row, col) {
  console.log(`Clicked cell: ${row},${col}`);
}
</script>

<template>
  <div class="w-screen h-screen">
    <div class="flex space-x-5 justify-center items-center h-full">
      <!-- Extra sm -->
      <button
        class="px-2 py-1 text-xs font-semibold rounded shadow-sm bg-indigo-600 text-white hover:bg-indigo-500 focus:outline-none"
      >
        Button text
      </button>
      <!-- Small -->
      <button
        class="px-3 py-1.5 text-sm font-semibold rounded-md shadow-sm bg-indigo-600 text-white hover:bg-indigo-500 focus:outline-none"
      >
        Button text
      </button>
      <!-- Medium -->
      <button
        class="px-4 py-2 text-sm font-semibold rounded-md shadow-sm bg-indigo-600 text-white hover:bg-indigo-500 focus:outline-none"
      >
        Button text
      </button>
      <!-- large -->
      <button
        class="px-4 py-2 text-base font-semibold rounded-md shadow-sm bg-indigo-600 text-white hover:bg-indigo-500 focus:outline-none"
      >
        Button text
      </button>
      <!-- extralarge -->
      <button
        class="px-5 py-2.5 text-base font-semibold rounded-md shadow-sm bg-indigo-600 text-white hover:bg-indigo-500 focus:outline-none"
      >
        Button text
      </button>
    </div>
  </div>


   <table>
    <tr v-for="row in 3" :key="row">
      <td v-for="col in 3" :key="col">
        <button @click="handleClick(row, col)">
          {{ `${row},${col}` }}
        </button>
      </td>
    </tr>
  </table>
</template>
