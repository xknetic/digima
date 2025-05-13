<script setup>
import { computed, onMounted, onUnmounted, ref, watch, nextTick } from 'vue';

const props = defineProps({
  align: {
    type: String,
    default: 'right', // Options: left, right, center
  },
  width: {
    type: String,
    default: '48',
  },
  contentClasses: {
    type: String,
    default: 'py-1 bg-white',
  },
  direction: {
    type: String,
    default: 'bottom', // Options: bottom, top
  },
});

const open = ref(false);
const triggerEl = ref(null);
const dropdown = ref(null);
const dropdownStyles = ref({});

// Close on ESC key
const closeOnEscape = (e) => {
  if (open.value && e.key === 'Escape') {
    open.value = false;
  }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));
onUnmounted(() => document.removeEventListener('keydown', closeOnEscape));

const widthClass = computed(() => {
  return {
    48: 'w-48',
    full: 'w-full',
  }[props.width.toString()] || '';
});

const alignmentClasses = computed(() => {
  if (props.align === 'left') {
    return 'origin-top-left';
  } else if (props.align === 'right') {
    return 'origin-top-right';
  } else {
    return 'origin-top';
  }
});

// Update dropdown position
watch(open, async (isOpen) => {
  if (isOpen) {
    await nextTick();
    const triggerRect = triggerEl.value.getBoundingClientRect();
    const dropdownEl = dropdown.value;

    if (!dropdownEl) return;

    const dropdownHeight = dropdownEl.offsetHeight;
    const dropdownWidth = dropdownEl.offsetWidth;

    const top = props.direction === 'top'
      ? triggerRect.top - dropdownHeight
      : triggerRect.bottom;

    const left = props.align === 'right'
      ? triggerRect.right - dropdownWidth
      : triggerRect.left;

    dropdownStyles.value = {
      position: 'absolute',
      top: `${top}px`,
      left: `${left}px`,
      zIndex: 9999,
    };
  }
});
</script>

<template>
  <div class="relative inline-block">
    <!-- Trigger -->
    <div @click="open = !open" ref="triggerEl">
      <slot name="trigger" />
    </div>

    <!-- Overlay for click outside -->
    <div v-show="open" class="fixed inset-0 z-40" @click="open = false" />

    <!-- Dropdown content using teleport -->
    <teleport to="body">
      <Transition
        enter-active-class="transition ease-out duration-200"
        enter-from-class="opacity-0 scale-95"
        enter-to-class="opacity-100 scale-100"
        leave-active-class="transition ease-in duration-75"
        leave-from-class="opacity-100 scale-100"
        leave-to-class="opacity-0 scale-95"
      >
        <div
          v-show="open"
          ref="dropdown"
          class="rounded-md shadow-lg"
          :class="[widthClass, alignmentClasses]"
          :style="dropdownStyles"
          @click="open = false"
        >
          <div class="rounded-md ring-1 ring-slate-200 ring-opacity-5" :class="contentClasses">
            <slot name="content" />
          </div>
        </div>
      </Transition>
    </teleport>
  </div>
</template>
