<script setup>
// Layout
definePageMeta({
  layout: "member-layout",
  path: "/genealogy",
  name: "Genealogy",
  middleware: "member",
});

import { ref, onMounted } from 'vue'
import { VueFlow, useVueFlow } from '@vue-flow/core'

const { onConnect, addEdges } = useVueFlow()
const nodes = ref([])
const edges = ref([])

// Fetch user
const cookies = useCookie("auth_user_token");
const data = ref(null);
// Fetch data
const { data: slots } = await useFetch("http://127.0.0.1:8000/api/Slots")
const result = await $fetch("http://127.0.0.1:8000/api/user", {
  headers: {
    Authorization: `Bearer ${cookies.value.token}`,
  },
});
data.value = result;

const userFilter = slots.value.filter((slot) => slot.slot_user_id == data.value.id);

// Positioning helper (for demo purposes)
function getPosition(index) {
  return {
    x: 100 + (index % 5) * 200,
    y: 100 + Math.floor(index / 5) * 150,
  }
}

// Transform slots into VueFlow nodes and edges
nodes.value = userFilter.map((user, index) => ({
  id: user.slot_id?.toString() ?? `missing-id-${index}`,
  label: user.slot_username,
  position: getPosition(index),
}));


// edges.value = slots.value
//   .filter((slot) => slot.slot_sponsor != null && slot.id != null)
//   .map(slot => ({
//     id: `e${slot.slot_sponsor}-${slot.id}`,
//     source: slot.slot_sponsor.toString(),
//     target: slot.id.toString(),
//     type: 'default',
//   }))
console.log(nodes);

onMounted(() => {
  onConnect((params) => addEdges([params]))
})
</script>

<template>
    <div class="h-full bg-gray-50 rounded-md shadow-md p-4">
        <VueFlow
      v-model:nodes="nodes"
      v-model:edges="edges"
      :default-edge-options="{ animated: true }"
      fit-view
      class="w-full h-full"
    />
    </div>
</template>