<template>
  <section class="about-us bg-light py-5 mt-5">
    <div class="container">
      <!-- Hero Section -->
      <header class="text-center mb-5 hero-section">
        <h2 class="display-4 text-success mb-3">Bersama, Membantu Sesama</h2>
        <p class="lead text-muted">Membuka jalan bagi mereka yang membutuhkan melalui donasi yang aman, cepat, dan transparan.</p>
      </header>

      <!-- Image Section -->
      <div class="text-center mb-5">
        <img src="../assets/images/mesjid.jpg" alt="Donation Activity" class="img-fluid rounded shadow-lg animate-img">
        <p class="mt-3 text-muted">Lihat kegiatan donasi dan bagaimana bantuan Anda mengubah hidup banyak orang.</p>
      </div>

      <!-- Success Numbers -->
      <div class="row text-center mb-5">
        <div class="col-md-4 mb-4 mb-md-0">
          <div class="card p-4 shadow-sm">
            <h2 class="display-4 text-success">+5000</h2>
            <p class="text-muted">Total donasi terkumpul</p>
          </div>
        </div>
        <div class="col-md-4 mb-4 mb-md-0">
          <div class="card p-4 shadow-sm">
            <h2 class="display-4 text-success">+200</h2>
            <p class="text-muted">Jumlah penerima manfaat</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card p-4 shadow-sm">
            <h2 class="display-4 text-success">+100</h2>
            <p class="text-muted">Jumlah donatur</p>
          </div>
        </div>
      </div>

      <!-- Visi & Misi Section -->
      <div class="row mb-5">
        <div class="col-md-6 mb-4 mb-md-0">
          <div class="card p-4 shadow-sm">
            <h3 class="h4 text-success mb-3">Visi Kami</h3>
            <p class="text-muted">Kami berkomitmen untuk memberikan akses donasi yang transparan, cepat, dan tepat sasaran kepada mereka yang membutuhkan.</p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card p-4 shadow-sm">
            <h3 class="h4 text-success mb-3">Misi Kami</h3>
            <ul class="list-unstyled text-muted">
              <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>Memastikan donasi sampai kepada penerima yang tepat</li>
              <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>Menghadirkan platform yang transparan dan mudah digunakan</li>
              <li><i class="fas fa-check-circle text-success mr-2"></i>Menyebarkan kebaikan melalui aksi nyata</li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Differentials Section -->
      <div class="row mb-5">
        <div class="col-md-4 mb-4 mb-md-0">
          <div class="card p-4 shadow-sm">
            <h4 class="h5 text-success mb-3">Transparansi</h4>
            <p class="text-muted">Kami memastikan setiap donasi dicatat dan dilaporkan secara transparan.</p>
          </div>
        </div>
        <div class="col-md-4 mb-4 mb-md-0">
          <div class="card p-4 shadow-sm">
            <h4 class="h5 text-success mb-3">Keamanan</h4>
            <p class="text-muted">Platform kami dilengkapi dengan teknologi keamanan terbaru untuk melindungi transaksi Anda.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card p-4 shadow-sm">
            <h4 class="h5 text-success mb-3">Efisiensi</h4>
            <p class="text-muted">Proses penyaluran donasi dilakukan dengan cepat dan tepat, memastikan bantuan segera tiba di tangan yang membutuhkan.</p>
          </div>
        </div>
      </div>

      <!-- Call to Action -->
      <div class="text-center">
        <h3 class="h2 text-success mb-3">Mari Bergabung dengan Kami</h3>
        <p class="text-muted mb-4">Bersama, kita bisa membuat perubahan yang berarti. Bergabunglah sebagai donatur atau sukarelawan dan bantu mereka yang membutuhkan.</p>
        <router-link to="/donasi" class="btn btn-success btn-lg px-5 cta-btn">Donasi Sekarang</router-link>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "AboutPage",
};
</script>

<style scoped>
.about-us {
  font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}

.about-us h1, .about-us h2, .about-us h3, .about-us h4 {
  font-weight: 600;
}

.hero-section {
  animation: fadeIn 0.8s ease-in-out;
}

.about-us .btn-success {
  background-color: #28a745;
  border-color: #28a745;
  transition: all 0.3s ease;
}

.about-us .btn-success:hover {
  background-color: #218838;
  border-color: #1e7e34;
  transform: translateY(-2px);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.about-us .card {
  border: none;
  border-radius: 8px;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.about-us .card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
}

.about-us img {
  max-height: 400px;
  object-fit: cover;
  border-radius: 12px;
  transition: transform 0.3s ease;
}

.animate-img:hover {
  transform: scale(1.05);
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}
</style>
