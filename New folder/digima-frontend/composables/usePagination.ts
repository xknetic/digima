import { ref, computed } from 'vue';

export function usePagination<T>(items: Ref<T[]>, itemsPerPage: number) {
  const currentPage = ref(1);

  const totalPages = computed(() => {
    return Math.ceil(items.value.length / itemsPerPage);
  });

  const secondPage = computed(() => {
    if (currentPage.value < totalPages.value) {
      return currentPage.value + 1;
    }
    return totalPages.value;
  });

  const paginatedItems = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    return items.value.slice(start, end);
  });

  const nextPage = () => {
    if (currentPage.value < totalPages.value) {
      currentPage.value++;
    }
  };

  const prevPage = () => {
    if (currentPage.value > 1) {
      currentPage.value--;
    }
  };

  const goToPage = (page: number) => {
    if (page >= 1 && page <= totalPages.value) {
      currentPage.value = page;
    }
  };

  const firstPage = (page: number) => {
    currentPage.value = 1;
  };

  const lastPage = (page: number) => {
    currentPage.value = totalPages.value;
  };

  return {
    currentPage,
    totalPages,
    paginatedItems,
    secondPage,
    nextPage,
    prevPage,
    goToPage,
    firstPage,
    lastPage,
  };
}