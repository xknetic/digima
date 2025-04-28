<template>
    <div class="relative" ref="dropdownContainer">
      <div
        class="flex justify-between items-center space-x-2 w-full bg-white text-sm border-1 border-gray-300 rounded-md px-2 py-1 cursor-pointer"
        @click="toggleDropdown"
        :class="{ 'border-blue-500': isOpen }"
      >
        <span>{{ selectedLabel || placeholder }}</span>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="size-5"
          :class="{
            'rotate-180 transition-all duration-200 ease-in-out': isOpen,
          }"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="m19.5 8.25-7.5 7.5-7.5-7.5"
          />
        </svg>
      </div>
  
      <ul
        v-if="isOpen"
        class="absolute top-full left-0 w-full mt-1 bg-white border-1 border-gray-300 rounded-md max-h-48 overflow-y-auto z-50"
      >
        <!-- Search Input -->
        <li class="">
          <input
            v-model="searchQuery"
            type="text"
            placeholder="Search..."
            class="w-full bg-white text-sm px-2 py-1 focus:bg-white focus:outline-none transition ease-in-out duration-150"
          />
        </li>

        <hr class="h-px bg-gray-200 border-0" />
  
        <!-- Filtered Options -->
        <li
          v-for="(option, index) in filteredOptions"
          :key="index"
          @click="selectOption(option)"
          class="p-2 text-sm cursor-pointer hover:bg-blue-500 hover:text-white transition-all duration-200 ease-in-out"
          :class="{
            'bg-blue-500 text-white': option.value === selectedValue,
          }"
        >
          {{ option.label }}
        </li>
      </ul>
    </div>
  </template>
  
  <script setup>
  import { ref, computed, onMounted, onBeforeUnmount } from "vue";
  
  // Define props
  const props = defineProps({
    options: {
      type: Array,
      required: true,
      validator(value) {
        return value.every((option) => option.label && option.value);
      },
    },
    modelValue: {
      type: [String, Number, Object],
      default: null,
    },
    placeholder: {
      type: String,
      default: "Select an option",
    },
  });
  
  // Define emit
  const emit = defineEmits(["update:modelValue", "selected"]);
  
  // Reactive state
  const isOpen = ref(false);
  const selectedValue = ref(props.modelValue?.value ?? props.modelValue);
  const searchQuery = ref("");
  
  // Computed property for selected label
  const selectedLabel = computed(() => {
    const selectedOption = props.options.find(
      (option) => option.value === selectedValue.value
    );
    return selectedOption ? selectedOption.label : "";
  });
  
  // Computed property for filtered options based on search query
  const filteredOptions = computed(() => {
    if (!searchQuery.value) return props.options;
    return props.options.filter((option) =>
      option.label.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
  });
  
  // Reference to dropdown container
  const dropdownContainer = ref(null);
  
  // Method to toggle dropdown visibility
  const toggleDropdown = () => {
    isOpen.value = !isOpen.value;
  };
  
  // Method to select an option
  const selectOption = (option) => {
    selectedValue.value = option.value;
    isOpen.value = false;
    emit("update:modelValue", selectedValue.value);
    emit("selected");
  };
  
  // Close the dropdown if clicked outside
  const handleClickOutside = (event) => {
    if (
      dropdownContainer.value &&
      !dropdownContainer.value.contains(event.target)
    ) {
      isOpen.value = false;
    }
  };
  
  // Add event listener when component is mounted
  onMounted(() => {
    document.addEventListener("click", handleClickOutside);
  });
  
  // Remove event listener when component is unmounted
  onBeforeUnmount(() => {
    document.removeEventListener("click", handleClickOutside);
  });
  </script>
  