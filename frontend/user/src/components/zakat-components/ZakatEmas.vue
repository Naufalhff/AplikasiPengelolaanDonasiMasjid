<template>
  <div class="mb-3">
    <div class="mb-3">
      <label for="logamMuliaType" class="form-label d-block"
        >Pilih Jenis Logam Mulia</label
      >
      <select
        v-model="selectedLogamMulia"
        class="form-select border rounded-3 p-2 w-100"
        id="logamMuliaType"
        @change="updateSelectedLogamMulia"
      >
        <option value="" selected disabled>Pilih Jenis Logam Mulia</option>
        <option value="emas">Emas</option>
        <option value="perak">Perak</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Berat Emas/Perak yang dimiliki</label>
      <div class="input-group">
        <input
          type="number"
          class="form-control"
          placeholder="0"
          v-model="localData.BeratEmasPerak"
          min="0"
        />
        <span class="input-group-text">Gram</span>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Harga Emas/Perak saat ini</label>
      <div class="input-group">
        <span class="input-group-text">Rp</span>
        <input
          type="text"
          class="form-control"
          placeholder="Rp.0"
          :value="formattedAmount"
          @input="formatCustomAmount"
        />
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Nisab Emas/Perak</label>
      <div class="input-group">
        <input
          type="number"
          class="form-control"
          :value="nisabComputed"
          readonly
        />
        <span class="input-group-text">Gram</span>
      </div>
    </div>
    <p class="description">
      Zakat Emas dan Perak adalah zakat yang dikenakan atas logam mulia yang
      dimiliki seseorang. Nisab zakat untuk <b>emas</b> adalah
      <b>85 gram</b> dan untuk <b>perak</b> adalah <b>595 gram</b>. Tarif zakat
      yang wajib dikeluarkan adalah sebesar <b>2,5%</b> dari total nilai logam
      mulia yang dimiliki jika telah mencapai nisab dan melewati haul (1 tahun
      kepemilikan).
    </p>
    <p class="description">
      Rumus perhitungannya adalah sebagai berikut:
      <b
        >Zakat = Berat Emas/Perak (gram) × Harga Emas/Perak per gram (Rp) ×
        2,5%</b
      >. Jika berat logam mulia yang dimiliki kurang dari nisab, maka zakat
      tidak wajib dikeluarkan.
    </p>
  </div>
</template>

<script>
export default {
  props: ["data"],
  data() {
    return {
      selectedLogamMulia: this.data.selectedLogamMulia || "emas",
      localData: {
        BeratEmasPerak: this.data.BeratEmasPerak || 0,
        HargaEmasPerak: this.data.HargaEmasPerak || 0,
      },
    };
  },
  watch: {
    localData: {
      handler(newData) {
        this.$emit("update:data", {
          ...newData,
          selectedLogamMulia: this.selectedLogamMulia,
        });
      },
      deep: true,
    },
  },
  computed: {
    nisabComputed() {
      return this.selectedLogamMulia === "emas" ? 85 : 595;
    },
    formattedAmount() {
      return new Intl.NumberFormat("id-ID").format(
        this.localData.HargaEmasPerak
      );
    },
  },
  methods: {
    formatCustomAmount(event) {
      let value = event.target.value.replace(/[^0-9]/g, "");
      if (value) {
        event.target.value = new Intl.NumberFormat("id-ID").format(value);
        this.localData.HargaEmasPerak = parseInt(value, 10);
      } else {
        this.localData.HargaEmasPerak = 0;
      }
    },
    updateSelectedLogamMulia() {
      this.$emit("update:data", {
        ...this.localData,
        selectedLogamMulia: this.selectedLogamMulia,
      });
    },
  },
};
</script>
