<template>
  <div class="mb-3">
    <div class="mb-3">
      <label class="form-label">Modal yang Diputar selama 1 tahun</label>
      <div class="input-group">
        <span class="input-group-text">Rp.</span>
        <input
          type="number"
          class="form-control"
          placeholder="0"
          min="0"
          v-model="localData.modal"
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
          v-model="localData.keuntungan"
        />
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Piutang Dagang (Optional)</label>
      <div class="input-group">
        <span class="input-group-text">Rp.</span>
        <input
          type="number"
          class="form-control"
          placeholder="0"
          min="0"
          v-model="localData.piutangDagang"
        />
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Utang jatuh tempo (Optional)</label>
      <div class="input-group">
        <span class="input-group-text">Rp.</span>
        <input
          type="number"
          class="form-control"
          placeholder="0"
          min="0"
          v-model="localData.utangJatuhTempo"
        />
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Kerugian selama 1 tahun (Optional)</label>
      <div class="input-group">
        <span class="input-group-text">Rp.</span>
        <input
          type="number"
          class="form-control"
          placeholder="0"
          min="0"
          v-model="localData.kerugian"
        />
      </div>
    </div>
    <p class="description">
      Zakat perdagangan dikenakan atas aset usaha yang telah mencapai nisab,
      yaitu setara <b>85 gram emas</b>, dan telah berjalan selama satu tahun
      (haul). Tarif zakat yang dikenakan adalah sebesar <b>2.5%</b> dari total
      aset bersih usaha. Perhitungan aset bersih usaha dilakukan dengan rumus:
      <br />
      <b>
        Aset Bersih = Modal + Keuntungan + Piutang Dagang - (Kerugian + Utang
        Jatuh Tempo)
      </b>
      <br />
      Jika aset bersih mencapai atau melebihi nisab, maka zakat wajib
      dikeluarkan dengan rumus:
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
        modal: this.data.modal || 0,
        keuntungan: this.data.keuntungan || 0,
        piutangDagang: this.data.piutangDagang || 0,
        utangJatuhTempo: this.data.utangJatuhTempo || 0,
        kerugian: this.data.kerugian || 0,
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
