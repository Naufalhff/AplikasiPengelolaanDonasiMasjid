<template>
  <div class="mb-3">
    <div class="mb-3">
      <label for="zakatType" class="form-label d-block"
        >Pilih Jenis Pertanian</label
      >
      <select
        v-model="localData.selectedPertanian"
        class="form-select border rounded-3 p-2 w-100"
        id="zakatType"
      >
        <option value="" selected disabled>Pilih Jenis Pertanian</option>
        <option value="gabah">Gabah</option>
        <option value="beras">Beras</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Hasil Panen</label>
      <div class="input-group">
        <input
          type="number"
          class="form-control"
          placeholder="Input hasil panen dalam satuan kg"
          v-model="localData.hasilPanen"
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
          v-model="localData.hargaJual"
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
            v-model="localData.jenisPengairan"
          />
          <label class="form-check-label" for="tadahHujan"
            >Perairan Tadah Hujan</label
          >
        </div>
        <div class="form-check">
          <input
            type="radio"
            class="form-check-input"
            id="berbayar"
            value="berbayar"
            v-model="localData.jenisPengairan"
          />
          <label class="form-check-label" for="berbayar"
            >Perairan Berbayar</label
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["data"],
  data() {
    return {
      localData: {
        selectedPertanian: this.data.selectedPertanian || "",
        hasilPanen: this.data.hasilPanen || 0,
        hargaJual: this.data.hargaJual || 0,
        jenisPengairan: this.data.jenisPengairan || "tadahHujan",
      },
    };
  },
  watch: {
    localData: {
      handler(newData) {
        this.$emit("update:data", newData);
      },
      deep: true,
    },
  },
};
</script>
