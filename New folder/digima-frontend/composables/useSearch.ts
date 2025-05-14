import { ref, watch } from 'vue'

function getNestedValue(obj: any, keyPath: string) {
  return keyPath.split('.').reduce((acc, key) => acc?.[key], obj)
}

export const useLocalSearch = (originalData: any, keyPaths: string | string[]) => {
  const filtered = ref([])
  const query = ref('')

  const keys = Array.isArray(keyPaths) ? keyPaths : [keyPaths]

  const filter = (q: string) => {
    query.value = q.toLowerCase()

    if (!q.trim()) {
      filtered.value = originalData.value || []
      return
    }

    filtered.value = (originalData.value || []).filter((item: any) =>
      keys.some((keyPath) => {
        const value = getNestedValue(item, keyPath)
        return (value || '').toLowerCase().includes(query.value)
      })
    )
  }

  watch(originalData, () => {
    filtered.value = originalData.value || []
  }, { immediate: true })

  return {
    query,
    filtered,
    filter,
  }
}
