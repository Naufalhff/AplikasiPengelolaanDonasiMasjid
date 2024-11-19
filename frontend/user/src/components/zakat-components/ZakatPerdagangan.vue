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
      <label class="form-label">Piutang Dagang</label>
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
      <label class="form-label">Utang jatuh tempo</label>
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
      <label class="form-label">Kerugian selama 1 tahun</label>
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
