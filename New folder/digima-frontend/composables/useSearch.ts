import { ref, computed, watch } from 'vue'

export const useLocalSearch = (originalData: any) => {
  const filtered = ref([])
  const query = ref('')

  const filter = (q: string) => {
    query.value = q.toLowerCase()
    if (!q.trim()) {
      filtered.value = originalData.value || []
      return
    }

    filtered.value = (originalData.value || []).filter((item: any) =>
      item.slot_username?.toLowerCase().includes(query.value)
    )
  }

  // Optional: watch original data and initialize filtered list
  watch(originalData, () => {
    filtered.value = originalData.value || []
  }, { immediate: true })

  return {
    query,
    filtered,
    filter,
  }
}
