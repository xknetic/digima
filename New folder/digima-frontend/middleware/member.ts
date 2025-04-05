export default defineNuxtRouteMiddleware(() => {
  const cookie = useCookie("auth_user_token");
  if (!cookie.value) {
    return navigateTo("/login");
  }
});
