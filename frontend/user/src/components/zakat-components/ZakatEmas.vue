<template>
  <div class="mb-3">
    <!-- <h2 class="card-title">Tentang Zakat Emas</h2>
    <p class="description">
      Zakat yang dikenakan atas Emas, perak dan logam lainnya yang telah
      mencapai nisab dan haul. Zakat Emas dan Perak ditunaikan jika seorang
      muzaki (orang yang menunaikan zakat) memiliki Emas mencapai nisab senilai
      85 gram (atau 91,92 gram Emas) atau perak dengan mencapai nisab 595 gram.
      Tarif zakat yang harus dibayarkan adalah sebesar 2,5% dari Emas atau perak
      yang dimiliki. Haul Zakat Emas dan Perak adalah satu tahun.
    </p> -->
    <div class="mb-3">
      <label for="logamMuliaType" class="form-label d-block"
        >Pilih Jenis Logam Mulia</label
      >
      <select
        v-model="selectedLogamMulia"
        class="form-select border rounded-3 p-2 w-100"
        id="logamMuliaType"
        @change="updateSelectedLogamMulia"
      >
        <option value="" selected disabled>Pilih Jenis Logam Mulia</option>
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
          v-model="localData.BeratEmasPerak"
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
          v-model="localData.HargaEmasPerak"
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
    <p class="description">
      Zakat Emas dan Perak adalah zakat yang dikenakan atas logam mulia yang
      dimiliki seseorang. Nisab zakat untuk <b>emas</b> adalah
      <b>85 gram</b> dan untuk <b>perak</b> adalah <b>595 gram</b>. Tarif zakat
      yang wajib dikeluarkan adalah sebesar <b>2,5%</b> dari total nilai logam
      mulia yang dimiliki jika telah mencapai nisab dan melewati haul (1 tahun
      kepemilikan).
    </p>
    <p class="description">
      Rumus perhitungannya adalah sebagai berikut:
      <b
        >Zakat = Berat Emas/Perak (gram) × Harga Emas/Perak per gram (Rp) ×
        2,5%</b
      >. Jika berat logam mulia yang dimiliki kurang dari nisab, maka zakat
      tidak wajib dikeluarkan.
    </p>
  </div>
</template>

<script>
export default {
  props: ["data"],
  data() {
    return {
      selectedLogamMulia: this.data.selectedLogamMulia || "emas",
      localData: {
        BeratEmasPerak: this.data.BeratEmasPerak || 0,
        HargaEmasPerak: this.data.HargaEmasPerak || 0,
      },
    };
  },
  watch: {
    localData: {
      handler(newData) {
        this.$emit("update:data", {
          ...newData,
          selectedLogamMulia: this.selectedLogamMulia,
        });
      },
      deep: true,
    },
  },
  computed: {
    nisabComputed() {
      return this.selectedLogamMulia === "emas" ? 85 : 595;
    },
  },
  methods: {
    updateSelectedLogamMulia() {
      this.$emit("update:data", {
        ...this.localData,
        selectedLogamMulia: this.selectedLogamMulia,
      });
    },
  },
};
</script>
