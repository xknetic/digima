<script setup>
import {ref} from 'vue';

// Dropdown
const Content = ref(true)

function invdrop(){
    Content.value = !Content.value
}
</script>

<template>
    <div @click="invdrop">
        <slot name="trigger" />
    </div>
    
    <Transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="opacity-0 scale-95"
            enter-to-class="opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-95"
        >
        <div v-if="Content">
            <slot name="content" />
        </div>
    </Transition>
</template>