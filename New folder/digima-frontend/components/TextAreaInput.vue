<template>
    <div class="text-input">
      <textarea
        v-bind="$attrs"
        v-model="inputValue"
        :id="id"
        :placeholder="placeholder"
        :type="type"
        class="w-full h-[20vh] bg-white text-sm border-1 border-gray-300 rounded-md px-2 py-1 focus:bg-white focus:outline-none focus:ring-1 focus:ring-gray-600 transition ease-in-out duration-150"
      />
    </div>
  </template>
  
  <script setup>
  import { ref, watch } from 'vue';
  
  const props = defineProps({
    id: {
      type: String,
      required: true,
    },
    placeholder: {
      type: String,
      default: '',
    },
    type: {
      type: String,
      default: 'text',
    },
  });
  
  const emit = defineEmits(); // define emit for emitting events
  const inputValue = ref('');
  
  watch(inputValue, (newValue) => {
    // Emit the updated value back to the parent using the correct event name for v-model
    emit('update:modelValue', newValue);
  });
  </script>