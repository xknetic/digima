<script setup>
import { ref, onMounted } from 'vue';

const isVisible = ref(true);

onMounted(() => {
  setTimeout(() => {
    isVisible.value = false;
  }, 2000); // Close after 2 seconds
});
</script>

<template>
  <div v-if="isVisible" class="flex flex-col gap-2 w-60 sm:w-72 text-[10px] sm:text-xs z-50">
    <div
      class="error-alert cursor-default flex items-center justify-between w-full h-12 sm:h-14 rounded-lg bg-gray-100 px-[10px] shadow-md"
    >
      <div class="flex gap-2">
        <div class="text-[#d65563] bg-white/5 backdrop-blur-xl p-1 rounded-lg">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-6 h-6"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"
            ></path>
          </svg>
        </div>
        <div>
          <p class="font-medium">Please try again</p>
          <p class="font-medium text-xs text-gray-700"><slot /></p>
        </div>
      </div>
      <button
        class="text-gray-600 hover:bg-white/10 p-1 rounded-md transition-colors ease-linear"
        @click="isVisible = false"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="w-6 h-6"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M6 18 18 6M6 6l12 12"
          ></path>
        </svg>
      </button>
    </div>
  </div>
</template>
