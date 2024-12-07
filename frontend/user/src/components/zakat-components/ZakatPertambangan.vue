<template>
  <div class="mb-3">
    <div class="mb-3">
      <label class="form-label">Keuntungan yang diperoleh</label>
      <div class="input-group">
        <span class="input-group-text">Rp.</span>
        <input
          type="number"
          class="form-control"
          placeholder="0"
          min="0"
          v-model="localData.keuntungan"
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
      Zakat pertambangan adalah zakat yang wajib dikeluarkan atas hasil tambang
      yang diperoleh, seperti emas, perak, batu bara, minyak, atau mineral
      lainnya, apabila telah mencapai nisab dan haul. Nisab zakat pertambangan
      untuk emas adalah <b>85 gram emas</b> atau <b>595 gram perak</b>.
    </p>
    <p class="description">
      Besaran zakat pertambangan adalah <b>2,5%</b> dari total hasil tambang
      yang diperoleh, apabila hasil tersebut melebihi nisab dan telah mencapai
      haul (satu tahun).
    </p>
    <p class="description">
      Zakat ini wajib dikeluarkan setiap tahun apabila hasil tambang yang
      dimiliki mencapai nisab dan haul, karena berkaitan dengan harta yang telah
      mencapai batas minimum dan telah dimiliki selama satu tahun.
    </p>
  </div>
</template>

<script>
export default {
  props: ["data"],
  data() {
    return {
      localData: {
        keuntungan: this.data.keuntungan || 0,
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
