<template>
  <div class="mb-3">
    <div class="mb-3">
      <label class="form-label">Jumlah harta yang ditemukan</label>
      <div class="input-group">
        <span class="input-group-text">Rp.</span>
        <input
          type="number"
          class="form-control"
          placeholder="0"
          min="0"
          v-model="localData.JumlahHarta"
        />
      </div>
    </div>
    <p class="description">
      Zakat rikaz adalah zakat yang wajib dikeluarkan atas harta temuan atau
      barang peninggalan yang terkubur (harta karun) yang ditemukan oleh
      seseorang. Harta ini termasuk barang yang bernilai dan tidak diketahui
      pemiliknya.
    </p>
    <p class="description">
      Besaran zakat rikaz yang harus dikeluarkan adalah <b>20%</b> (seperlima)
      dari total nilai harta temuan tersebut. Zakat ini wajib dikeluarkan segera
      setelah harta ditemukan, tanpa harus menunggu haul (satu tahun) atau
      mencapai nisab lainnya.
    </p>
    <ul>
      <li>
        <b>Rumus:</b>
        <br />
        <em>Zakat Rikaz = Jumlah Harta Temuan × 20%</em>
      </li>
    </ul>
    <p class="description">
      Zakat rikaz berbeda dengan zakat lainnya karena tidak membutuhkan syarat
      haul. Setiap harta yang ditemukan dan memenuhi kriteria sebagai harta
      rikaz langsung dikenakan zakat sebesar 20%.
    </p>
  </div>
</template>

<script>
export default {
  props: ["data"],
  data() {
    return {
      localData: {
        JumlahHarta: this.data.JumlahHarta || 0,
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
