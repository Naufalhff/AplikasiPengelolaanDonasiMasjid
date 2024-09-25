<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow">
    <div class="container-fluid">
      <!-- Logo and Brand Name -->
      <a class="navbar-brand d-flex align-items-center" href="#">
        <span>hariinidonasi</span>
      </a>

      <!-- Search Bar
      <form class="d-none d-lg-block" style="flex-grow: 1; margin-left: 20px; max-width: 400px;">
        <input class="form-control search-bar" type="search" placeholder="Search" aria-label="Search">
      </form> -->

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
            <router-link class="nav-link" to="/">Beranda</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/about">tentang kami</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/donasi">Donasi</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/login">
              <button class="btn btn-login ms-3">Login</button>
            </router-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: "NavBar",
};
</script>

<style scoped>
/* General Navbar Styles */
.navbar {
  background-color: #ffffff; /* White background */
  padding: 1rem; /* Padding around the navbar */
}

/* Brand styles */
.navbar-brand img {
  border-radius: 50%; /* Circle logo */
}

.navbar-brand span {
  font-size: 1.4rem; /* Brand text size */
  font-weight: bold;
  color: #000000; /* Matching the red color in the logo */
}

Search Bar Styles
.search-bar {
  border-radius: 20px; /* Rounded edges */
  padding: 0.5rem 1rem;
  border: 1px solid #ccc;
}

/* Nav Link Styles */
.nav-link {
  color: #000;
  margin-right: 1rem;
  font-weight: 500;
  transition: color 0.3s;
}

.nav-link:hover {
  color: #28a745; /* Hover color */
}


.btn-login {
  background-color: #28a745; 
  color: #000; /* Black text */
  border-radius: 20px; /* Rounded button */
  padding: 0.5rem 1.5rem;
  font-weight: bold;
}

.btn-login:hover {
  background-color: #218838; /* Darker yellow on hover */
}

/* Responsive Adjustments */
@media (max-width: 768px) {
  .search-bar {
    display: none; /* Hide search bar on smaller screens */
  }
}
</style>
