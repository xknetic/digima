<script setup>
import { ref, computed, onMounted } from 'vue';

// State to hold slots data and error
const slots = ref([]);
const error = ref(null);

// Simulating the current user ID (for example purposes)
const currentUserId = 2;  // Replace with the actual current user ID

// Fetch slots data from the API
onMounted(async () => {
  const response = await fetch("http://127.0.0.1:8000/api/Slots");
  const data = await response.json();
  slots.value = data;  // Set the slots data

  // Sync selectedSlot with localStorage value on mount
  const storedSlotData = localStorage.getItem('selectedSlotData');
  if (storedSlotData) {
    // If there's data in localStorage, load it
    const parsedSlotData = JSON.parse(storedSlotData);
    selectedSlot.value = parsedSlotData.slot_id;
  } else {
    // Set default slot_id to 1 if no slot is selected
    selectedSlot.value = '';
  }
});

// Create a ref to hold the selected slot
const selectedSlot = ref(null);

// Handle form submission to save the selected slot to localStorage
const handleSubmit = () => {
  if (selectedSlot.value) {
    // Find the selected slot data from the slots array
    const selectedData = slots.value.find(slot => slot.slot_id === selectedSlot.value);

    if (selectedData) {
      // Save the selected slot data (entire object) to localStorage
      localStorage.setItem('selectedSlotData', JSON.stringify(selectedData));
      console.log("Slot data saved to localStorage:", selectedData);
    }
  }
};

// Filter the slots to get the ones corresponding to the current user
const userFilter = computed(() => {
  return slots.value.filter(slot => slot.slot_user_id === currentUserId);
});

// Get the selected slot based on slot_id (from localStorage)
const selectedSlotData = computed(() => {
  const storedSlotData = localStorage.getItem('selectedSlotData');
  return storedSlotData ? JSON.parse(storedSlotData) : null;
});
</script>

<template>
  <div>
    <!-- Form to select a slot -->
    <form @submit.prevent="handleSubmit">
      <label for="slot">Select a Slot:</label>
      <select v-model="selectedSlot" id="slot">
        <!-- Display only the slots that match the current user -->
        <option v-for="slot in userFilter" :key="slot.slot_id" :value="slot.slot_id">
          {{ slot.slot_id }} <!-- Display slot_id or other properties as needed -->
        </option>
      </select>
      <button type="submit">Save Slot</button>
    </form>

    <!-- Always display the selected slot data, even if no slot is selected -->
    <div>
      <h3>Slot Data for Selected Slot ID: {{ selectedSlotData ? selectedSlotData.slot_id : 'No slot selected' }}</h3>
      <p><strong>Slot ID:</strong> {{ selectedSlotData ? selectedSlotData.slot_id : 'No slot selected' }}</p>
      <p><strong>User ID:</strong> {{ selectedSlotData ? selectedSlotData.slot_user_id : 'N/A' }}</p>
      <p><strong>Slot Start Time:</strong> {{ selectedSlotData ? selectedSlotData.slot_username : 'N/A' }}</p>
      <p><strong>Slot End Time:</strong> {{ selectedSlotData.memberships ? 
            (selectedSlotData.memberships.membership_name || '--') : '--' }}</p>
    </div>

    <!-- Display error message if there's an error fetching slots -->
    <p v-if="error" class="error">Error: {{ error }}</p>
  </div>


  <ErrorHandler />
</template>
