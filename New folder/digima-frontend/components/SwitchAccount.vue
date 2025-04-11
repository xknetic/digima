<script setup>
import { ref, computed, onMounted } from "vue";

// Fetch user
const cookies = useCookie("auth_user_token");
const data = ref(null);

const result = await $fetch("http://127.0.0.1:8000/api/user", {
  headers: {
    Authorization: `Bearer ${cookies.value.token}`,
  },
});
data.value = result;

// State to hold slots data and error
const slots = ref([]);

// Fetch slots data from the API
onMounted(async () => {
  const response = await fetch("http://127.0.0.1:8000/api/Slots");
  const data = await response.json();
  slots.value = data; // Set the slots data

  // Sync selectedSlot with localStorage value on mount
  const storedSlotData = localStorage.getItem("selectedSlotData");
  if (storedSlotData) {
    // If there's data in localStorage, load it
    const parsedSlotData = JSON.parse(storedSlotData);
    selectedSlot.value = parsedSlotData.slot_id;
  } else {
    // Wait for slots to be fetched before submitting
    const defaultSlot = slots.value.find(slot => slot.slot_id === 1);
    if (defaultSlot) {
      localStorage.setItem("selectedSlotData", JSON.stringify(defaultSlot));
    }
  }
});

// Create a ref to hold the selected slot
const selectedSlot = ref(null);

// Handle form submission to save the selected slot to localStorage
const handleSubmit = () => {
  if (selectedSlot.value) {
    // Find the selected slot data from the slots array
    const selectedData = slots.value.find(
      (slot) => slot.slot_id === selectedSlot.value
    );

    if (selectedData) {
      // Save the selected slot data (entire object) to localStorage
      localStorage.setItem("selectedSlotData", JSON.stringify(selectedData));
      console.log("Slot data saved to localStorage:", selectedData);
    }
  }
};

// Filter the slots to get the ones corresponding to the current user
const userFilter = computed(() => {
  return slots.value.filter((slot) => slot.slot_user_id === result.id);
});

// Get the selected slot based on slot_id (from localStorage)
const selectedSlotData = computed(() => {
  const storedSlotData = localStorage.getItem("selectedSlotData");
  return storedSlotData ? JSON.parse(storedSlotData) : null;
});

// Handle slot click to update selectedSlot and submit
const handleSlotClick = (slotId) => {
  selectedSlot.value = slotId; // Update selected slot
  handleSubmit(); // Trigger the form submission
  window.location.reload();
};
</script>

<template>
  <div>
    <Dropdown
      :align="'right'"
      :width="'full'"
      contentClasses="bg-white"
      direction="bottom"
    >
      <!-- Trigger Slot -->
      <template #trigger>
        <button
          class="cursor-pointer hover:bg-slate-200 px-2 py-1 rounded-md w-full text-md font-base flex space-x-1"
        >
          <div class="bg-black rounded-full">as..</div>
          <span class="truncate">{{
            selectedSlotData
              ? selectedSlotData.slot_username
              : "No slot selected"
          }}</span>
        </button>
      </template>

      <!-- Content Slot -->
      <template #content>
        <div>
          <hr class="h-px my-1 bg-gray-200 border-0" />

          <div class="px-1 pb-1">
            <div v-for="slot in userFilter" :key="slot.slot_id">
              <ResponsiveNavLink
                class="items-center"
                @click="handleSlotClick(slot.slot_id)"
                :value="slot.slot_id"
              >
                {{ slot.slot_username }}
              </ResponsiveNavLink>
            </div>
          </div>
        </div>
      </template>
    </Dropdown>
  </div>
</template>
