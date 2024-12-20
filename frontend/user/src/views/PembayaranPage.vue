<template>
  <div class="container mt-5 pt-5 mb-3">
    <div class="card shadow-sm">
      <div class="card-body">
        <div class="d-flex align-items-center mb-3">
          <img
            :src="'http://localhost:8000/storage/' + data.foto_kegiatan"
            alt="Donasi"
            class="rounded"
            width="100"
            height="100"
          />
          <div class="ml-3">
            <h5 class="mb-1">{{ data.nama_kegiatan }}</h5>
            <p class="text-muted mb-0">DKM Masjid Luqmanul Hakim</p>
          </div>
        </div>

        <!-- Payment Instructions -->
        <h6 class="font-weight-bold">Selesaikan Pembayaran Anda</h6>
        <div class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Total Donasi</span>
          <span class="font-weight-bold">{{
            formatCurrency(selectedAmount)
          }}</span>
        </div>

        <!-- Account Number for BSI -->
        <div class="mb-3" v-if="metodePembayaran === 'BSI'">
          <p class="mb-0">Nomor Rekening:</p>
          <div class="d-flex justify-content-between align-items-center">
            <h4 v-if="payment.bsi && payment.bsi.length > 0">{{ payment.bsi[0].informasi_rekening }}</h4>
            <button
              class="btn btn-outline-secondary btn-sm"
              @click="copyAccountNumber"
            >
              <i class="fas fa-copy"></i> Salin
            </button>
          </div>
        </div>

        <!-- Payment Method Tabs for BSI -->
        <div v-if="metodePembayaran === 'BSI'">
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
                <li>Masukkan kartu ATM BSI & PIN</li>
                <li>Pilih transaksi lainnya</li>
                <li>Pilih transfer</li>
                <li>Pilih transfer sesama BSI atau Antar Bank</li>
                <li>Masukkan nomor rekening tujuan</li>
                <li>Masukkan jumlah yang ingin dibayarkan</li>
                <li>Validasi pembayaran anda</li>
                <li>Pembayaran selesai</li>
              </ul>
            </div>

            <!-- M-Banking Instructions -->
            <div class="tab-pane fade" id="mbanking" role="tabpanel">
              <ul class="list-unstyled">
                <li>Buka aplikasi BSI Mobile</li>
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
        </div>

        <!-- Payment Method Tabs for QRIS -->
        <div v-if="metodePembayaran === 'QRIS'">
          <ul class="nav nav-tabs mb-3" role="tablist">
            <li class="nav-item">
              <a
                class="nav-link active"
                id="qris-tab"
                data-toggle="tab"
                href="#qris"
                role="tab"
                >Cara Pembayaran</a
              >
            </li>
          </ul>

          <div class="tab-content">
            <!-- QRIS Instructions -->
            <div class="tab-pane fade show active" id="QRIS" role="tabpanel">
              <p class="mb-0">Scan kode QRIS di bawah ini untuk membayar:</p>
              <img v-if="payment.qris && payment.qris.length > 0"
                :src="'http://localhost:8000/storage/' + payment.qris[0].informasi_rekening"
                alt="QRIS"
                class="img-fluid mx-auto"
                style="max-width: 200px"
              />
              <h6 class="font-weight-bold mt-3">Cara Pembayaran QRIS:</h6>
              <ul>
                <li>
                  Buka Aplikasi Gopay/OVO/Shopeepay/LinkAja/DANA atau lainnya
                </li>
                <li>Pilih Scan pada menu aplikasi Anda</li>
                <li>Lakukan Scan pada Barcode di atas</li>
                <li>Pilih Bayar dan masukkan PIN Anda</li>
                <li>Tunggu hingga proses pembayaran berhasil</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Final Action -->
        <p class="text-muted">
          Silahkan melakukan transfer ke nomor Rekening di atas. Sistem kami
          akan memverifikasi.
        </p>
        <button class="btn btn-success btn-block" @click="completePayment">
          Upload Bukti Pembayaran
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      donation: {
        image: require("../assets/images/infaq.jpeg"),
      },
      data: {},
      payment: {},
      selectedAmount: this.$route.query.amount || 0,
      metodePembayaran: this.$route.query.payment || "BSI",
      rekening: "",
      qrisImage: require("../assets/images/qris.jpg"),
    };
  },
  mounted() {
    this.fetchData();
    this.setRekening();
  },
  watch: {
    "$route.query.amount"(newAmount) {
      this.selectedAmount = newAmount;
    },
    "$route.query.payment"(newPayment) {
      this.metodePembayaran = newPayment;
      this.setRekening(); // update rekening when payment method changes
    },
  },
  methods: {
    fetchData() {
      const id = this.$route.query.id;

      Promise.all([
        axios.get(`http://localhost:8000/api/donasi/${id}`),
        axios.get(`http://localhost:8000/api/getPaymentById/${id}`)
      ])
        .then(([donasiResponse, paymentResponse]) => {
          this.data = donasiResponse.data;
          this.payment = paymentResponse.data;
          console.log(this.payment.qris[0].informasi_rekening)
        })
        .catch((error) => {
          console.error("Error fetching data:", error);
      });
    },
    formatCurrency(value) {
      return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
      }).format(value);
    },
    setRekening() {
      if (this.metodePembayaran === "BSI") {
        this.rekening = "1234567890"; // Replace with actual BSI account number
      } else if (this.metodePembayaran === "QRIS") {
        this.rekening = "0987654321"; // Replace with actual QRIS account number
      } else {
        this.rekening = "Nomor rekening tidak tersedia";
      }
    },
    copyAccountNumber() {
      navigator.clipboard.writeText(this.rekening);
    },
    completePayment() {
      this.$router.push({
        path: "/detaildonasi/nominal/formdonasi/pembayaran/uploadbukti",
        query: {
          id: this.data.id_kegiatan,
          name: this.$route.query.name,
          phone: this.$route.query.phone,
          address: this.$route.query.address,
          email: this.$route.query.email,
          amount: this.$route.query.amount,
          payment: this.$route.query.payment,
        },
      });
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
