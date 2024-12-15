<template>
  <head>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      rel="stylesheet"
    />
  </head>
  <section class="about-us">
    <!-- Hero Section -->
    <header class="hero-section">
      <div class="container">
        <h1 class="hero-title" data-aos="fade-up">Bersama, Membantu Sesama</h1>
        <p class="hero-text" data-aos="fade-up" data-aos-delay="100">
          Jadilah bagian dari perubahan, bersama kita membuka jalan untuk masa
          depan yang lebih cerah.
        </p>
        <router-link
          to="/donasi"
          class="cta-button hero-cta"
          data-aos="fade-up"
          data-aos-delay="200"
        >
          <i class="fas fa-heart mr-2"></i>
          Mulai Donasi
        </router-link>
      </div>
    </header>

    <!-- Image Section -->
    <div class="image-section" data-aos="zoom-in">
      <div class="container">
        <div class="image-wrapper">
          <img
            src="../assets/images/mesjid.jpg"
            alt="Donation Activity"
            class="main-image"
            loading="lazy"
          />
          <div class="overlay-text">
            <h2>Kegiatan Donasi</h2>
            <p>Mengubah hidup banyak orang melalui bantuan Anda.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Success Numbers -->
    <div class="container">
      <div class="stats-grid">
        <div class="stat-item" data-aos="fade-up">
          <div class="icon-wrapper">
            <i class="fas fa-hand-holding-heart"></i>
          </div>
          <h2 class="stat-number counter">
            {{ formatCurrency(this.donasi) }}
          </h2>
          <p class="stat-text">Donasi Terkumpul</p>
        </div>
        <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
          <div class="icon-wrapper">
            <i class="fas fa-donate"></i>
          </div>
          <h2 class="stat-number counter">{{ this.donatur }}</h2>
          <p class="stat-text">Jumlah Donatur</p>
        </div>
      </div>

      <!-- Visi & Misi Section -->
      <div class="vision-mission">
        <div class="card" data-aos="fade-right">
          <div class="card-icon">
            <i class="fas fa-eye"></i>
          </div>
          <h3 class="section-title">Visi Kami</h3>
          <p class="section-text">
            Kami berkomitmen untuk memberikan akses donasi yang transparan,
            cepat, dan tepat sasaran kepada mereka yang membutuhkan.
          </p>
        </div>
        <div class="card" data-aos="fade-left">
          <div class="card-icon">
            <i class="fas fa-bullseye"></i>
          </div>
          <h3 class="section-title">Misi Kami</h3>
          <ul class="mission-list">
            <li>
              <i class="fas fa-check-circle"></i> Memastikan donasi sampai
              kepada penerima yang tepat
            </li>
            <li>
              <i class="fas fa-check-circle"></i> Menghadirkan platform yang
              transparan dan mudah digunakan
            </li>
            <li>
              <i class="fas fa-check-circle"></i> Menyebarkan kebaikan melalui
              aksi nyata
            </li>
          </ul>
        </div>
      </div>

      <!-- Differentials Section -->
      <div class="differentials">
        <div class="card differential-item" data-aos="fade-up">
          <div class="card-icon">
            <i class="fas fa-shield-alt"></i>
          </div>
          <h4 class="section-title-small">Transparansi</h4>
          <p class="section-text">
            Kami memastikan setiap donasi dicatat dan dilaporkan secara
            transparan.
          </p>
        </div>
        <div
          class="card differential-item"
          data-aos="fade-up"
          data-aos-delay="100"
        >
          <div class="card-icon">
            <i class="fas fa-lock"></i>
          </div>
          <h4 class="section-title-small">Keamanan</h4>
          <p class="section-text">
            Platform kami dilengkapi dengan teknologi keamanan terbaru untuk
            melindungi transaksi Anda.
          </p>
        </div>
        <div
          class="card differential-item"
          data-aos="fade-up"
          data-aos-delay="200"
        >
          <div class="card-icon">
            <i class="fas fa-bolt"></i>
          </div>
          <h4 class="section-title-small">Efisiensi</h4>
          <p class="section-text">
            Proses penyaluran donasi dilakukan dengan cepat dan tepat,
            memastikan bantuan segera tiba di tangan yang membutuhkan.
          </p>
        </div>
      </div>

      <!-- Call to Action -->
      <div class="cta" data-aos="zoom-in">
        <h3 class="cta-title">Bergabunglah Bersama Kami</h3>
        <p class="cta-text">
          Raih kesempatan untuk membuat perubahan nyata di dunia ini. Donasi
          sekarang dan jadilah pahlawan bagi mereka yang membutuhkan.
        </p>
        <router-link to="/donasi" class="cta-button">
          <i class="fas fa-heart mr-2"></i>
          Donasi Sekarang
        </router-link>
      </div>
    </div>
  </section>
</template>

<script>
import axios from "axios";
import AOS from "aos";
import "aos/dist/aos.css";

export default {
  name: "AboutPage",
  data() {
    return {
      donasi: [],
      donatur: [],
    };
  },
  mounted() {
    this.fetchTotalDonasi();
    this.fetchTotalDonatur();

    // Initialize AOS
    AOS.init({
      duration: 1000,
      once: true,
      offset: 50,
    });

    // Initialize Counter Animation
    this.counterAnimation();
  },
  methods: {
    fetchTotalDonasi() {
      axios
        .get("http://localhost:8000/api/total-donasi")
        .then((response) => {
          this.donasi = response.data.total_donations;
        })
        .catch((error) => {
          console.error(error);
        });
    },
    fetchTotalDonatur() {
      axios
        .get("http://localhost:8000/api/jumlah-donatur")
        .then((response) => {
          this.donatur = response.data.donatur;
        })
        .catch((error) => {
          console.error(error);
        });
    },
    counterAnimation() {
      const counters = document.querySelectorAll(".counter");
      const speed = 200; // Duration of the animation

      counters.forEach((counter) => {
        const updateCount = () => {
          const target = +counter.getAttribute("data-target");
          const count = +counter.innerText;

          // Increment value
          const increment = target / speed;

          if (count < target) {
            counter.innerText = Math.ceil(count + increment);
            setTimeout(updateCount, 10); // Smooth increment
          } else {
            counter.innerText = target; // Final value
          }
        };

        updateCount();
      });
    },
    formatCurrency(value) {
      return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
      }).format(value);
    },
  },
};
</script>

<style scoped>
.about-us {
  font-family: "Inter", sans-serif;
  color: #2d3748;
  overflow-x: hidden;
}

/* Hero Section */
.hero-section {
  background: linear-gradient(135deg, #44b74c 0%, #6dd279 100%);
  padding: 120px 0 80px;
  text-align: center;
  color: white;
  margin-bottom: 80px;
}

.hero-title {
  font-size: 3.5rem;
  font-weight: 800;
  margin-bottom: 1.5rem;
  letter-spacing: -0.5px;
}

.hero-text {
  font-size: 1.25rem;
  max-width: 600px;
  margin: 0 auto 2rem;
  line-height: 1.6;
  opacity: 0.9;
}

/* Image Section */
.image-wrapper {
  position: relative;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
  margin-bottom: 80px;
}

.main-image {
  width: 100%;
  height: 500px;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.image-wrapper:hover .main-image {
  transform: scale(1.05);
}

.overlay-text {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  padding: 40px;
  background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
  color: white;
}

/* Stats Grid */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 2rem;
  margin-bottom: 80px;
}

.stat-item {
  background: white;
  padding: 2rem;
  border-radius: 20px;
  text-align: center;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease;
}

.stat-item:hover {
  transform: translateY(-10px);
}

.icon-wrapper {
  width: 80px;
  height: 80px;
  margin: 0 auto 1rem;
  background: linear-gradient(135deg, #44b74c 0%, #6dd279 100%);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 2rem;
  color: white;
}

.stat-number {
  font-size: 2.5rem;
  font-weight: 800;
  color: #2d3748;
  margin: 1rem 0;
}

/* Vision & Mission */
.vision-mission {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 2rem;
  margin-bottom: 80px;
}

.card {
  background: white;
  padding: 2.5rem;
  border-radius: 20px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
}

.card:hover {
  transform: translateY(-10px);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
}

.card-icon {
  width: 60px;
  height: 60px;
  background: linear-gradient(135deg, #44b74c 0%, #6dd279 100%);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.5rem;
  color: white;
  margin-bottom: 1.5rem;
}

.mission-list {
  list-style: none;
  padding: 0;
}

.mission-list li {
  margin-bottom: 1rem;
  display: flex;
  align-items: center;
}

.mission-list li i {
  color: #44b74c;
  margin-right: 1rem;
}

/* Differentials */
.differentials {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 2rem;
  margin-bottom: 80px;
}

/* CTA Section */
.cta {
  background: linear-gradient(135deg, #44b74c 0%, #6dd279 100%);
  padding: 4rem;
  border-radius: 20px;
  text-align: center;
  color: white;
  margin-bottom: 80px;
}

.cta-title {
  font-size: 2.5rem;
  font-weight: 800;
  margin-bottom: 1.5rem;
}

.cta-text {
  font-size: 1.2rem;
  max-width: 600px;
  margin: 0 auto 2rem;
  opacity: 0.9;
}

.cta-button {
  display: inline-flex;
  align-items: center;
  padding: 1rem 2rem;
  background: white;
  color: #44b74c;
  font-weight: 600;
  border-radius: 50px;
  text-decoration: none;
  transition: all 0.3s ease;
}

.cta-button:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.mr-2 {
  margin-right: 0.5rem;
}

@media (max-width: 768px) {
  .hero-title {
    font-size: 2.5rem;
  }

  .stats-grid,
  .vision-mission,
  .differentials {
    grid-template-columns: 1fr;
  }

  .cta {
    padding: 2rem;
  }
}
</style>
