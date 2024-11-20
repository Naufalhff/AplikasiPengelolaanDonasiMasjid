<template>
  <div class="mb-3">
    <div class="mb-3">
      <label class="form-label">Keuntungan Bersih</label>
      <div class="input-group">
        <span class="input-group-text">Rp.</span>
        <input
          type="number"
          class="form-control"
          placeholder="0"
          min="0"
          v-model="localData.keuntunganBersih"
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
          v-model="localData.UtangLancar"
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
          v-model="localData.TahunOperasional"
        />
        <span class="input-group-text">Tahun</span>
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
        keuntunganBersih: this.data.keuntunganBersih || 0,
        UtangLancar: this.data.UtangLancar || 0,
        TahunOperasional: this.data.TahunOperasional || 0,
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
