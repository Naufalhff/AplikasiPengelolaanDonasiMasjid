<template>
  <div class="mb-3">
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
          v-model="localData.NilaiTabungan"
        />
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Harga emas per gram saat ini</label>
      <div class="input-group">
        <span class="input-group-text">Rp.</span>
        <input
          type="number"
          class="form-control"
          placeholder="0"
          min="0"
          v-model="localData.HargaEmas"
        />
      </div>
    </div>
    <p class="description">
      Zakat tabungan dikenakan jika nilai tabungan atau investasi Anda telah
      mencapai nisab, yaitu senilai <b>85 gram emas</b>. Tarif zakat yang harus
      dikeluarkan adalah <b>2.5%</b> dari total nilai tabungan Anda. Rumus
      perhitungan zakat tabungan adalah: <b>Zakat = Nilai Tabungan × 2.5%</b>.
    </p>
  </div>
</template>

<script>
export default {
  props: ["data"],
  data() {
    return {
      localData: {
        NilaiTabungan: this.data.NilaiTabungan || 0,
        HargaEmas: this.data.HargaEmas || 0,
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
