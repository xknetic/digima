<script setup>
import { ref, computed, onMounted } from "vue";

// Fetch user
const cookies = useCookie("auth_user_token");
const data = ref(null);

const slots = await $fetch("http://127.0.0.1:8000/api/Slots");
slots.value = slots;

const result = await $fetch("http://127.0.0.1:8000/api/user", {
  headers: {
    Authorization: `Bearer ${cookies.value.token}`,
  },
});
data.value = result;

const selectedSlot = ref(null);
onMounted(() => {
  const slots = localStorage.getItem("slots");
  if (slots) {
    try {
      selectedSlot.value = JSON.parse(slots);
    } catch (error) {
      console.error("Error parsing stored slot:", error);
    }
  }
});

const userFilter = slots.filter((slot) => slot.slot_user_id == data.value.id);

// set default
const slot = localStorage.getItem("slots");
if (!slot) {
  // console.log(selectedSlot);
  const getUser = userFilter.find(
    (userFilter) => userFilter.slot_sponsor == null
  );
  localStorage.setItem("slots", JSON.stringify(getUser));
  selectedSlot.value = getUser;
}

const submitForm = (slot_id) => {
  // event.preventDefault();
  try {
    const getUser = userFilter.find(
      (userFilter) => userFilter.slot_id == slot_id
    );
    localStorage.setItem("slots", JSON.stringify(getUser));
    selectedSlot.value = getUser;
    // console.log("Saved slot_id to localStorage:", slot_id);
    window.location.reload();
  } catch (error) {
    handleError.value = "Error saving data to localStorage.";
    console.error("Error:", error);
  }
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
            selectedSlot ? selectedSlot.slot_username : "Select a slot"
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
                @click="submitForm(slot.slot_id)"
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
