<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid d-flex justify-content-between">
      <a class="navbar-brand" href="#">hariinidonasi</a>
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
            <router-link class="nav-link" to="/about">Tentang Kami</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/donation">Donasi</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="login"
              ><button class="btn btn-success">Login</button></router-link
            >
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

<style>
.navbar {
  margin-bottom: 20px;
}
</style>
