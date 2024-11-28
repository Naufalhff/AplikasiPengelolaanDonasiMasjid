<template>
  <div class="container py-4">
    <h2 class="text-center fw-bold mb-4">Pilih Kegiatan</h2>

    <div class="row">
      <div class="col-md-4 col-sm-6 mb-3" v-for="activity in paginatedActivities" :key="activity.id">
        <div class="card h-100 shadow-sm position-relative card-small" @click="deleteMode ? null : historyActivity(activity.id)">
          <img :src="activity.image" class="card-img-top" alt="Activity Image">
          <div class="card-body">
            <h6 class="card-title">{{ activity.title }}</h6>
            <p class="card-text"><strong>Terkumpul:</strong> {{ formatCurrency(activity.collected) }}</p>
            <p class="card-text"><strong>Pengeluaran:</strong> {{ formatCurrency(activity.expense) }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Pagination Controls -->
    <div class="pagination-controls d-flex justify-content-center align-items-center mt-4">
      <button
          class="btn btn-outline-primary mx-1"
          :disabled="currentPage === 1"
          @click="currentPage--">
        Previous
      </button>
      <span class="mx-2">Page {{ currentPage }} of {{ totalPages }}</span>
      <button
          class="btn btn-outline-primary mx-1"
          :disabled="currentPage === totalPages"
          @click="currentPage++">
        Next
      </button>
    </div>
  </div>
</template>

<script>
import axios from "@/axios";

export default {
  data() {
    return {
      activities: [],
      currentPage: 1,
      pageSize: 6,
    };
  },
  computed: {
    paginatedActivities() {
      const start = (this.currentPage - 1) * this.pageSize;
      const end = start + this.pageSize;
      return this.activities.slice(start, end);
    },
    totalPages() {
      return Math.ceil(this.activities.length / this.pageSize);
    }
  },
  methods: {
    historyActivity(id) {
      this.$router.push({ name: 'RiwayatPengeluaran', params: { id } });
    },
    fetchPrograms() {
      axios
          .get("http://localhost:8000/api/donasi")
          .then((response) => {
            this.activities = response.data.map(program => ({
              id: program.id_kegiatan,
              title: program.nama_kegiatan,
              collected: program.anggaran_terkumpul,
              expense: program.anggaran_pengeluaran,
              image: program.image || require('@/assets/images/infaq.jpeg')
            }));
            console.log(this.activities);
          })
          .catch((error) => {
            console.error("Error fetching programs:", error);
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
    this.fetchPrograms();
  },
};
</script>

<style scoped>
.container {
  max-width: 1200px;
}

.card-small {
  border-radius: 8px;
  transition: transform 0.2s, box-shadow 0.2s;
  cursor: pointer;
  height: 250px;
}

.card-small:hover {
  transform: translateY(-4px);
  box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15);
}

.card-img-top {
  height: 130px;
  object-fit: cover;
  border-radius: 8px 8px 0 0;
}

.card-title {
  font-size: 1rem;
  font-weight: bold;
}

.pagination-controls {
  font-size: 1rem;
}

.btn-outline-primary {
  border-radius: 20px;
  font-weight: bold;
}

.btn {
  min-width: 100px;
}

@media (max-width: 767px) {
  .card-img-top {
    height: 100px;
  }

  .btn {
    min-width: 80px;
  }
}
</style>