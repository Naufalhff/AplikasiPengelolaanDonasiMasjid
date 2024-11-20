<template>
  <section class="donations py-5">
    <div class="container text-center">
      <h2 class="text-success mb-5">Donasi</h2>
      <p class="lead mb-4">
        Berikut beberapa kegiatan penggalangan dana yang sedang berjalan di masjid kami.
      </p>
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4 mb-4" v-for="donation in donations" :key="donation.id_kegiatan">
          <div class="card donation-card shadow-sm h-100">
            <img :src="image" class="card-img-top" :alt="donation.nama_kegiatan">
            <div class="card-body">
              <h5 class="card-title">{{ donation.nama_kegiatan }}</h5>
              <span class="badge badge-pill category-badge">{{ donation.jenis_kegiatan }}</span>
              <p class="card-text">Terkumpul: 
                <span class="text-success font-weight-bold">{{ donation.anggaran_terkumpul }}</span>
              </p>
              <div class="progress mb-3">
                <div class="progress-bar bg-success" role="progressbar" 
                     :style="{width: ((donation.anggaran_terkumpul / donation.anggaran_kegiatan) * 100) + '%'}" 
                     aria-valuenow="((donation.anggaran_terkumpul / donation.anggaran_kegiatan) * 100)" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <RouterLink class="donate-link" to="/donasi">
        <button class="btn btn-success btn-lg mt-4 px-5">Lebih Lanjut</button>
      </RouterLink>
    </div>
  </section>
</template>

<script>
import axios from "../axios";

export default {
  name: "DonationsSection",
  data() {
    return {
      image: require("../assets/images/infaq.jpeg"),
      donations: []
    };
  },
  methods: {
    fetchData(){
      axios
        .get('http://localhost:8000/api/donasiLimited')
        .then((response) => {
          this.donations = response.data;
          console.log(response.data)
        })
        .catch((error) => {
          console.error(error)
        })
    }
  },
  mounted(){
    this.fetchData();
  }
};
</script>

<style scoped>
/* Styling for donations section */
.donations {
  background-color: #f8f9fa;
  font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}

.donations h2 {
  font-size: 2.5rem;
  font-weight: 600;
}

.donations .donation-card {
  border: none;
  border-radius: 15px;
  overflow: hidden;
  transition: box-shadow 0.3s ease;
}

.donations .donation-card:hover {
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.donations .card-title {
  font-size: 1.5rem;
  font-weight: 600;
}

.donations .card-text {
  font-size: 1rem;
  color: #6c757d;
}

.donations .category-badge {
  font-size: 0.875rem;
  background-color: #28a745;
  color: #fff;
  position: absolute;
  top: 10px;
  left: 10px;
  padding: 0.5rem;
}

.donations .progress {
  height: 6px;
  border-radius: 3px;
  background-color: #e9ecef;
}

.donations .progress-bar {
  border-radius: 3px;
}

.donations .text-success {
  color: #28a745 !important;
}

.donations .btn {
  background-color: #28a745;
  border-color: #28a745;
  color: #fff;
  transition: background-color 0.3s ease;
}

.donations .btn:hover {
  background-color: #218838;
  border-color: #218838;
}

.donations .btn-lg {
  font-size: 1.25rem;
  padding: 0.75rem 1.5rem;
  border-radius: 50px;
}

/* Responsive adjustments */
@media (max-width: 767px) {
  .donations .card {
    margin-bottom: 1.5rem;
  }
}
</style>
