<template>
      <div class="container py-4">
        <div class="d-flex justify-content-end mb-3">
          <RouterLink to="/create-activity">
            <button class="btn btn-success mx-2">Buat Kegiatan Baru</button>
          </RouterLink>
          <button
            class="btn btn-warning mx-2"
            @click="handleDeleteMode"
          >
            {{ deleteMode ? 'Batal' : 'Hapus Kegiatan' }}
          </button>
          <button
            v-if="deleteMode && selectedActivities.length > 0"
            class="btn btn-danger"
            @click="confirmBulkDelete"
          >
            Hapus Terpilih
          </button>
        </div>

        <!-- Card Grid Section with Conditional Delete Icon in Delete Mode -->
        <div class="row">
          <div class="col-md-4 col-sm-6 mb-3" v-for="activity in paginatedActivities" :key="activity.id">
            <div class="card h-100 shadow-sm position-relative card-small" @click="deleteMode ? null : editActivity(activity.id)">
              <img :src="activity.image" class="card-img-top" alt="Activity Image">
              <div class="card-body">
                <h6 class="card-title">{{ activity.title }}</h6>
                <p class="card-text"><strong>Terkumpul:</strong> {{ formatCurrency(activity.collected) }}</p>
                <p class="card-text"><strong>Donatur:</strong> {{ activity.donors }}</p>
              </div>

              <!-- Delete Checkbox, visible only in Delete Mode -->
              <div v-if="deleteMode" class="delete-checkbox position-absolute top-0 start-0 m-2">
                <input 
                  type="checkbox" 
                  :value="activity.id" 
                  v-model="selectedActivities"
                  @click.stop
                />
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
      deleteMode: false,
      currentPage: 1,
      pageSize: 6, // Max items per page set to 6
      selectedActivities: []
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
    editActivity(id) {
      this.$router.push({ name: 'EditActivity', params: { id } });
    },
    fetchPrograms() {
      axios
          .get("http://localhost:8000/api/donasi")
          .then((response) => {
            this.activities = response.data.map(program => ({
              id: program.id_kegiatan,
              title: program.nama_kegiatan,
              collected: program.anggaran_terkumpul,
              image: program.image || require('@/assets/images/infaq.jpeg'),
              donors: 0 // Initialize with 0
            }));

            // Fetch the number of donors for each activity
            this.activities.forEach((activity) => {
              axios
                  .get(`http://localhost:8000/api/jumlah_donatur/${activity.id}`)
                  .then((response) => {
                    activity.donors = response.data.jumlah_donatur;
                  })
                  .catch((error) => {
                    console.error("Error fetching donor count:", error);
                  });
            });

            console.log(this.activities);
          })
          .catch((error) => {
            console.error("Error fetching programs:", error);
          });
    },
    handleDeleteMode(){
      const userRole = sessionStorage.getItem("role");
      if (userRole !== "Pengurus Masjid") {
        alert("Forbidden");
        return;
      }
      this.toggleDeleteMode();
    },
    toggleDeleteMode() {
      this.deleteMode = !this.deleteMode;
      this.selectedActivities = [];
    },
    confirmBulkDelete() {
      if (confirm('Apakah Anda yakin ingin menghapus kegiatan yang dipilih?')) {
        this.deleteSelectedActivities();
      }
    },
    deleteSelectedActivities() {
      axios
          .delete('http://localhost:8000/api/hapus-kegiatan', {
            data: {
              ids: this.selectedActivities
            }
          })
          .then(() => {
            this.activities = this.activities.filter(activity => !this.selectedActivities.includes(activity.id));
            this.selectedActivities = [];
            this.deleteMode = false;

            if (this.currentPage > this.totalPages) {
              this.currentPage = this.totalPages || 1;
            }

            alert('Kegiatan terpilih berhasil dihapus!');
          })
          .catch((error) => {
            if (error.response && error.response.data.warning) {
              const kegiatanBersaldo = error.response.data.kegiatan_bersaldo;
              let message = "Beberapa kegiatan masih memiliki saldo tersisa:\n";
              kegiatanBersaldo.forEach((kegiatan) => {
                message += `- ${kegiatan.nama_kegiatan}: Rp ${kegiatan.saldo_tersisa.toLocaleString('id-ID')}\n`;
              });
              alert(message);
            } else {
              console.error("Error deleting activities:", error);
              alert('Terjadi kesalahan saat menghapus kegiatan.');
            }
          });
    },
    formatCurrency(value) {
      return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
      }).format(value);
    }
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
  height: 250px; /* Reduced height */
}

.card-small:hover {
  transform: translateY(-4px);
  box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15);
}

.card-img-top {
  height: 130px; /* Reduced image height */
  object-fit: cover;
  border-radius: 8px 8px 0 0;
}

.card-title {
  font-size: 1rem;
  font-weight: bold;
}

.delete-checkbox {
  transform: scale(1.2);
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
