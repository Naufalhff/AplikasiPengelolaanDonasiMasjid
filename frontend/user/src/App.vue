<template>
  <div>
    <!-- Navbar hanya muncul jika $route.meta.hideNavbar tidak true -->
    <NavBar v-if="!$route.meta.hideNavbar" />
    <SideNav v-if="$route.meta.hideSideNavbar" />

    <!-- router-view untuk menampilkan komponen sesuai rute -->
    <router-view></router-view>
  </div>
</template>

<script>
import NavBar from "./components/Navbar.vue";
import SideNav from "./components/SideNav.vue";

export default {
  components: {
    NavBar,
    SideNav,
  },
};
</script>
  