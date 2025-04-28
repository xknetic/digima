<script setup>
import { ref, watch } from "vue";

const props = defineProps({
  id: {
    type: String,
    default: "",
  },
  placeholder: {
    type: String,
    default: "",
  },
  type: {
    type: [Number, String],
    default: "text",
  },
  min: {
    type: Number,
    default: -Infinity,
  },
  max: {
    type: Number,
    default: Infinity,
  },
  step: {
    type: Number,
    default: 1,
  },
});

const emit = defineEmits();
const inputValue = ref("");

watch(inputValue, (newValue) => {
  emit("update:modelValue", newValue);
});

// const showPassword = ref(false);

// const type = computed(() => (showPassword.value ? "text" : "password"));
</script>

<template>
  <div class="text-input">
    <input
      v-bind="$attrs"
      v-model="inputValue"
      :id="id"
      :placeholder="placeholder"
      :type="type"
      :min="min"
      :max="max"
      :step="step"
      class="w-full bg-white text-sm border-1 border-gray-300 rounded-md px-2 py-1 focus:bg-white focus:outline-none focus:ring-1 focus:ring-gray-600 transition ease-in-out duration-150"
    />

    <!-- <div v-if="type == 'password'">
      <button @click="showPassword = !showPassword">
        <div v-if="showPassword == false">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="size-5"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"
            />
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
            />
          </svg>
        </div>
        <div v-else>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="size-5"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"
            />
          </svg>
        </div>
      </button>
    </div> -->
  </div>
</template>
