<template>
  <div class="container-fluid py-4">
    <div class="row justify-content-end">
      <div class="col-md-2">
        <RouterLink class="createaactivity-link" to="/create-activity">
          <button class="btn btn-success w-100 mb-3">Buat Kegiatan Baru</button>
        </RouterLink>
      </div>
      <div class="col-md-2">
        <button class="btn btn-danger w-100 mb-3">Hapus Kegiatan</button>
      </div>
    </div>

    <!-- Card Grid Section -->
    <div class="row">
      <div class="col-md-4 mb-4" v-for="activity in activities" :key="activity.id">
        <div class="card h-100" @click="editActivity(activity.id)">
          <img :src="activity.image" class="card-img-top" alt="Activity Image">
          <div class="card-body">
            <h5 class="card-title">{{ activity.title }}</h5>
            <p class="card-text">Terkumpul: {{ activity.collected }}</p>
            <p class="card-text">Donatur: {{ activity.donors }}</p>
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
      activities: [
        {
          id: 1,
          title: 'Sedekah Subuh',
          collected: 'Rp. 47,328,354',
          donors: 18746,
          image: require('@/assets/images/infaq.jpeg')
        },
        {
          id: 2,
          title: 'Zakat Penghasilan',
          collected: 'Rp. 1,828,658,876',
          donors: 3418,
          image: require('@/assets/images/infaq.jpeg')
        },
        {
          id: 3,
          title: 'Zakat Emas dan Perak',
          collected: 'Rp. 214,964,932',
          donors: 108,
          image: require('@/assets/images/infaq.jpeg')
        },
        {
          id: 4,
          title: 'Zakat Investasi dan Saham',
          collected: 'Rp. 13,140,356',
          donors: 30,
          image: require('@/assets/images/infaq.jpeg')
        },
        {
          id: 5,
          title: 'Zakat Tabungan',
          collected: 'Rp. 364,155,868',
          donors: 169,
          image: require('@/assets/images/infaq.jpeg')
        },
        {
          id: 6,
          title: 'Zakat Perniagaan',
          collected: 'Rp. 85,112,470',
          donors: 73,
          image: require('@/assets/images/infaq.jpeg')
        }
      ]
    };
  },
  methods: {
    editActivity(id) {
      this.$router.push({ name: 'EditActivity', params: { id } });
    }
  }
};
</script>

<style scoped>
.card {
  border-radius: 10px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
  cursor: pointer;
  transition: transform 0.3s, box-shadow 0.3s; /* Smooth transition for hover effect */
}

.card:hover {
  transform: translateY(-5px); /* Slight lift effect on hover */
  box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2); /* Enhanced shadow on hover */
}
.card-img-top {
  height: 200px;
  object-fit: cover;
}
</style>
