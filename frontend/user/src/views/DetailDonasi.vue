<template>
  <div class="container mt-5 pt-5">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <img :src="image" class="card-img-top" alt="Donation Box" />
          <div class="card-body">
            <h2 class="card-title text-primary">{{ campaign.title }}</h2>
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
                {{ campaign.description }}
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
              Terkumpul: Rp. {{ formatCurrency(campaign.amount_collected) }}
            </p>
            <p class="card-text">
              Target: Rp. {{ formatCurrency(campaign.target_amount) }}
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
            <p class="card-text">{{ campaign.days_left }} hari lagi</p>
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
      campaign: {
        title: "",
        description: "",
        amount_collected: 0,
        target_amount: 0,
        days_left: 0,
      },
      image: require("../assets/images/infaq.jpeg"),
      quote: '"Sedekah dapat menghapus dosa sebagaimana air memadamkan api."',
      hadith: "Hadist Riwayat Tirmidzi",
    };
  },
  computed: {
    progress() {
      return (
        (this.campaign.amount_collected / this.campaign.target_amount) * 100
      );
    },
  },
  methods: {
    formatCurrency(value) {
      return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
      }).format(value);
    },
    fetchCampaignData() {
      axios
        .get("/api/campaign/1")
        .then((response) => {
          this.campaign = response.data;
        })
        .catch((error) => {
          console.error("Error fetching campaign data:", error);
        });
    },
  },
  mounted() {
    this.fetchCampaignData();
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
  font-size: 20px;
}
</style>
