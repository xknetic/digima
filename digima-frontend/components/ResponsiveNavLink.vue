<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'

const props = defineProps({
  href: String,
  active: {
    type: Boolean,
    default: false,
  },
})

const route = useRoute()
const isActive = computed(() => {
  return route.path === props.href
})

const classes = computed(() =>
  isActive.value
    // active Link
    ? 'cursor-pointer text-gray-950 bg-slate-100 px-2 py-1 rounded-md text-md font-medium flex space-x-2 transition duration-150 ease-in-out'
    // Inactive Link
    : 'cursor-pointer text-gray-700 hover:text-gray-900 hover:bg-slate-100 px-2 py-1 rounded-md text-md font-medium flex space-x-2 transition duration-150 ease-in-out'
)
</script>


<template>
  <a :href="href" :class="classes">
    <slot />
  </a>
</template>