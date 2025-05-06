<script setup>
import { ref } from "vue";
// Fetching the API
const {
  data: memberlists,
  error,
  refresh,
} = await useFetch("http://127.0.0.1:8000/api/Tests");

const form = ref({
  id: null,
  name: "",
  email: "",
  error: "",
});

// Open the form with the selected member's data for editing
const editMember = (member) => {
  form.value.id = member.id;
  form.value.name = member.name;
  form.value.email = member.email;
};

// Submit edited member data to the API
const submitForm = async (event) => {
  event.preventDefault();

  const { data, error: fetchError } = await useFetch(
    `http://127.0.0.1:8000/api/Tests/${form.value.id}`,
    {
      method: "PUT",
      body: JSON.stringify({ name: form.value.name, email: form.value.email }),
      headers: {
        "Content-Type": "application/json",
      },
    }
  );
};

const searchTerm = ref('')

// Load full data once
const { data: slots, pending } = await useFetch('http://127.0.0.1:8000/api/Slots')

// Use composable to filter
const { filtered, filter } = useLocalSearch(slots)
</script>

<template>
  <div>
    <form @submit="submitForm" method="post">
      <input
        v-model="form.name"
        name="name"
        type="text"
        placeholder="Enter your name"
        required
      />
      <input
        v-model="form.email"
        name="email"
        type="text"
        placeholder="Enter your email"
        required
      />
      <button type="submit">Submit</button>
    </form>
  </div>

  <!-- Member List -->
  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="memberlist in memberlists" :key="memberlist.id">
        <td>{{ memberlist.name }}</td>
        <td>{{ memberlist.email }}</td>
        <td>
          <button @click="editMember(memberlist)">
            Edit
          </button>
        </td>
      </tr>
    </tbody>
  </table>

  <!-- Edit Form (Appears when you click "Edit") -->
  <div v-if="form.id">
    <h3>Edit Member</h3>
    <form @submit="submitForm" method="post">
      <input
        v-model="form.name"
        name="name"
        type="text"
        placeholder="Enter new name"
        required
      />
      <input
        v-model="form.email"
        name="email"
        type="text"
        placeholder="Enter new email"
        required
      />
      <button type="submit">Update</button>
    </form>
  </div>


  <div>
    <input
      v-model="searchTerm"
      @input="filter(searchTerm)"
      type="text"
      placeholder="Search..."
    />

      <div v-for="slot in filtered" :key="slot.id">{{ slot.slot_username }}</div>
  </div>
</template>
