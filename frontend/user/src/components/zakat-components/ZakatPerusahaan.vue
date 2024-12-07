<template>
  <div class="mb-3">
    <!-- Keuntungan Bersih -->
    <div class="mb-3">
      <label class="form-label">Keuntungan Bersih</label>
      <div class="input-group">
        <span class="input-group-text">Rp.</span>
        <input
          type="text"
          class="form-control"
          placeholder="0"
          :value="formattedKeuntunganBersih"
          @input="formatCustomAmount('keuntunganBersih', $event)"
        />
      </div>
    </div>

    <!-- Utang Lancar -->
    <div class="mb-3">
      <label class="form-label">Utang Lancar (Optional)</label>
      <div class="input-group">
        <span class="input-group-text">Rp.</span>
        <input
          type="text"
          class="form-control"
          placeholder="0"
          :value="formattedUtangLancar"
          @input="formatCustomAmount('UtangLancar', $event)"
        />
      </div>
    </div>

    <!-- Tahun Operasional -->
    <div class="mb-3">
      <label class="form-label">Tahun Operasional</label>
      <div class="input-group">
        <input
          type="number"
          class="form-control"
          placeholder="0"
          min="0"
          v-model="localData.TahunOperasional"
        />
        <span class="input-group-text">Tahun</span>
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
      Zakat perusahaan adalah kewajiban zakat yang dikenakan kepada sebuah
      entitas bisnis atau perusahaan yang memiliki keuntungan bersih selama satu
      tahun operasional. Zakat ini wajib dikeluarkan jika aset bersih perusahaan
      telah mencapai <b>nisab</b>, yaitu setara <b>85 gram emas</b>, setelah
      dikurangi utang lancar. Perhitungan zakat perusahaan dilakukan dengan
      rumus:
      <br />
      <b> Aset Bersih = Keuntungan Bersih - Utang Lancar </b>
      <br />
      Jika aset bersih perusahaan mencapai atau melebihi nisab, maka zakat
      dihitung sebesar:
      <br />
      <b>Zakat = Aset Bersih × 2.5%</b>.
    </p>
  </div>
</template>

<script>
export default {
  props: ["data"],
  data() {
    return {
      localData: {
        keuntunganBersih: this.data.keuntunganBersih || 0,
        UtangLancar: this.data.UtangLancar || 0,
        TahunOperasional: this.data.TahunOperasional || 0,
        HargaEmas: this.data.HargaEmas || 0,
      },
    };
  },
  computed: {
    formattedKeuntunganBersih() {
      return new Intl.NumberFormat("id-ID").format(
        this.localData.keuntunganBersih
      );
    },
    formattedUtangLancar() {
      return new Intl.NumberFormat("id-ID").format(this.localData.UtangLancar);
    },
    formattedHargaEmas() {
      return new Intl.NumberFormat("id-ID").format(this.localData.HargaEmas);
    },
  },
  methods: {
    formatCustomAmount(key, event) {
      const rawValue = event.target.value.replace(/\D/g, "");
      event.target.value = new Intl.NumberFormat("id-ID").format(rawValue);
      this.localData[key] = parseInt(rawValue, 10) || 0;
    },
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
