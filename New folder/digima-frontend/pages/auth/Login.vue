<script setup>
// Layout
definePageMeta({
  path: "/login",
  middleware: "guest",
});

// Submit form
const form = ref({
  email: "",
  password: "",
});

// Cookies
const cookies = useCookie("auth_user_token");

const submitForm = async (event) => {
  event.preventDefault();
  try {
    const result = await $fetch("http://127.0.0.1:8000/api/login", {
      method: "POST",
      body: {
        email: form.value.email,
        password: form.value.password,
      },
    });
    cookies.value = result;
    window.location.reload();
    // console.log(cookies.value);
  } catch (error) {
    console.log(error.data)
  }
};
</script>

<template>
  <div class="flex flex-col items-center justify-center h-screen bg-slate-100">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
      <Logo />
      <h2 class="text-2xl font-bold text-black mb-4">Login</h2>
      <form class="flex flex-col" @submit.prevent="submitForm">
        <div>
          <InputLabel for="email">Email</InputLabel>
          <TextInput id="email" placeholder="Email" v-model="form.email" />
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
        <div class="flex items-center justify-between flex-wrap">
          <label class="text-sm text-black cursor-pointer" for="remember-me">
            <input class="mr-2" id="remember-me" type="checkbox" />
            Remember me
          </label>
          <a class="text-sm text-blue-500 hover:underline mb-0.5" href="#"
            >Forgot password?</a
          >
          <p class="text-black mt-4">
            Don't have an account?
            <a class="text-sm text-blue-500 -200 hover:underline mt-4" href="#"
              >Signup</a
            >
          </p>
        </div>
        <PrimaryButton> Login </PrimaryButton>
      </form>
    </div>
  </div>
</template>
