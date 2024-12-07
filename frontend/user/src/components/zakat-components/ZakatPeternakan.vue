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
    <p class="description">
      Zakat peternakan adalah zakat yang wajib dikeluarkan oleh pemilik ternak
      atas hewan ternak mereka, seperti sapi, domba, atau kerbau, jika telah
      mencapai nisab. Nisab zakat peternakan adalah sebagai berikut:
      <b>30 ekor sapi</b>, <b>40 ekor domba</b>, atau <b>30 ekor kerbau</b>.
    </p>
    <p class="description">
      Besaran zakat peternakan bergantung pada jumlah ternak yang dimiliki dan
      jenis ternaknya:
    </p>
    <ul>
      <li><b>2,5%</b> dari jumlah ternak untuk sapi dan kerbau.</li>
      <li><b>2,5%</b> dari jumlah ternak untuk domba.</li>
    </ul>
    <p class="description">
      Zakat ini wajib dikeluarkan setiap tahun apabila jumlah ternak mencapai
      nisab dan haul (satu tahun), karena berkaitan dengan kepemilikan ternak
      yang telah mencapai batas minimum.
    </p>
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
