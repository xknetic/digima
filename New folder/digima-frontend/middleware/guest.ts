export default defineNuxtRouteMiddleware((to, from) => {
  const cookie = useCookie("auth_user_token");
  const route = to;

  // console.log(route)

  if (cookie.value) {
    if (route.path === "/login" || route.path === "/register") {
      // if (cookie.value.user.name === "member") {
      //   return navigateTo("/dashboard");
      // } else {
      //   return navigateTo("/admin/dashboard");
      // }

      switch (cookie.value.user.name) {
        case "admin":
          return navigateTo("/admin/dashboard");
        break;

        case "member":
          return navigateTo("/dashboard");
        break;

        case "cashier":
          return navigateTo("/cashierdashboard");
        break;
      }
    }
  }
});
