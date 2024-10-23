<template>
  <div class="container mt-5 pt-5">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <img :src="image" class="card-img-top" alt="Donation Box" />
          <div class="card-body">
            <h2 class="card-title text-primary">
              {{ detailProgram.nama_kegiatan }}
            </h2>
            <p class="card-text">
              {{ quote }}<br />
              <strong>{{ hadith }}</strong>
            </p>
          </div>
        </div>
        <div class="mt-3">
          <h4>Sedekah</h4>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Deskripsi</h5>
              <p class="card-text">
                {{ detailProgram.deskripsi_kegiatan }}
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Column (Donation Summary) -->
      <div class="col-md-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <h4 class="card-text mb-3 small-title">
              Bantu Donasi Ini Terwujud
            </h4>
            <img :src="image" class="img-fluid mb-3" alt="Donation Campaign" />
            <p class="card-text">
              Terkumpul: Rp.
              {{ formatCurrency(detailProgram.anggaran_terkumpul) }}
            </p>
            <p class="card-text">
              Target: Rp. {{ formatCurrency(detailProgram.anggaran_kegiatan) }}
            </p>
            <div class="progress mb-2">
              <div
                class="progress-bar"
                role="progressbar"
                :style="{ width: progress + '%' }"
                aria-valuenow="30"
                aria-valuemin="0"
                aria-valuemax="100"
              ></div>
            </div>
            <RouterLink to="/nominal">
              <button class="btn btn-success">Donasi Sekarang</button>
            </RouterLink>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      detailProgram: [],
      image: require("../assets/images/infaq.jpeg"),
      quote: '"Sedekah dapat menghapus dosa sebagaimana air memadamkan api."',
      hadith: "Hadist Riwayat Tirmidzi",
    };
  },

  methods: {
    formatCurrency(value) {
      return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
      }).format(value);
    },
    fetchDetailData() {
      axios
        .get("/donasi")
        .then((response) => {
          this.campaign = response.data;
        })
        .catch((error) => {
          console.error("Error fetching campaign data:", error);
        });
    },
  },
  mounted() {
    this.fetchDetailData();
  },
};
</script>

<style scoped>
.card-title {
  font-size: 1.75rem;
}

.progress-bar {
  background-color: #28a745;
}

.small-title {
  font-size: 20px; /* Adjust this value as needed */
}
</style>
