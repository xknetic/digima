<script setup>
// Layout
definePageMeta({
  layout: "authenticated-layout",
  name: "Add Member",
  middleware: 'auth',
});
</script>

<template>
  <div>
    <MemberNavigation />

    <AddMemberForm />
  </div>
</template>
