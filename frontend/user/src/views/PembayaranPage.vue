<template>
  <div class="container mt-5">
    <div class="card shadow-sm">
      <div class="card-body">
        <div class="d-flex align-items-center mb-3">
          <img
            src="https://via.placeholder.com/100x100"
            alt="Donation Image"
            class="rounded"
            width="100"
            height="100"
          />
          <div class="ml-3">
            <h5 class="mb-1">
              Donasi Penggalangan Dana korban bencana Gempa Bumi
            </h5>
            <p class="text-muted mb-0">DKM Masjid Luqmanul Hakim</p>
          </div>
        </div>

        <!-- Payment Instructions -->
        <h6 class="font-weight-bold">Selesaikan Pembayaran Anda</h6>
        <div class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Total Donasi</span>
          <span class="font-weight-bold">Rp. 50.000</span>
        </div>

        <!-- Account Number -->
        <div class="mb-3">
          <p class="mb-0">Nomor Rekening:</p>
          <div class="d-flex justify-content-between align-items-center">
            <h4>32425262732</h4>
            <button
              class="btn btn-outline-secondary btn-sm"
              @click="copyAccountNumber"
            >
              <i class="fas fa-copy"></i> Salin
            </button>
          </div>
        </div>

        <!-- Payment Method Tabs -->
        <ul class="nav nav-tabs mb-3" role="tablist">
          <li class="nav-item">
            <a
              class="nav-link active"
              id="atm-tab"
              data-toggle="tab"
              href="#atm"
              role="tab"
              >ATM</a
            >
          </li>
          <li class="nav-item">
            <a
              class="nav-link"
              id="mbanking-tab"
              data-toggle="tab"
              href="#mbanking"
              role="tab"
              >M-Banking</a
            >
          </li>
        </ul>
        <div class="tab-content">
          <!-- ATM Instructions -->
          <div class="tab-pane fade show active" id="atm" role="tabpanel">
            <ul class="list-unstyled">
              <li>Masukkan kartu ATM BCA & PIN</li>
              <li>Pilih transaksi lainnya</li>
              <li>Pilih transfer</li>
              <li>Pilih transfer sesama BCA</li>
              <li>Masukkan nomor rekening tujuan</li>
              <li>Masukkan jumlah yang ingin dibayarkan</li>
              <li>Validasi pembayaran anda</li>
              <li>Pembayaran selesai</li>
            </ul>
          </div>

          <!-- M-Banking Instructions -->
          <div class="tab-pane fade" id="mbanking" role="tabpanel">
            <ul class="list-unstyled">
              <li>Buka aplikasi BCA Mobile</li>
              <li>Pilih "m-Transfer"</li>
              <li>Pilih transfer</li>
              <li>Pilih "Transfer Antar Bank"</li>
              <li>Masukkan nomor rekening tujuan</li>
              <li>Masukkan jumlah yang ingin dibayarkan</li>
              <li>Validasi pembayaran anda</li>
              <li>Pembayaran selesai</li>
            </ul>
          </div>
        </div>

        <!-- Final Action -->
        <p class="text-muted">
          Silahkan melakukan transfer ke nomor Rekening diatas. Sistem kami akan
          memverifikasi.
        </p>
        <button class="btn btn-success btn-block" @click="completePayment">
          Saya telah menyelesaikan pembayaran
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    copyAccountNumber() {
      navigator.clipboard.writeText("32425262732");
      alert("Nomor rekening berhasil disalin!");
    },
    completePayment() {
      this.$router.push("/uploadbukti");
    },
  },
};
</script>

<style scoped>
h5,
h6 {
  font-weight: bold;
}

.nav-tabs .nav-link.active {
  background-color: #f8f9fa;
  border-color: #dee2e6 #dee2e6 #fff;
}

.nav-tabs .nav-link {
  color: #495057;
}
</style>
