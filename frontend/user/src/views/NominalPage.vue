<template>
  <div class="container mt-5 p-5">
    <div class="card p-4">
      <div class="text-center">
        <img :src="donation.image" alt="Donasi" class="img-thumbnail mb-3" />
        <h5>{{ donation.title }}</h5>
        <p>{{ donation.description }}</p>
      </div>
      <div class="mb-3">
        <h6>Nominal</h6>
        <div class="d-flex flex-wrap">
          <button
            v-for="(amount, index) in presetAmounts"
            :key="index"
            class="btn me-2 mb-2 mr-3 border border-secondary"
            :class="{ 'btn-success': selectedAmount === amount }"
            @click="selectAmount(amount)"
          >
            Rp{{ amount.toLocaleString() }}
          </button>
        </div>
        <div class="mt-3">
          <label for="customAmount">Nominal Lainnya</label>
          <input
            type="number"
            class="form-control"
            id="customAmount"
            v-model.number="customAmount"
            placeholder="Minimal donasi Rp 1.000"
            min="1000"
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
export default {
  data() {
    return {
      presetAmounts: [10000, 25000, 50000, 100000],
      selectedAmount: null,
      customAmount: "",
      donation: {
        title: "Sedekah Subuh",
        description: "DKM Masjid Lukmanul hakim Hakim",
        image: require("../assets/images/infaq.jpeg"),
      },

      errorMessage: "",
    };
  },
  methods: {
    selectAmount(amount) {
      this.selectedAmount = amount;
      this.customAmount = amount;
      this.errorMessage = "";
    },
    submitDonation() {
      const amount = this.selectedAmount || this.customAmount;
      if (amount < 1000) {
        this.errorMessage = "Minimal donasi Rp.1000";
      } else {
        this.errorMessage = " ";
        this.$router.push({ name: "FormDonasi", query: { amount } });
      }
    },
  },
};
</script>

<style scoped>
.card {
  max-width: 500px;
  margin: auto;
}

.img-thumbnail {
  width: 100%;
  max-width: 200px;
  height: auto;
}
.alert {
  margin-top: 20px;
}
</style>
