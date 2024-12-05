<template>
  <div class="container mt-5 p-5">
    <div class="card p-4">
      <div class="text-center">
        <img
          :src="donation.image"
          alt="Donasi"
          class="img-thumbnail mb-3 rounded"
        />
        <h5>{{ program.nama_kegiatan }}</h5>
        <p>{{ program.deskripsi_kegiatan }}</p>
      </div>
      <div class="mb-4">
        <h6>Nominal</h6>
        <div class="d-flex flex-wrap">
          <button
            v-for="(amount, index) in presetAmounts"
            :key="index"
            class="btn me-2 mt-2 mb-2 mr-2 ml-2 border border-secondary"
            :class="{ 'btn-success': selectedAmount === amount }"
            @click="selectAmount(amount)"
          >
            {{ formatCurrency(amount) }}
          </button>
        </div>
        <div class="mt-3">
          <label for="customAmount">Nominal Lainnya</label>
          <input
            type="text"
            class="form-control"
            id="customAmount"
            v-model="formattedAmount"
            placeholder="Minimal donasi Rp 1.000"
            min="1000"
            @input="formatCustomAmount"
          />
        </div>
        <div v-if="errorMessage" class="alert alert-danger mt-2" role="alert">
          {{ errorMessage }}
        </div>
      </div>
      <button class="btn btn-success w-100" @click="submitDonation">
        Selanjutnya
      </button>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      presetAmounts: [10000, 25000, 50000, 100000],
      selectedAmount: null,
      customAmount: "",
      donation: {
        title: "Test",
        description: "Halo",
        image: require("../assets/images/infaq.jpeg"),
      },
      errorMessage: "",
      program: [],
      formattedAmount: "",
    };
  },
  methods: {
    selectAmount(amount) {
      this.selectedAmount = amount;
      this.customAmount = amount;
      this.formattedAmount = this.formatCurrency(amount);
      this.errorMessage = "";
    },
    formatCustomAmount() {
      let value = this.formattedAmount.replace(/[^0-9]/g, "");
      if (value) {
        this.formattedAmount = Number(value).toLocaleString("id-ID");
        this.customAmount = value;
      }
    },
    submitDonation() {
      const amount = this.selectedAmount || this.customAmount;
      if (amount < 1000) {
        this.errorMessage = "Minimal donasi Rp.1000";
      } else {
        this.errorMessage = " ";
        this.$router.push({
          path: "/detaildonasi/nominal/formdonasi",
          query: { id: this.program.id_kegiatan, amount: amount },
        });
      }
    },
    fetchData() {
      const id = this.$route.query.id;
      axios
        .get(`http://localhost:8000/api/donasi/${id}`)
        .then((response) => {
          this.program = response.data;
        })
        .catch((error) => {
          console.error(error);
        });
    },
    formatCurrency(value) {
      return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
      }).format(value);
    },
  },
  mounted() {
    this.fetchData();
  },
};
</script>

<style scoped>
.card {
  max-width: 590px;
  margin: auto;
}

.img-thumbnail {
  width: 100%;
  max-width: 200px;
  height: auto;
  padding: 0;
}
.alert {
  margin-top: 20px;
}
</style>
