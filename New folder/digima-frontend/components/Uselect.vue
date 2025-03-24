<template>
  <div class="uselect">
    <div
      class="uselect__selected"
      @click="toggleDropdown"
      :class="{ 'uselect__selected--open': isOpen }"
    >
      <span>{{ selectedLabel || placeholder }}</span>
      <i class="uselect__arrow"></i>
    </div>

    <ul v-if="isOpen" class="uselect__dropdown">
      <li
        v-for="(option, index) in options"
        :key="index"
        @click="selectOption(option)"
        class="uselect__dropdown-item"
        :class="{
          'uselect__dropdown-item--selected': option.value === selectedValue,
        }"
      >
        {{ option.label }}
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, computed, defineProps, defineEmits } from "vue";

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
    type: [String, Number],
    default: null,
  },
  placeholder: {
    type: String,
    default: "Select an option",
  },
});

// Define emit
const emit = defineEmits(["update:modelValue"]);

// Reactive state
const isOpen = ref(false);
const selectedValue = ref(props.modelValue || null);

// Computed property for selected label
const selectedLabel = computed(() => {
  const selectedOption = props.options.find(
    (option) => option.value === selectedValue.value
  );
  return selectedOption ? selectedOption.label : "";
});

// Method to toggle dropdown visibility
const toggleDropdown = () => {
  isOpen.value = !isOpen.value;
};

// Method to select an option
const selectOption = (option) => {
  selectedValue.value = option.value;
  isOpen.value = false;
  emit("update:modelValue", selectedValue.value);
};
</script>

<style scoped>
.uselect {
  position: relative;
  width: 200px;
}

.uselect__selected {
  padding: 10px;
  border: 1px solid #ccc;
  cursor: pointer;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-radius: 4px;
}

.uselect__selected--open {
  border-color: #007bff;
}

.uselect__arrow {
  border: solid #000;
  border-width: 0 2px 2px 0;
  display: inline-block;
  padding: 3px;
  transform: rotate(45deg);
  transition: transform 0.3s ease;
}

.uselect__dropdown {
  position: absolute;
  top: 100%;
  left: 0;
  width: 100%;
  margin-top: 2px;
  padding: 0;
  list-style-type: none;
  background-color: white;
  border: 1px solid #ccc;
  border-radius: 4px;
  max-height: 200px;
  overflow-y: auto;
}

.uselect__dropdown-item {
  padding: 8px;
  cursor: pointer;
}

.uselect__dropdown-item:hover,
.uselect__dropdown-item--selected {
  background-color: #007bff;
  color: white;
}
</style>
