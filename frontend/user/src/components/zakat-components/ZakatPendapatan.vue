<template>
  <div class="mb-3">
    <div class="mb-3">
      <label class="form-label">Penghasilan Per Bulan</label>
      <div class="input-group">
        <span class="input-group-text">Rp.</span>
        <input
          type="number"
          class="form-control"
          placeholder="0"
          min="0"
          v-model="localData.PenghasilanPerBulan"
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
          v-model="localData.PenghasilanLain"
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
          v-model="localData.HutangCicilan"
        />
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
        PenghasilanPerBulan: this.data.PenghasilanPerBulan || 0,
        PenghasilanLain: this.data.PenghasilanLain || 0,
        HutangCicilan: this.data.HutangCicilan || 0,
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
