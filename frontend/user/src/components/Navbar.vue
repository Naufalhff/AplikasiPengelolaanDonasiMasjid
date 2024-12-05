<template>
  <nav
    class="navbar navbar-expand-lg fixed-top"
    :class="{ transparent: isHomePage }"
  >
    <div class="container-fluid">
      <!-- Logo and Brand Name -->
      <a class="navbar-brand d-flex align-items-center" href="#">
        <router-link to="/"> <span>LuqmanulHakim</span> </router-link>
      </a>

      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <router-link class="nav-link" to="/" exact>Beranda</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/about">Tentang Kami</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/donasi">Donasi</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/kalkulatorzakat"
              >Kalkulator Zakat</router-link
            >
          </li>
          <li class="nav-item" v-if="!isLoggedInAsDonatur">
            <router-link to="/login">
              <button class="btn btn-login ms-3">Login</button>
            </router-link>
          </li>
          <li class="nav-item" v-else>
            <button class="btn btn-logout ms-3" @click="logout">Logout</button>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: "NavBar",
  data() {
    return {
      isHomePage: false,
    };
  },
  computed: {
    isLoggedInAsDonatur() {
      return (
        sessionStorage.getItem("isLogin") === "true" &&
        sessionStorage.getItem("loginAs") === "Donatur"
      );
    },
  },
  mounted() {
    this.checkRoute();
    window.addEventListener("scroll", this.handleScroll);
    this.$router.afterEach(this.checkRoute);
  },
  methods: {
    checkRoute() {
      this.isHomePage = this.$route.path === "/";
      this.handleScroll();
    },
    handleScroll() {
      const navbar = document.querySelector(".navbar");
      if (this.isHomePage && window.scrollY > 50) {
        navbar.classList.add("scrolled");
      } else if (this.isHomePage) {
        navbar.classList.remove("scrolled");
      }
    },
    logout() {
      sessionStorage.removeItem("isLogin");
      sessionStorage.removeItem("loginAs");
      this.$router.push("/login");
    },
  },
};
</script>

<style scoped>
/* Default Navbar Styles */
.navbar {
  background-color: #ffffff;
  padding: 1rem;
  transition: background-color 0.3s ease, box-shadow 0.3s ease;
}

/* Navbar transparent on homepage */
.navbar.transparent {
  background-color: transparent;
}

/* Background changes when scrolled */
.navbar.scrolled {
  background-color: rgba(255, 255, 255, 0.95);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Text color for transparent navbar on homepage */
.navbar.transparent:not(.scrolled) .nav-link,
.navbar.transparent:not(.scrolled) .navbar-brand span,
.navbar.transparent:not(.scrolled) .btn-login {
  color: #fff;
}

/* Text color when scrolled or on other pages */
.navbar.scrolled .nav-link,
.navbar.scrolled .navbar-brand span,
.navbar:not(.transparent) .nav-link,
.navbar:not(.transparent) .navbar-brand span {
  color: #000;
}

.navbar.scrolled .btn-login,
.navbar:not(.transparent) .btn-login {
  color: #ffffff;
}

/* Hover effect for nav links */
.nav-link {
  margin-right: 1rem;
  font-weight: 500;
  position: relative;
  transition: color 0.3s ease;
}

/* Custom style for active nav link */
.router-link-active {
  font-weight: bold;
  color: #28a745;
}

.nav-link:hover {
  color: #28a745;
}

.nav-link::after {
  content: "";
  position: absolute;
  bottom: -5px;
  left: 0;
  width: 0%;
  height: 2px;
  background-color: #28a745;
  transition: width 0.3s ease;
}

.nav-link:hover::after {
  width: 100%;
}

/* Login Button */
.btn-login {
  background-color: #28a745;
  border-radius: 20px;
  padding: 0.5rem 1.5rem;
  font-weight: bold;
  transition: background-color 0.3s ease, transform 0.3s ease;
}

.btn-logout {
  background-color: #dc3545;
  border-radius: 20px;
  padding: 0.5rem 1.5rem;
  font-weight: bold;
  color: #ffffff;
  transition: background-color 0.3s ease, transform 0.3s ease;
}

.btn-logout:hover {
  background-color: #c82333;
  transform: translateY(-2px);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Hover effect on button */
.btn-login:hover {
  background-color: #218838;
  transform: translateY(-2px);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
  .navbar {
    padding: 0.5rem;
  }

  .navbar-nav {
    text-align: center;
  }

  .nav-link {
    margin-right: 0;
    margin-bottom: 1rem;
  }

  .btn-login {
    width: 100%;
    margin-top: 1rem;
  }
}
</style>
