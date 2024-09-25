<template>
    <section class="donations py-5">
      <div class="container text-center">
        <h2 class="text-success mb-5">Donasi</h2>
        <p class="lead mb-5">
          Berikut beberapa kegiatan penggalangan dana yang sedang berjalan di masjid kami.
        </p>
        <div class="row justify-content-center">
          <div class="col-md-6 col-lg-5 mb-4" v-for="(donation, index) in donations" :key="index">
            <div class="card shadow-sm h-100">
              <img :src="donation.image" class="card-img-top" :alt="donation.title">
              <div class="card-body">
                <h5 class="card-title">{{ donation.title }}</h5>
                <p class="card-text">Terkumpul: 
                  <span class="text-success font-weight-bold">{{ donation.amount }}</span>
                </p>
                <p class="card-text">Donatur: 
                  <span class="text-success font-weight-bold">{{ donation.donors }}</span>
                </p>
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
  /* Styling for donations section */
  .donations {
    background-color: #f8f9fa; /* Light grey background */
  }
  
  .donations h2 {
    font-size: 2.5rem;
    font-weight: 600;
  }
  
  .donations .card {
    border: none;
    border-radius: 15px; /* Smooth corners */
    overflow: hidden; /* Ensure image fits inside rounded corners */
    transition: box-shadow 0.3s ease;
  }
  
  .donations .card:hover {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Soft shadow on hover */
  }
  
  .donations .card-title {
    font-size: 1.25rem;
    font-weight: 600;
  }
  
  .donations .card-text {
    font-size: 1rem;
    color: #6c757d; /* Medium grey for text */
  }
  
  .donations .text-success {
    color: #28a745 !important; /* Custom green color */
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
      margin-bottom: 1.5rem; /* Add space between cards for small screens */
    }
  }
  </style>
  