export default defineNuxtRouteMiddleware((to, from) => {
  const cookie = useCookie("auth_user_token");
  const route = to;

  // console.log(route)

  if (cookie.value) {
    if ((route.path === "/login") || (route.path === "/register")) {
      if (cookie.value.user.name === "member") {
        return navigateTo("/dashboard");
      } else {
        return navigateTo("/admin/dashboard");
      }
    }
  }
});
