<template>
  <div class="container mt-5 p-5">
    <h2 class="text-center mb-4">Kalkulator Zakat</h2>

    <form @submit.prevent="hitungZakat">
      <div class="mb-3">
        <label for="penghasilan" class="form-label"
          >Penghasilan per bulan</label
        >
        <input
          type="number"
          v-model="penghasilan"
          class="form-control"
          placeholder="Rp. 0"
          min="0"
          required
        />
      </div>

      <div class="mb-3">
        <label for="penghasilanLain" class="form-label">Penghasilan lain</label>
        <input
          type="number"
          v-model="penghasilanLain"
          class="form-control"
          placeholder="Rp. 0"
          min="0"
          required
        />
      </div>

      <div class="mb-3">
        <label for="hutang" class="form-label">Hutang/Cicilan</label>
        <input
          type="number"
          v-model="hutang"
          class="form-control"
          placeholder="Rp. 0"
          min="0"
          required
        />
      </div>

      <button type="submit" class="btn btn-success w-100">
        Hitung Zakat Saya
      </button>
    </form>

    <!-- Modal -->
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
            <h5 class="modal-title" id="zakatModalLabel">Kalkulator Zakat</h5>
          </div>
          <div class="modal-body">
            <p>Hasil perhitungan zakat penghasilan kamu sebesar:</p>
            <h4 class="text-success">Rp. {{ zakat.toLocaleString() }}</h4>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              @click="hitungKembali"
            >
              Hitung Kembali Zakat
            </button>
            <button
              type="button"
              class="btn btn-success"
              @click="tunaikanZakat"
            >
              Tunaikan Sekarang
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import $ from "jquery";

export default {
  data() {
    return {
      penghasilan: 0,
      penghasilanLain: 0,
      hutang: 0,
      zakat: 0,
    };
  },
  methods: {
    hitungZakat() {
      const totalPenghasilan =
        parseFloat(this.penghasilan) + parseFloat(this.penghasilanLain);
      const totalHutang = parseFloat(this.hutang);
      const zakatPenghasilan = (totalPenghasilan - totalHutang) * 0.025;

      this.zakat = zakatPenghasilan > 0 ? zakatPenghasilan : 0;

      $("#zakatModal").modal("show");
    },
    hitungKembali() {
      $("#zakatModal").modal("hide");

      this.penghasilan = 0;
      this.penghasilanLain = 0;
      this.hutang = 0;
      this.zakat = 0;
    },
    tunaikanZakat() {
      this.$router.push("/formdonasi");
    },
  },
};
</script>

<style scoped>
.container {
  max-width: 600px;
}

h2 {
  font-weight: bold;
}

.modal-body h4 {
  font-size: 2rem;
}

.modal-footer button {
  width: 48%;
}
</style>
