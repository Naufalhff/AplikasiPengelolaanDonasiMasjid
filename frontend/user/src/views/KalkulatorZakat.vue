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
            <option value="uang">Zakat Uang dan Surat Berharga</option>
            <option value="perdagangan">Zakat Perdagangan</option>
            <option value="perusahaan">Zakat Perusahaan</option>
            <option value="pertanian">
              Zakat Pertanian, Perkebunan, dan Kehutanan
            </option>
            <option value="peternakan">Zakat Peternakan dan Perikanan</option>
            <option value="pertambangan">Zakat Pertambangan</option>
            <option value="pendapatan">Zakat Pendapatan dan Jasa</option>
            <option value="rikaz">Zakat Rikaz</option>
          </select>
        </div>

        <!-- Conditional Input Fields Based on Zakat Type -->
        <div v-if="selectedZakatType === 'emas'" class="mb-3">
          <div class="mb-3">
            <label for="zakatType" class="form-label d-block"
              >Pilih Jenis Logam Mulia</label
            >
            <select
              v-model="selectedLogamMulia"
              class="form-select border rounded-3 p-2 w-100"
              id="LogamMuliaType"
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
              <span class="input-group-text">Rp</span>
              <input
                type="number"
                class="form-control"
                placeholder="Rp.0"
                v-model="NisabEmasPerak"
                min="0"
              />
            </div>
          </div>
        </div>

        <div v-if="selectedZakatType === 'uang'" class="mb-3">
          <label class="form-label">Jumlah Uang dan Surat Berharga</label>
          <input
            type="number"
            v-model="uang"
            class="form-control"
            placeholder="Rp. 0"
            min="0"
          />
        </div>

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

        <div v-if="selectedZakatType === 'peternakan'" class="mb-3">
          <label class="form-label">Jumlah Ternak</label>
          <input
            type="number"
            v-model="jumlahTernak"
            class="form-control"
            placeholder="Masukkan jumlah ternak"
            min="0"
          />
        </div>

        <div v-if="selectedZakatType === 'pertambangan'" class="mb-3">
          <label class="form-label">Nilai Hasil Tambang (Rp)</label>
          <input
            type="number"
            v-model="nilaiTambang"
            class="form-control"
            placeholder="Rp. 0"
            min="0"
          />
        </div>

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

        <div v-if="selectedZakatType === 'rikaz'" class="mb-3">
          <label class="form-label">Nilai Rikaz (Harta Terpendam) (Rp)</label>
          <input
            type="number"
            v-model="nilaiRikaz"
            class="form-control"
            placeholder="Rp. 0"
            min="0"
          />
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
      selectedZakatType: "perdagangan",
      modal: 0,
      keuntungan: 0,
      piutangDagang: 0,
      utangJatuhTempo: 0,
      kerugian: 0,
      keuntunganBersih: 0,
      TahunOperasional: 0,
      UtangLancar: 0,
      jenisPengairan: "",
      zakatResult: 0,
      selectedPertanian: "",
      hargaJual: 0,
      hasilPanen: 0,
    };
  },
  methods: {
    calculateZakat() {
      this.zakatResult = 0;
      if (this.selectedZakatType === "emas") {
        this.zakatResult = this.emas * 0.025;
      } else if (this.selectedZakatType === "uang") {
        this.zakatResult = this.uang * 0.025;
      } else if (this.selectedZakatType === "perdagangan") {
        const nilaiKekayaan =
          this.modal +
          this.keuntungan +
          this.piutangDagang -
          this.utangJatuhTempo -
          this.kerugian;
        this.zakatResult = nilaiKekayaan * 0.025;
      } else if (this.selectedZakatType === "pertanian") {
        if (this.hasilPanen > 0 && this.hargaJual > 0 && this.jenisPengairan) {
          let zakat;
          if (this.jenisPengairan === "tadahHujan") {
            zakat = this.hasilPanen * this.hargaJual * 0.1;
          } else if (this.jenisPengairan === "berbayar") {
            zakat = this.hasilPanen * this.hargaJual * 0.05;
          }
          return zakat.toFixed(2);
        }
        return 0;
      } else if (this.selectedZakatType === "peternakan") {
        this.zakatResult = this.jumlahTernak * 0.025;
      } else if (this.selectedZakatType === "pertambangan") {
        this.zakatResult = this.nilaiTambang * 0.025;
      } else if (this.selectedZakatType === "pendapatan") {
        this.zakatResult = this.pendapatan * 0.025;
      } else if (this.selectedZakatType === "rikaz") {
        this.zakatResult = this.nilaiRikaz * 0.2;
      } else if (this.selectedZakatType === "perusahaan") {
        const kekayaanBersih = this.keuntunganBersih - this.UtangLancar;
        if (this.TahunOperasional >= 1) {
          this.zakatResult = kekayaanBersih * 0.025;
        } else {
          this.zakatResult = 0;
        }
      }

      this.zakatResult = this.zakatResult.toLocaleString("id-ID", {
        style: "currency",
        currency: "IDR",
      });
      // Show result in modal
      const zakatModal = new Modal(document.getElementById("zakatModal"));
      zakatModal.show();
    },
    resetForm() {
      this.selectedZakatType = "";
      this.zakatResult = 0;
      this.emas = 0;
      this.uang = 0;
      this.nilaiDagangan = 0;
      this.hasilPanen = 0;
      this.jumlahTernak = 0;
      this.nilaiTambang = 0;
      this.pendapatan = 0;
      this.nilaiRikaz = 0;
      this.modal = 0;
      this.keuntungan = 0;
      this.piutangDagang = 0;
      this.utangJatuhTempo = 0;
      this.kerugian = 0;
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
