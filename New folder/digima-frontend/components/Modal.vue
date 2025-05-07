<template>
    <Teleport to="body">
      <transition name="fade" @before-enter="beforeEnter" @enter="enter" @leave="leave">
        <div v-if="show" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50" @click.self="close">
          <div class="">
            <slot />
          </div>
        </div>
      </transition>
    </Teleport>
  </template>
  
  <script setup>
  const props = defineProps({
    show: Boolean
  });
  const emit = defineEmits(['close']);
  
  const close = () => emit('close');
  
  // Transition hooks
  const beforeEnter = (el) => {
    el.style.opacity = 0;
  };
  
  const enter = (el, done) => {
    el.offsetHeight; // Trigger reflow
    el.style.transition = 'opacity 0.5s ease';
    el.style.opacity = 1;
    done();
  };
  
  const leave = (el, done) => {
    el.style.transition = 'opacity 0.5s ease';
    el.style.opacity = 0;
    done();
  };
  </script>
  
  <style scoped>
  /* Optional: Add fade transition in Tailwind if not defined in JS */
  .fade-enter-active, .fade-leave-active {
    transition: opacity 0.5s ease;
  }
  .fade-enter, .fade-leave-to {
    opacity: 0;
  }
  </style>
  