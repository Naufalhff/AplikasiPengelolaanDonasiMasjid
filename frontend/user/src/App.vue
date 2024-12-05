<template>
  <div>
    <!-- Navbar hanya muncul jika $route.meta.hideNavbar tidak true -->
    <NavBar v-if="!$route.meta.hideNavbar" />
    <SideNav v-if="$route.meta.hideSideNavbar" />

    <!-- router-view untuk menampilkan komponen sesuai rute -->
    <router-view></router-view>
    <FooterPage v-if="!$route.meta.hideFooter" />
  </div>
</template>

<script>
import NavBar from "./components/Navbar.vue";
import SideNav from "./components/SideNav.vue";
import FooterPage from "./components/FooterPage.vue";

export default {
  components: {
    NavBar,
    SideNav,
    FooterPage,
  },
};
</script>
