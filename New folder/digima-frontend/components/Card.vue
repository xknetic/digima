<template>
  <!-- <div class="bg-white w-[30vh] p-5 h-35 shadow-md relative rounded-md">
        <slot />
    </div> -->

  <div class="flex flex-col bg-gray-100 border border-gray-300 rounded-xl">
    <div class="p-6">
      <div
        class="grid items-center justify-center w-full grid-cols-1 text-left"
      >
        <slot />
      </div>
    </div>
  </div>
</template>
