<template>
  <div class="container mt-5 pt-5">
    <h2 class="text-center mb-4">Kalkulator Zakat Mal</h2>

    <div class="card shadow-sm">
      <div class="card-body">
        <div class="mb-3">
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

        <!-- Zakat Emas -->
        <div v-if="selectedZakatType === 'emas'" class="mb-3">
          <div class="mb-3">
            <label for="logamMuliaType" class="form-label d-block"
              >Pilih Jenis Logam Mulia</label
            >
            <select
              v-model="selectedLogamMulia"
              class="form-select border rounded-3 p-2 w-100"
              id="logamMuliaType"
            >
              <option value="" selected disabled>
                Pilih Jenis Logam Mulia
              </option>
              <option value="emas">Emas</option>
              <option value="perak">Perak</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Berat Emas/Perak yang dimiliki</label>
            <div class="input-group">
              <input
                type="number"
                class="form-control"
                placeholder="0"
                v-model="BeratEmasPerak"
                min="0"
              />
              <span class="input-group-text">Gram</span>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Harga Emas/Perak saat ini</label>
            <div class="input-group">
              <span class="input-group-text">Rp</span>
              <input
                type="number"
                class="form-control"
                placeholder="Rp.0"
                v-model="HargaEmasPerak"
                min="0"
              />
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Nisab Emas/Perak</label>
            <div class="input-group">
              <input
                type="number"
                class="form-control"
                :value="nisabComputed"
                readonly
              />
              <span class="input-group-text">Gram</span>
            </div>
          </div>
        </div>

        <!-- Zakat Tabungan -->
        <div v-if="selectedZakatType === 'tabungan'" class="mb-3">
          <div class="mb-3">
            <label class="form-label"
              >Nilai tabungan atau investasi yang dimiliki</label
            >
            <div class="input-group">
              <span class="input-group-text">Rp.</span>
              <input
                type="number"
                class="form-control"
                placeholder="0"
                min="0"
                v-model="NilaiTabungan"
              />
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Harga emas per gram saat ini </label>
            <div class="input-group">
              <span class="input-group-text">Rp.</span>
              <input
                type="number"
                class="form-control"
                placeholder="0"
                min="0"
                v-model="HargaEmas"
              />
            </div>
          </div>
        </div>

        <!-- Zakat Perdagangan -->
        <div v-if="selectedZakatType === 'perdagangan'" class="mb-3">
          <div class="mb-3">
            <label class="form-label">Modal yang Diputar selama 1 tahun</label>
            <div class="input-group">
              <span class="input-group-text">Rp.</span>
              <input
                type="number"
                class="form-control"
                placeholder="0"
                min="0"
                v-model="modal"
              />
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Keuntungan selama 1 tahun</label>
            <div class="input-group">
              <span class="input-group-text">Rp.</span>
              <input
                type="number"
                class="form-control"
                placeholder="0"
                min="0"
                v-model="keuntungan"
              />
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Piutang Dagang</label>
            <div class="input-group">
              <span class="input-group-text">Rp.</span>
              <input
                type="number"
                class="form-control"
                placeholder="0"
                min="0"
                v-model="piutangDagang"
              />
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Utang jatuh tempo</label>
            <div class="input-group">
              <span class="input-group-text">Rp.</span>
              <input
                type="number"
                class="form-control"
                placeholder="0"
                min="0"
                v-model="utangJatuhTempo"
              />
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Kerugian selama 1 tahun</label>
            <div class="input-group">
              <span class="input-group-text">Rp.</span>
              <input
                type="number"
                class="form-control"
                placeholder="0"
                min="0"
                v-model="kerugian"
              />
            </div>
          </div>
        </div>

        <!-- Zakat Perusahaan -->
        <div v-if="selectedZakatType === 'perusahaan'" class="mb-3">
          <div class="mb-3">
            <label class="form-label">Keuntungan Bersih</label>
            <div class="input-group">
              <span class="input-group-text">Rp.</span>
              <input
                type="number"
                class="form-control"
                placeholder="0"
                min="0"
                v-model="keuntunganBersih"
              />
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Utang Lancar</label>
            <div class="input-group">
              <span class="input-group-text">Rp.</span>
              <input
                type="number"
                class="form-control"
                placeholder="0"
                min="0"
                v-model="UtangLancar"
              />
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Tahun Operasional</label>
            <div class="input-group">
              <input
                type="number"
                class="form-control"
                placeholder="0"
                min="0"
                v-model="TahunOperasional"
              />
              <span class="input-group-text">Tahun</span>
            </div>
          </div>
        </div>

        <!-- Zakat Pertanian -->
        <div v-if="selectedZakatType === 'pertanian'" class="mb-3">
          <div class="mb-3">
            <label for="zakatType" class="form-label d-block"
              >Pilih Jenis Pertanian</label
            >
            <select
              v-model="selectedPertanian"
              class="form-select border rounded-3 p-2 w-100"
              id="zakatType"
            >
              <option value="" selected disabled>Pilih Jenis Pertanian</option>
              <option value="gabah">Gabah</option>
              <option value="padi">Padi</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Hasil Panen</label>
            <div class="input-group">
              <input
                type="number"
                class="form-control"
                placeholder="Input hasil panen dalam satuan kg"
                v-model="hasilPanen"
                min="0"
              />
              <span class="input-group-text">kg</span>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Harga jual komoditas (per Kg)</label>
            <div class="input-group">
              <span class="input-group-text">Rp</span>
              <input
                type="number"
                class="form-control"
                placeholder="Isi harga jual di daerahmu saat membayar zakat"
                v-model="hargaJual"
                min="0"
              />
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Pilih Jenis Pengairan</label>
            <div>
              <div class="form-check">
                <input
                  type="radio"
                  class="form-check-input"
                  id="tadahHujan"
                  value="tadahHujan"
                  v-model="jenisPengairan"
                />
                <label class="form-check-label" for="tadahHujan">
                  Perairan Tadah Hujan
                </label>
              </div>
              <div class="form-check">
                <input
                  type="radio"
                  class="form-check-input"
                  id="berbayar"
                  value="berbayar"
                  v-model="jenisPengairan"
                />
                <label class="form-check-label" for="berbayar">
                  Perairan Berbayar
                </label>
              </div>
            </div>
          </div>
        </div>

        <!-- Zakat Peternakan -->
        <div v-if="selectedZakatType === 'peternakan'" class="mb-3">
          <div class="mb-3">
            <label for="zakatType" class="form-label d-block"
              >Pilih Jenis Peternakan</label
            >
            <select
              v-model="selectedPeternakan"
              class="form-select border rounded-3 p-2 w-100"
              id="zakatType"
            >
              <option value="" selected disabled>Pilih Jenis Peternakan</option>
              <option value="gabah">Sapi</option>
              <option value="padi">Domba</option>
              <option value="padi">Kerbau</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Jumlah hewan yang dimiliki</label>
            <div class="input-group">
              <input
                type="number"
                class="form-control"
                placeholder="0"
                v-model="JumlahHewan"
                min="0"
              />
              <span class="input-group-text">Ekor</span>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Harga hewan yang dipilih per-ekor</label>
            <div class="input-group">
              <span class="input-group-text">Rp</span>
              <input
                type="number"
                class="form-control"
                placeholder="Isi harga jual di daerahmu saat membayar zakat"
                v-model="hargaJual"
                min="0"
              />
            </div>
          </div>
        </div>

        <!-- Zakat Pertambangan -->
        <div v-if="selectedZakatType === 'pertambangan'" class="mb-3">
          <div class="mb-3">
            <label class="form-label">Keuntungan yang diperoleh </label>
            <div class="input-group">
              <span class="input-group-text">Rp.</span>
              <input
                type="number"
                class="form-control"
                placeholder="0"
                min="0"
                v-model="keuntungan"
              />
            </div>
          </div>
        </div>

        <!-- Zakat Pendapatan -->
        <div v-if="selectedZakatType === 'pendapatan'" class="mb-3">
          <div class="mb-3">
            <label class="form-label">Penghasilan Per Bulan</label>
            <div class="input-group">
              <span class="input-group-text">Rp.</span>
              <input
                type="number"
                class="form-control"
                placeholder="0"
                min="0"
                v-model="PenghasilanPerBulan"
              />
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Penghasilan Lain</label>
            <div class="input-group">
              <span class="input-group-text">Rp.</span>
              <input
                type="number"
                class="form-control"
                placeholder="0"
                min="0"
                v-model="PenghasilanLain"
              />
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Hutang/Cicilan</label>
            <div class="input-group">
              <span class="input-group-text">Rp.</span>
              <input
                type="number"
                class="form-control"
                placeholder="0"
                min="0"
                v-model="HutangCicilan"
              />
            </div>
          </div>
        </div>

        <!-- Zakat Rikaz -->
        <div v-if="selectedZakatType === 'rikaz'" class="mb-3">
          <div class="mb-3">
            <label class="form-label">Jumlah harta yang ditemukan</label>
            <div class="input-group">
              <span class="input-group-text">Rp.</span>
              <input
                type="number"
                class="form-control"
                placeholder="0"
                min="0"
                v-model="JumlahHarta"
              />
            </div>
          </div>
        </div>

        <!-- Calculate Button -->
        <button
          v-if="selectedZakatType"
          class="btn btn-success w-100 mt-3"
          @click="calculateZakat"
        >
          Hitung Zakat Saya
        </button>
      </div>
    </div>

    <!-- Modal for Zakat Calculation Result -->
    <div
      class="modal fade"
      id="zakatModal"
      tabindex="-1"
      aria-labelledby="zakatModalLabel"
      aria-hidden="true"
      ref="zakatModal"
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
            <h4 class="text-success">{{ zakatResult.toLocaleString() }}</h4>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
              @click="resetForm"
            >
              Hitung Kembali
            </button>
            <button
              type="button"
              class="btn btn-primary"
              data-bs-dismiss="modal"
            >
              Tunaikan Zakat
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Modal } from "bootstrap";

export default {
  data() {
    return {
      selectedZakatType: "",
      zakatResult: 0,
      // Zakat emas & logam mulia
      selectedLogamMulia: "emas",
      BeratEmasPerak: 0,
      HargaEmasPerak: 0,
      // Zakat tabungan
      NilaiTabungan: 0,
      HargaEmas: 0,
      // Zakat perdagangan
      modal: 0,
      keuntungan: 0,
      piutangDagang: 0,
      utangJatuhTempo: 0,
      kerugian: 0,
      // Zakat perusahaan
      keuntunganBersih: 0,
      UtangLancar: 0,
      TahunOperasional: 0,
      // Zakat pertanian
      jenisPengairan: "",
      hasilPanen: 0,
      hargaJual: 0,
      selectedPertanian: "",
      // Zakat peternakan
      selectedPeternakan: "",
      JumlahHewan: 0,
      hargaHewan: 0,
      // Zakat pendapatan
      PenghasilanPerBulan: 0,
      PenghasilanLain: 0,
      HutangCicilan: 0,
      // Zakat rikaz
      JumlahHarta: 0,
    };
  },
  computed: {
    nisabComputed() {
      return this.selectedLogamMulia === "emas" ? 85 : 595;
    },
  },
  methods: {
    calculateZakat() {
      this.zakatResult = 0;

      switch (this.selectedZakatType) {
        case "emas": {
          const zakatEmas = this.BeratEmasPerak * this.HargaEmasPerak * 0.025;
          this.zakatResult =
            zakatEmas >= this.nisabComputed * this.HargaEmasPerak
              ? zakatEmas
              : 0;
          break;
        }
        case "tabungan": {
          const nisabTabungan = 85 * this.HargaEmas;
          this.zakatResult =
            this.NilaiTabungan >= nisabTabungan
              ? this.NilaiTabungan * 0.025
              : 0;
          break;
        }
        case "perdagangan": {
          const nilaiKekayaan =
            this.modal +
            this.keuntungan +
            this.piutangDagang -
            this.utangJatuhTempo -
            this.kerugian;
          this.zakatResult = nilaiKekayaan * 0.025;
          break;
        }
        case "perusahaan": {
          const kekayaanBersih = this.keuntunganBersih - this.UtangLancar;
          this.zakatResult =
            this.TahunOperasional >= 1 ? kekayaanBersih * 0.025 : 0;
          break;
        }
        case "pertanian": {
          const rate = this.jenisPengairan === "tadahHujan" ? 0.1 : 0.05;
          this.zakatResult = this.hasilPanen * this.hargaJual * rate;
          break;
        }
        case "peternakan": {
          this.zakatResult = this.JumlahHewan * this.hargaHewan * 0.025;
          break;
        }
        case "pertambangan": {
          this.zakatResult = this.keuntungan * 0.025;
          break;
        }
        case "pendapatan": {
          const totalPendapatan =
            this.PenghasilanPerBulan * 12 + this.PenghasilanLain;
          const zakatPendapatan =
            totalPendapatan >= 85 * this.HargaEmas
              ? (totalPendapatan - this.HutangCicilan) * 0.025
              : 0;
          this.zakatResult = zakatPendapatan;
          break;
        }
        case "rikaz": {
          this.zakatResult = this.JumlahHarta * 0.2;
          break;
        }
      }

      this.$nextTick(() => {
        const zakatModal = new Modal(this.$refs.zakatModal);
        zakatModal.show();
      });
    },
    resetForm() {
      this.zakatResult = 0;
      this.selectedZakatType = "";
    },
  },
};
</script>

<style scoped>
.container {
  max-width: 700px;
}
.card {
  border-radius: 10px;
}
.btn-success {
  font-weight: bold;
}
</style>
