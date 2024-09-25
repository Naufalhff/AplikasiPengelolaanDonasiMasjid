<template>
  <head>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      rel="stylesheet"
    />
  </head>

  <div class="container mt-4 pt-5">
    <h2 class="text-center mb-4">Program Pilihan</h2>
    <p class="text-center">
      Pilih dan salurkan donasi untuk program yang berarti bagi Anda dan mereka
    </p>
    <!-- menu -->
    <div class="d-flex justify-content-center mb-5 mt-4">
      <div class="btn-group">
        <div
          class="d-flex flex-column align-items-center p-3 mr-5 me-4 border rounded"
        >
          <i class="fas fa-donate fa-2x text-success p-3 mb-2"></i>
          <span>Infak</span>
        </div>
        <div
          class="d-flex flex-column align-items-center p-3 mr-5 me-4 border rounded"
        >
          <i class="fas fa-balance-scale fa-2x text-success p-3 mb-2"></i>
          <span>Zakat</span>
        </div>
        <div
          class="d-flex flex-column align-items-center p-3 mr-5 me-4 border rounded"
        >
          <i class="fas fa-hand-holding-heart fa-2x text-success p-3 mb-2"></i>
          <span>Sedekah</span>
        </div>
        <div
          class="d-flex flex-column align-items-center p-3 mr-5 border rounded"
        >
          <i class="fas fa-mosque fa-2x text-success p-3 mb-2"></i>
          <span>Kegiatan</span>
        </div>
      </div>
    </div>

    <h5 class="text-left">Rekomendasi Program</h5>
    <!-- Search -->
    <div class="input-group mb-3">
      <input
        type="text"
        class="form-control"
        placeholder="Cari Program ..."
        v-model="search"
      />
    </div>

    <!-- pilihan program -->
    <div class="row">
      <div
        v-for="program in filteredPrograms"
        :key="program.id"
        class="col-md-4 mb-4"
      >
        <div class="card h-100">
          <img
            :src="program.image"
            class="card-img-top"
            :alt="program.name"
            style="height: 180px; object-fit: cover"
          />
          <div class="card-body">
            <h5 class="card-title">{{ program.name }}</h5>
            <p class="card-text">Terkumpul: Rp. {{ program.amount }}</p>
            <p class="card-text">Donatur: {{ program.donors }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      search: "",
      programs: [
        {
          id: 1,
          name: "infaq",
          amount: "1.293.662.858",
          donors: 12607,
          image: require("../assets/images/infaq.jpeg"),
        },
        {
          id: 2,
          name: "Sedekah Subuh",
          amount: "472.153.364",
          donors: 10764,
          image: require("../assets/images/infaq.jpeg"),
        },
        {
          id: 3,
          name: "Zakat Penghasilan",
          amount: "1.628.618.676",
          donors: 3418,
          image: require("../assets/images/infaq.jpeg"),
        },
        {
          id: 4,
          name: "Zakat Emas dan Perak",
          amount: "824.964.392",
          donors: 100,
          image: require("../assets/images/infaq.jpeg"),
        },
        {
          id: 5,
          name: "Zakat Investasi dan Saham",
          amount: "114.335.456",
          donors: 30,
          image: require("../assets/images/infaq.jpeg"),
        },
        {
          id: 6,
          name: "Zakat Tabungan",
          amount: "245.154.135",
          donors: 19,
          image: require("../assets/images/infaq.jpeg"),
        },
        {
          id: 7,
          name: "Zakat Perniagaan",
          amount: "83.112.470",
          donors: 75,
          image: require("../assets/images/infaq.jpeg"),
        },
      ],
    };
  },
  computed: {
    filteredPrograms() {
      if (!this.search) {
        return this.programs;
      }
      return this.programs.filter((program) =>
        program.name.toLowerCase().includes(this.search.toLowerCase())
      );
    },
  },
};
</script>

<style scoped>
.container {
  max-width: 1200px;
}

.card {
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.2s ease-in-out;
}

.card:hover {
  transform: scale(1.05);
}

input.form-control {
  max-width: 100;
  margin: 2 auto;
}
</style>
