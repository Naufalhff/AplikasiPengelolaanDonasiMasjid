<template>
  <div class="mb-3">
    <div class="mb-3">
      <label for="zakatType" class="form-label d-block">
        Pilih Jenis Peternakan
      </label>
      <select
        v-model="localData.jenisHewan"
        class="form-select border rounded-3 p-2 w-100"
        id="zakatType"
        @change="emitDataChange"
      >
        <option value="" selected disabled>Pilih Jenis Peternakan</option>
        <option value="sapi">Sapi</option>
        <option value="domba">Domba</option>
        <option value="kerbau">Kerbau</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Jumlah hewan yang dimiliki</label>
      <div class="input-group">
        <input
          type="number"
          class="form-control"
          placeholder="0"
          v-model="localData.jumlahHewan"
          min="0"
          @input="emitDataChange"
        />
        <span class="input-group-text">Ekor</span>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Harga hewan yang dipilih per-ekor</label>
      <div class="input-group">
        <span class="input-group-text">Rp</span>
        <input
          type="number"
          class="form-control"
          placeholder="Isi harga jual di daerahmu saat membayar zakat"
          v-model="localData.hargaHewan"
          min="0"
          @input="emitDataChange"
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
        jenisHewan: this.data.jenisHewan || "domba",
        jumlahHewan: this.data.jumlahHewan || 0,
        hargaHewan: this.data.hargaHewan || 0,
      },
    };
  },
  methods: {
    emitDataChange() {
      this.$emit("update:data", this.localData);
    },
  },
};
</script>
