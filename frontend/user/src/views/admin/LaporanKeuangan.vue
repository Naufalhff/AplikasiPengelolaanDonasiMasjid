<template>
  <div class="container mt-4">
    <!-- Top Statistics -->
    <div class="statistics-card p-4 mb-4">
      <div class="row">
        <!-- Total Donations -->
        <div class="col-lg-4 mb-3">
          <div class="card shadow-sm p-4 stat-card">
            <h5>Total Donasi</h5>
            <h4 class="text-dark">Rp.7.000.000</h4>
          </div>
        </div>
        <!-- Total Transactions -->
        <div class="col-lg-4 mb-3">
          <div class="card shadow-sm p-4 stat-card">
            <h5>Total Transaksi</h5>
            <h4 class="text-dark">70</h4>
          </div>
        </div>
        <!-- Current Balance -->
        <!-- <div class="col-lg-4 mb-3">
          <div class="card shadow-sm p-4 stat-card">
            <h5>Saldo Saat Ini</h5>
            <h4 class="text-dark">Rp.7.000.000</h4>
          </div> -->
        <!-- </div> -->
      </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-card p-3 mb-4">
      <div class="row">
        <div class="col-md-3">
          <select class="form-control" v-model="selectedDonationType">
            <option value="">Semua Jenis Donasi</option>
            <option value="Infaq">Infaq</option>
            <option value="Zakat">Zakat</option>
          </select>
        </div>
        <div class="col-md-3">
          <select class="form-control" v-model="selectedYear">
            <option value="">Pilih Tahun</option>
            <option v-for="year in years" :key="year" :value="year">{{ year }}</option>
          </select>
        </div>
        <div class="col-md-3">
          <select class="form-control" v-model="selectedMonth">
            <option value="">Pilih Bulan</option>
            <option v-for="(month, index) in months" :key="index" :value="index + 1">
              {{ month }}
            </option>
          </select>
        </div>
      </div>
    </div>

    <!-- Donation Table -->
    <div class="table-card p-4">
      <h5 class="text-center mb-3">Donatur</h5>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nomor</th>
            <th>Nama</th>
            <th>Jenis Donasi</th>
            <th>Tanggal Donasi</th>
            <th>Jumlah</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(donasi, index) in paginatedDonations" :key="index">
            <td>{{ (index + 1) + (currentPage - 1) * DataperPage }}</td>
            <td>{{ donasi.nama }}</td>
            <td>{{ donasi.jenisDonasi }}</td>
            <td>{{ donasi.tanggal }}</td>
            <td>{{ donasi.jumlah }}</td>
          </tr>
        </tbody>
      </table>

      <!-- Pagination Controls -->
      <div class="pagination-controls text-center mt-3">
        <button 
          class="btn btn-primary" 
          :disabled="currentPage === 1" 
          @click="currentPage--">Previous</button>
        <span>Page {{ currentPage }} of {{ totalPages }}</span>
        <button 
          class="btn btn-primary" 
          :disabled="currentPage === totalPages" 
          @click="currentPage++">Next</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "LaporanKeuangan",
  data() {
    return {
      selectedDonationType: "",
      selectedYear: "",
      selectedMonth: "",
      donasiList: [
        { nama: "Ariq", jenisDonasi: "Infaq", tanggal: "01-02-2026", jumlah: "Rp.1.000.000" },
        { nama: "Firly", jenisDonasi: "Zakat", tanggal: "02-03-2025", jumlah: "Rp.1.000.000" },
        { nama: "Tono", jenisDonasi: "Infaq", tanggal: "03-04-2024", jumlah: "Rp.1.000.000" },
        { nama: "Zuhri", jenisDonasi: "Zakat", tanggal: "04-05-2026", jumlah: "Rp.1.000.000" },
        { nama: "Sidiq", jenisDonasi: "Infaq", tanggal: "05-06-2024", jumlah: "Rp.1.000.000" },
        { nama: "Yazid", jenisDonasi: "Infaq", tanggal: "06-07-2024", jumlah: "Rp.1.000.000" },
        { nama: "Jagad", jenisDonasi: "Zakat", tanggal: "07-08-2024", jumlah: "Rp.1.000.000" },
        { nama: "Rizky", jenisDonasi: "Infaq", tanggal: "05-06-2025", jumlah: "Rp.1.000.000" },
        { nama: "Ariq", jenisDonasi: "Infaq", tanggal: "06-07-2027", jumlah: "Rp.1.000.000" },
        { nama: "AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz", jenisDonasi: "Zakat", tanggal: "07-08-2028", jumlah: "Rp.1.000.000" },
        { nama: "Jagad", jenisDonasi: "Zakat", tanggal: "07-08-2024", jumlah: "Rp.1.000.000" },
        { nama: "Rizky", jenisDonasi: "Infaq", tanggal: "05-06-2025", jumlah: "Rp.1.000.000" },
        { nama: "Ariq", jenisDonasi: "Infaq", tanggal: "06-07-2027", jumlah: "Rp.1.000.000" },
      ],
      years: Array.from({ length: 2080 - 2024 + 1 }, (_, i) => 2024 + i),
      months: [
        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember",
      ],
      currentPage: 1,
      DataperPage: 10, // Menentukan jumlah data yang ditampilkan per halaman
    };
  },
  computed: {
    filteredDonations() {
      return this.donasiList.filter((donasi) => {
        const [, month, year] = donasi.tanggal.split("-").map(Number);
        return (
          (!this.selectedDonationType || donasi.jenisDonasi === this.selectedDonationType) &&
          (!this.selectedYear || year === Number(this.selectedYear)) &&
          (!this.selectedMonth || month === Number(this.selectedMonth))
        );
      });
    },
    totalPages() {
      return Math.ceil(this.filteredDonations.length / this.DataperPage);
    },
    paginatedDonations() {
      const start = (this.currentPage - 1) * this.DataperPage;
      return this.filteredDonations.slice(start, start + this.DataperPage);
    },
  },
};
</script>

<style scoped>
.container {
  max-width: 1100px;
  margin: auto;
  padding-top: 60px;
}

.statistics-card, .filter-card, .table-card {
  background-color: #f8f9fa;
  border: 1px solid #ddd;
  border-radius: 10px;
}

.stat-card {
  background-color: #ffffff;
  border-radius: 8px;
  text-align: center;
  border: 1px solid #ddd;
}

.filter-card {
  padding: 15px;
}

.table-card {
  padding: 20px;
}

.table {
  margin-top: 1rem;
}

.table th, .table td {
  text-align: center;
  vertical-align: middle;
}

.form-control {
  border-radius: 6px;
  border: 1px solid #ced4da;
}
</style>
