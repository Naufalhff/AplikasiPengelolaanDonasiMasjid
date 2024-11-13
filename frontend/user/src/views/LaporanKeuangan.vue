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
        <div class="col-lg-4 mb-3">
          <div class="card shadow-sm p-4 stat-card">
            <h5>Saldo Saat Ini</h5>
            <h4 class="text-dark">Rp.7.000.000</h4>
          </div>
        </div>
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
          <select class="form-control" v-model="selectedDate">
            <option value="">Tanggal Donasi</option>
            <option value="Infaq">Infaq</option>
            <option value="Zakat">Zakat</option>
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
          <tr v-for="(donasi, index) in filteredDonations" :key="index">
            <td>{{ index + 1 }}</td>
            <td>{{ donasi.nama }}</td>
            <td>{{ donasi.jenisDonasi }}</td>
            <td>{{ donasi.tanggal }}</td>
            <td>{{ donasi.jumlah }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  name: "LaporanKeuangan",
  data() {
    return {
      selectedDonationType: "",
      donasiList: [
        { nama: "Tono", jenisDonasi: "Infaq", tanggal: "01-02-2022", jumlah: "Rp.1.000.000" },
        { nama: "Tono", jenisDonasi: "Zakat", tanggal: "02-03-2023", jumlah: "Rp.1.000.000" },
        { nama: "Tono", jenisDonasi: "Infaq", tanggal: "03-04-2022", jumlah: "Rp.1.000.000" },
        { nama: "Tono", jenisDonasi: "Infaq", tanggal: "04-05-2023", jumlah: "Rp.1.000.000" },
        { nama: "Tono", jenisDonasi: "Infaq", tanggal: "05-06-2024", jumlah: "Rp.1.000.000" },
        { nama: "Tono", jenisDonasi: "Infaq", tanggal: "06-07-2024", jumlah: "Rp.1.000.000" },
        { nama: "Tono", jenisDonasi: "Zakat", tanggal: "07-08-2024", jumlah: "Rp.1.000.000" },
      ]
    };
  },
  computed: {
    filteredDonations() {
      if (this.selectedDonationType) {
        return this.donasiList.filter(donasi => donasi.jenisDonasi === this.selectedDonationType);
      }
      return this.donasiList;
    }
  }
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
