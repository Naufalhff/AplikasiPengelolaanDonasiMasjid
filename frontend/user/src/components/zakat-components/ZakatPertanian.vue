<template>
  <div class="mb-3">
    <!-- Pilih Jenis Pertanian -->
    <div class="mb-3">
      <label for="zakatType" class="form-label d-block"
        >Pilih Jenis Pertanian</label
      >
      <select
        v-model="localData.selectedPertanian"
        class="form-select border rounded-3 p-2 w-100"
        id="zakatType"
      >
        <option value="" selected disabled>Pilih Jenis Pertanian</option>
        <option value="gabah">Gabah</option>
        <option value="beras">Beras</option>
      </select>
    </div>

    <!-- Hasil Panen -->
    <div class="mb-3">
      <label class="form-label">Hasil Panen</label>
      <div class="input-group">
        <input
          type="number"
          class="form-control"
          placeholder="Input hasil panen dalam satuan kg"
          v-model="localData.hasilPanen"
          min="0"
        />
        <span class="input-group-text">kg</span>
      </div>
    </div>

    <!-- Harga jual komoditas -->
    <div class="mb-3">
      <label class="form-label">Harga jual komoditas (per Kg)</label>
      <div class="input-group">
        <span class="input-group-text">Rp</span>
        <input
          type="text"
          class="form-control"
          placeholder="Isi harga jual di daerahmu saat membayar zakat"
          :value="formattedHargaJual"
          @input="formatCustomAmount('hargaJual', $event)"
        />
      </div>
    </div>

    <!-- Pilih Jenis Pengairan -->
    <div class="mb-3">
      <label class="form-label">Pilih Jenis Pengairan</label>
      <div>
        <div class="form-check">
          <input
            type="radio"
            class="form-check-input"
            id="tadahHujan"
            value="tadahHujan"
            v-model="localData.jenisPengairan"
          />
          <label class="form-check-label" for="tadahHujan"
            >Perairan Tadah Hujan</label
          >
        </div>
        <div class="form-check">
          <input
            type="radio"
            class="form-check-input"
            id="berbayar"
            value="berbayar"
            v-model="localData.jenisPengairan"
          />
          <label class="form-check-label" for="berbayar"
            >Perairan Berbayar</label
          >
        </div>
      </div>
    </div>

    <!-- Deskripsi -->
    <p class="description">
      Zakat pertanian adalah zakat yang wajib dikeluarkan oleh petani atas hasil
      pertanian mereka, seperti gabah, beras, atau komoditas lainnya, jika telah
      mencapai nisab. Nisab zakat pertanian adalah setara dengan
      <b>653 kg gabah</b> atau <b>520 kg beras</b>.
    </p>
    <p class="description">
      Besaran zakat pertanian bergantung pada jenis pengairan yang digunakan:
    </p>
    <ul>
      <li>
        <b>10%</b> (1/10) dari hasil panen untuk pengairan alami, seperti tadah
        hujan.
      </li>
      <li>
        <b>5%</b> (1/20) dari hasil panen untuk pengairan berbayar, seperti
        irigasi yang memerlukan biaya.
      </li>
    </ul>
    <p class="description">
      Zakat ini wajib dikeluarkan setiap kali panen, tanpa menunggu haul (satu
      tahun), karena berkaitan langsung dengan masa panen.
    </p>
  </div>
</template>

<script>
export default {
  props: ["data"],
  data() {
    return {
      localData: {
        selectedPertanian: this.data.selectedPertanian || "",
        hasilPanen: this.data.hasilPanen || 0,
        hargaJual: this.data.hargaJual || 0,
        jenisPengairan: this.data.jenisPengairan || "tadahHujan",
      },
    };
  },
  computed: {
    formattedHargaJual() {
      return new Intl.NumberFormat("id-ID").format(this.localData.hargaJual);
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
