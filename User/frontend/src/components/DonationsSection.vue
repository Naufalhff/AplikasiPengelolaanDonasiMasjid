<template>
    <section class="donations py-5">
      <div class="container text-center">
        <h2 class="text-success mb-4">Donasi</h2> <!-- Tambahkan mb-4 untuk margin bottom -->
        <p class="lead mb-4">
          Berikut beberapa kegiatan penggalangan dana yang sedang berjalan di
          masjid kami.
        </p>
        <div class="row mt-4">
          <div class="col-md-3" v-for="(donation, index) in donations" :key="index">
            <div class="card shadow-sm mb-4"> <!-- Tambahkan mb-4 untuk margin bottom -->
              <img :src="donation.image" class="card-img-top" :alt="donation.title">
              <div class="card-body">
                <h5 class="card-title">{{ donation.title }}</h5>
                <p class="card-text">Terkumpul: {{ donation.amount }}</p>
                <p class="card-text">Donatur: {{ donation.donors }}</p>
              </div>
            </div>
          </div>
        </div>
        <RouterLink class="donate-link" to="/donasi"><button class="btn btn-success mt-4">Lebih Lanjut</button></RouterLink>
      </div>
    </section>
  </template>
  
  <script>
  export default {
    name: "DonationsSection",
    data() {
      return {
        donations: [
          {
            image: require('../assets/images/mesjid.jpg'),
            title: "Infaq",
            amount: "Rp. 1,229,652,858",
            donors: "12607",
          },
          {
            image: require('../assets/images/mesjid.jpg'),
            title: "Sedekah Subuh",
            amount: "Rp. 473,258,314",
            donors: "18766",
          },
          {
            image: require('../assets/images/mesjid.jpg'),
            title: "Zakat Penghasilan",
            amount: "Rp. 1,823,658,676",
            donors: "3418",
          },
          {
            image: require('../assets/images/mesjid.jpg'),
            title: "Zakat Emas dan Perak",
            amount: "Rp. 214,966,292",
            donors: "108",
          },
        ],
      };
    },
  };
  </script>
  
  <style scoped>
  .donations .card {
    transition: transform 0.3s ease-in-out;
  }
  .donations .card:hover {
    transform: translateY(-10px);
  }
  .donations .card-title {
    font-weight: bold;
  }
  .donations .card-text {
    color: #555;
  }
  </style>
  