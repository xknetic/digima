<script setup>
// Layout
definePageMeta({
  path: "/register",
  middleware: 'guest',
});

// Submit form for Add Member
const form = ref({
  first_name: "sample",
  middle_name: "asdas",
  last_name: "asdasd",
  email: "sample@gmail.com",
  password: "password",
  confirm_password: "password",
});

// Cookies
const cookies = useCookie('auth_user_token');

const submitForm = async (event) => {
  // event.preventDefault();
  const result = await $fetch("http://127.0.0.1:8000/api/register", {
    method: "POST",
    body: {
      first_name: form.value.first_name,
      middle_name: form.value.middle_name,
      last_name: form.value.last_name,
      email: form.value.email,
      password: form.value.password,
      confirm_password: form.value.confirm_password,
    },
  });
  cookies.value = result;
  window.location.reload();
};
</script>

<template>
  <div class="flex flex-col items-center justify-center h-screen bg-slate-100">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
      <h2 class="text-2xl font-bold text-black mb-4">Register</h2>
      <form class="flex flex-col" @submit.prevent="submitForm">
        <!-- <div>
          <InputLabel for="first_name">First Name</InputLabel>
          <TextInput
            id="first_name"
            placeholder="First Name"
            v-model="form.first_name"
          />
        </div>

        <div>
          <InputLabel for="middle_name">Middle Name</InputLabel>
          <TextInput
            id="middle_name"
            placeholder="Middle Name"
            v-model="form.middle_name"
          />
        </div>

        <div>
          <InputLabel for="last_name">Last Name</InputLabel>
          <TextInput
            id="last_name"
            placeholder="Last Name"
            v-model="form.last_name"
          />
        </div>

        <div>
          <InputLabel for="email">Email</InputLabel>
          <TextInput
            id="email"
            placeholder="Email"
            v-model="form.email"
          />
        </div>

        <div>
          <InputLabel for="password">Password</InputLabel>
          <TextInput
            id="password"
            placeholder="Password"
            v-model="form.password"
            type="password"
          />
        </div>

        <div>
          <InputLabel for="confirm_password">Confirm Password</InputLabel>
          <TextInput
            id="confirm_password"
            placeholder="Confirm Password"
            v-model="form.confirm_password"
            type="password"
          />
        </div> -->

        <PrimaryButton> Register </PrimaryButton>
      </form>
    </div>
  </div>
</template>
