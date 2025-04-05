<script setup>
// Cookies
const cookies = useCookie("auth_user_token");

// Logout form
const submitForm = async (event) => {
  event.preventDefault();

  const result = await $fetch("http://127.0.0.1:8000/api/logout", {
    method: "DELETE",
    headers: {
      Authorization: `Bearer ${cookies.value.token}`,
    },
  });
  cookies.value = null;
  console.log(result);
};

// Fetch user
const data = ref(null);
const fetchUser = async (event) => {
  event.preventDefault();

  const result = await $fetch("http://127.0.0.1:8000/api/user", {
    headers: {
      Authorization: `Bearer ${cookies.value.token}`,
    },
  });
  data.value = result;
};

// Tracking cookies
const isAuth = ref(false);
watchEffect(() => {
  if (cookies.value) {
    isAuth.value = true;
  } else {
    isAuth.value = false;
  }
});

const { useHello } = test();
useHello();
</script>

<template>
  <div>
    <form @submit="submitForm" method="post">
      <button type="submit">Logout</button>
    </form>

    <form @submit="fetchUser" method="post">
      <button type="submit">Fetch</button>
    </form>

    <div>
      <p v-if="isAuth">You are logged in</p>
      <p v-else>You are not logged in</p>
    </div>

    <div>
      <pre>{{ cookies }}</pre>
    </div>
  </div>

  <!-- <Dropdown
    :align="'right'"
    :width="'48'"
    contentClasses="bg-white"
    direction="down"
  >
    <template #trigger>
      <button>Toggle Dropdown</button>
    </template>
    <template #content>
      <div>Your dropdown content here</div>
    </template>
  </Dropdown> -->
</template>
