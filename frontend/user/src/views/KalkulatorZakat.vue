<template>
  <div class="container mt-5 pt-5 mb-4">
    <div class="card shadow-sm">
      <div class="card-body">
        <!-- Dropdown Pilihan Jenis Zakat -->
        <div class="mb-3">
          <h2 class="text-center mb-4">Ayo Hitung Zakat Mal Anda Disini!</h2>
          <p>
            Kalkulator Zakat Mal dirancang untuk memudahkan umat Muslim dalam
            menghitung jumlah zakat mal yang wajib dibayar berdasarkan jenis
            harta yang dimiliki. Zakat mal sendiri merupakan zakat yang
            dikenakan atas harta benda yang telah mencapai nisab dan dimiliki
            selama satu tahun. Kalkulator ini dapat digunakan untuk menghitung
            zakat dari berbagai jenis harta yang berbeda, termasuk emas, perak,
            tabungan, perdagangan, perusahaan, pertanian, peternakan,
            pertambangan, dan pendapatan.
          </p>
          <label for="zakatType" class="form-label d-block"
            >Pilih Jenis Zakat</label
          >
          <select
            v-model="selectedZakatType"
            class="form-select border rounded-3 p-2 w-100"
            id="zakatType"
          >
            <option value="" selected disabled>Pilih Jenis Zakat</option>
            <option value="emas">Zakat Emas, Perak, dan Logam Mulia</option>
            <option value="tabungan">Zakat Tabungan dan Investasi</option>
            <option value="perdagangan">Zakat Perdagangan</option>
            <option value="perusahaan">Zakat Perusahaan</option>
            <option value="pertanian">
              Zakat Pertanian, Perkebunan, dan Kehutanan
            </option>
            <option value="peternakan">Zakat Peternakan</option>
            <option value="pertambangan">Zakat Pertambangan</option>
            <option value="pendapatan">Zakat Pendapatan dan Jasa</option>
            <option value="rikaz">Zakat Rikaz</option>
          </select>
        </div>

        <!-- Placeholder atau Komponen Jenis Zakat -->
        <div>
          <div v-if="!selectedZakatType" class="text-center mt-3">
            <p class="text-muted">
              Silakan pilih jenis zakat untuk memulai perhitungan.
            </p>
          </div>
          <component
            v-else-if="zakatComponent"
            :is="zakatComponent"
            v-model:data="zakatData"
          ></component>
        </div>

        <!-- Tombol Hitung Zakat -->
        <button
          v-if="selectedZakatType"
          class="btn btn-success w-100 mt-3"
          @click="calculateZakat"
        >
          Hitung Zakat Saya
        </button>
        <div v-if="alertMessage" class="alert alert-danger mt-2" role="alert">
          {{ alertMessage }}
        </div>
      </div>
    </div>

    <!-- Modal Hasil Perhitungan Zakat -->
    <div
      class="modal fade"
      id="zakatModal"
      tabindex="-1"
      aria-labelledby="zakatModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="zakatModalLabel">
              Hasil Perhitungan Zakat
            </h5>
          </div>
          <div class="modal-body">
            <p>Jumlah zakat yang harus dibayarkan:</p>
            <h4 class="text-success">{{ formatCurrency(zakatResult) }}</h4>
            <p v-if="alertMessage" class="text-danger">{{ alertMessage }}</p>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
              @click="recalculate"
            >
              Hitung Kembali
            </button>
            <button
              type="button"
              class="btn btn-primary"
              @click="copyToClipboard"
            >
              Salin
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ZakatEmas from "../components/zakat-components/ZakatEmas.vue";
import ZakatTabungan from "../components/zakat-components/ZakatTabungan.vue";
import ZakatPerdagangan from "../components/zakat-components/ZakatPerdagangan.vue";
import ZakatPerusahaan from "../components/zakat-components/ZakatPerusahaan.vue";
import ZakatPertanian from "../components/zakat-components/ZakatPertanian.vue";
import ZakatPeternakan from "../components/zakat-components/ZakatPeternakan.vue";
import ZakatPertambangan from "../components/zakat-components/ZakatPertambangan.vue";
import ZakatPendapatan from "../components/zakat-components/ZakatPendapatan.vue";
import ZakatRikaz from "../components/zakat-components/ZakatRikaz.vue";
import { Modal } from "bootstrap";

export default {
  data() {
    return {
      selectedZakatType: "",
      zakatData: {},
      zakatResult: 0,
      alertMessage: "",
      zakatModal: null,
    };
  },
  computed: {
    zakatComponent() {
      const components = {
        emas: ZakatEmas,
        tabungan: ZakatTabungan,
        perdagangan: ZakatPerdagangan,
        perusahaan: ZakatPerusahaan,
        pertanian: ZakatPertanian,
        peternakan: ZakatPeternakan,
        pertambangan: ZakatPertambangan,
        pendapatan: ZakatPendapatan,
        rikaz: ZakatRikaz,
      };
      return components[this.selectedZakatType] || null;
    },
  },
  watch: {
    selectedZakatType() {
      this.zakatData = {};
      this.alertMessage = "";
    },
  },
  mounted() {
    this.zakatModal = new Modal(document.getElementById("zakatModal"));
  },
  methods: {
    formatCurrency(value) {
      return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
      }).format(value);
    },
    calculateZakat() {
      this.alertMessage = "";

      if (this.selectedZakatType === "emas") {
        if (!this.zakatData.BeratEmasPerak || !this.zakatData.HargaEmasPerak) {
          this.alertMessage = "Silakan isi berat dan harga emas/perak.";
          return;
        }
      } else if (this.selectedZakatType === "tabungan") {
        if (!this.zakatData.NilaiTabungan || !this.zakatData.HargaEmas) {
          this.alertMessage = "Silakan isi nilai tabungan dan harga emas.";
          return;
        }
      } else if (this.selectedZakatType === "perdagangan") {
        if (
          !this.zakatData.modal ||
          !this.zakatData.keuntungan ||
          !this.zakatData.HargaEmas
        ) {
          this.alertMessage =
            "Silakan isi modal, keuntungan dan harga emas saat ini.";
          return;
        }
      } else if (this.selectedZakatType === "perusahaan") {
        if (
          !this.zakatData.keuntunganBersih ||
          !this.zakatData.TahunOperasional ||
          !this.zakatData.HargaEmas
        ) {
          this.alertMessage =
            "Silakan isi keuntungan bersih, tahun operational dan harga emas saat ini.";
          return;
        }
      } else if (this.selectedZakatType === "pertanian") {
        if (!this.zakatData.hasilPanen || !this.zakatData.hargaJual) {
          this.alertMessage = "Silakan isi hasil panen dan harga jual.";
          return;
        }
      } else if (this.selectedZakatType === "peternakan") {
        if (!this.zakatData.jumlahHewan || !this.zakatData.hargaHewan) {
          this.alertMessage = "Silakan isi jumlah hewan dan harga hewan.";
          return;
        }
      } else if (this.selectedZakatType === "pertambangan") {
        if (!this.zakatData.keuntungan || !this.zakatData.HargaEmas) {
          this.alertMessage = "Silakan isi keuntungan dan harga emas saat ini.";
          return;
        }
      } else if (this.selectedZakatType === "pendapatan") {
        if (!this.zakatData.PenghasilanPerBulan || !this.zakatData.HargaEmas) {
          this.alertMessage =
            "Silakan isi penghasilan per bulan dan Harga emas saat ini.";
          return;
        }
      } else if (this.selectedZakatType === "rikaz") {
        if (!this.zakatData.JumlahHarta) {
          this.alertMessage = "Silakan isi jumlah harta.";
          return;
        }
      }

      switch (this.selectedZakatType) {
        case "emas": {
          const beratEmasPerak = this.zakatData.BeratEmasPerak || 0;
          const hargaEmasPerak = this.zakatData.HargaEmasPerak || 0;
          const nisab = this.zakatData.selectedLogamMulia === "emas" ? 85 : 595;

          if (beratEmasPerak >= nisab) {
            this.zakatResult = beratEmasPerak * hargaEmasPerak * 0.025;
          } else {
            this.zakatResult = 0;
            this.alertMessage = "Belum wajib zakat";
          }
          break;
        }
        case "tabungan": {
          const nilaiTabungan = this.zakatData.NilaiTabungan || 0;
          const hargaEmas = this.zakatData.HargaEmas || 0;
          const nisabTabungan = 85 * hargaEmas;

          if (nilaiTabungan >= nisabTabungan) {
            this.zakatResult = nilaiTabungan * 0.025;
          } else {
            this.zakatResult = 0;
            this.alertMessage = "Belum wajib zakat";
          }
          break;
        }
        case "perdagangan": {
          const modal = this.zakatData.modal || 0;
          const keuntungan = this.zakatData.keuntungan || 0;
          const piutang = this.zakatData.piutangDagang || 0;
          const utang = this.zakatData.utangJatuhTempo || 0;
          const kerugian = this.zakatData.kerugian || 0;
          const nilaiKekayaan = modal + keuntungan + piutang - utang - kerugian;
          const nisabPerdagangan = 85 * this.zakatData.HargaEmas || 0;

          if (nilaiKekayaan >= nisabPerdagangan) {
            this.zakatResult = nilaiKekayaan * 0.025;
          } else {
            this.zakatResult = 0;
            this.alertMessage = "Belum wajib zakat";
          }
          break;
        }
        case "perusahaan": {
          const keuntunganBersih = this.zakatData.keuntunganBersih || 0;
          const utangLancar = this.zakatData.UtangLancar || 0;
          const tahunOperasional = this.zakatData.TahunOperasional || 0;
          const kekayaanBersih = keuntunganBersih - utangLancar;
          const nisabPerusahaan = 85 * this.zakatData.HargaEmas || 0;

          if (tahunOperasional >= 1 && kekayaanBersih >= nisabPerusahaan) {
            this.zakatResult = kekayaanBersih * 0.025;
          } else {
            this.zakatResult = 0;
            this.alertMessage = "Belum wajib zakat";
          }
          break;
        }
        case "pertanian": {
          const hasilPanen = this.zakatData.hasilPanen || 0;
          const hargaJual = this.zakatData.hargaJual || 0;
          const jenisPengairan = this.zakatData.jenisPengairan || "tadahHujan";
          const jenisPertanian = this.zakatData.selectedPertanian || "gabah";
          const nisab = jenisPertanian === "gabah" ? 1481 : 815;

          if (hasilPanen >= nisab) {
            const rate = jenisPengairan === "tadahHujan" ? 0.1 : 0.05;
            this.zakatResult = hasilPanen * hargaJual * rate;
          } else {
            this.zakatResult = 0;
            this.alertMessage = "Belum wajib zakat";
          }
          break;
        }
        case "peternakan": {
          const jumlahHewan = this.zakatData.jumlahHewan || 0;
          const jenisHewan = this.zakatData.jenisHewan || "domba";
          const hargaHewan = this.zakatData.hargaHewan || 0;

          let zakatResult = 0;
          let nisab = 0;

          if (jenisHewan === "domba") {
            nisab = 40;
            if (jumlahHewan >= nisab) {
              zakatResult = Math.floor(jumlahHewan / nisab) * hargaHewan;
            }
          } else if (jenisHewan === "sapi") {
            nisab = 30;
            if (jumlahHewan >= nisab) {
              zakatResult = Math.floor(jumlahHewan / nisab) * hargaHewan;
            }
          } else if (jenisHewan === "kerbau") {
            nisab = 5;
            if (jumlahHewan >= nisab) {
              zakatResult = Math.floor(jumlahHewan / nisab) * hargaHewan;
            }
          }

          if (zakatResult > 0) {
            this.zakatResult = zakatResult;
          } else {
            this.zakatResult = 0;
            this.alertMessage = "Belum wajib zakat";
          }
          break;
        }
        case "pertambangan": {
          const keuntunganPertambangan = this.zakatData.keuntungan || 0;
          const nisabPertambangan = 85 * this.zakatData.HargaEmas || 0;

          if (keuntunganPertambangan >= nisabPertambangan) {
            this.zakatResult = keuntunganPertambangan * 0.025;
          } else {
            this.zakatResult = 0;
            this.alertMessage = "Belum wajib zakat";
          }
          break;
        }
        case "pendapatan": {
          const penghasilanPerBulan = this.zakatData.PenghasilanPerBulan || 0;
          const penghasilanLain = this.zakatData.PenghasilanLain || 0;
          const hutangCicilan = this.zakatData.HutangCicilan || 0;
          const totalPendapatan =
            penghasilanPerBulan + penghasilanLain - hutangCicilan;
          const nisabPendapatan = 85 * this.zakatData.HargaEmas || 0;

          if (totalPendapatan >= nisabPendapatan) {
            this.zakatResult = totalPendapatan * 0.025;
          } else {
            this.zakatResult = 0;
            this.alertMessage = "Belum wajib zakat";
          }
          break;
        }
        case "rikaz": {
          const jumlahHarta = this.zakatData.JumlahHarta || 0;
          if (jumlahHarta > 0) {
            this.zakatResult = jumlahHarta * 0.2;
          } else {
            this.zakatResult = 0;
          }
          break;
        }
        default:
          this.zakatResult = 0;
          this.alertMessage = "Jenis zakat tidak valid.";
      }
      this.zakatModal.show();
    },
    recalculate() {
      if (this.zakatModal) {
        this.zakatModal.hide();
      }
    },
    copyToClipboard() {
      const amount = this.zakatResult;

      if (amount <= 0) {
        this.alertMessage = "Jumlah zakat tidak valid.";
        return;
      }
      const formattedAmount = this.formatCurrency(amount);

      navigator.clipboard
        .writeText(formattedAmount)
        .then(() => {
          console.log("Nominal zakat berhasil disalin ke clipboard");
          this.alertMessage = "Nominal zakat berhasil disalin!";
        })
        .catch((err) => {
          console.error("Gagal menyalin nominal zakat", err);
          this.alertMessage = "Gagal menyalin nominal zakat.";
        });
    },
  },
};
</script>

<style scoped>
.container {
  max-width: 800px;
}
.card {
  border-radius: 10px;
}
.card-body {
  padding: 2rem;
}
h2 {
  font-weight: bold;
  color: #4caf50;
}
.text-muted {
  font-size: 1.1rem;
}
.text-danger {
  color: red;
}
</style>
