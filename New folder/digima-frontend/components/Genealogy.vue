<template>
    <VueFlow
      v-model:nodes="nodes"
      v-model:edges="edges"
      :default-edge-options="{ animated: true }"
      fit-view
      class="genealogy-flow"
    />
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue'
  import { VueFlow, useVueFlow } from '@vue-flow/core'
  
  // Ensure basic nodes and edges are registered
  const { onConnect, addEdges } = useVueFlow()
  
  const nodes = ref([
    {
      id: '1',
      label: 'Grandfather',
      position: { x: 250, y: 5 },
    },
    {
      id: '2',
      label: 'Father',
      position: { x: 100, y: 150 },
    },
    {
      id: '3',
      label: 'Uncle',
      position: { x: 400, y: 150 },
    },
    {
      id: '4',
      label: 'You',
      position: { x: 100, y: 300 },
    },
  ])
  
  const edges = ref([
    { id: 'e1-2', source: '1', target: '2', type: 'default' },
    { id: 'e1-3', source: '1', target: '3', type: 'default' },
    { id: 'e2-4', source: '2', target: '4', type: 'default' },
  ])
  
  onMounted(() => {
    onConnect((params) => addEdges([params]))
  })
  </script>
  
  <style>
  .genealogy-flow {
    width: 100%;
    height: 600px;
    border: 1px solid #ccc;
  }
  </style>
  