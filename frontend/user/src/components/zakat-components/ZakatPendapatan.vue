<template>
  <div class="mb-3">
    <div class="mb-3">
      <label class="form-label">Penghasilan Per Bulan</label>
      <div class="input-group">
        <span class="input-group-text">Rp</span>
        <input
          type="text"
          class="form-control"
          placeholder="0"
          :value="formattedPenghasilanPerBulan"
          @input="formatCustomAmount('PenghasilanPerBulan', $event)"
        />
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Penghasilan Lain (Optional)</label>
      <div class="input-group">
        <span class="input-group-text">Rp</span>
        <input
          type="text"
          class="form-control"
          placeholder="0"
          :value="formattedPenghasilanLain"
          @input="formatCustomAmount('PenghasilanLain', $event)"
        />
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Hutang/Cicilan (Optional)</label>
      <div class="input-group">
        <span class="input-group-text">Rp</span>
        <input
          type="text"
          class="form-control"
          placeholder="0"
          :value="formattedHutangCicilan"
          @input="formatCustomAmount('HutangCicilan', $event)"
        />
      </div>
    </div>
    <div class="mb-3">
      <label class="form-label">Harga emas per gram saat ini</label>
      <div class="input-group">
        <span class="input-group-text">Rp</span>
        <input
          type="text"
          class="form-control"
          placeholder="0"
          :value="formattedHargaEmas"
          @input="formatCustomAmount('HargaEmas', $event)"
        />
      </div>
    </div>
    <p class="description">
      Zakat penghasilan adalah zakat yang wajib dikeluarkan dari penghasilan
      atau pendapatan seseorang jika telah mencapai nisab. Nisab zakat
      penghasilan setara dengan <b>85 gram</b> emas.
    </p>
    <p class="description">
      Besaran zakat penghasilan dihitung berdasarkan total pendapatan bersih
      setelah dikurangi hutang atau cicilan. Rumus perhitungan zakat penghasilan
      adalah sebagai berikut:
    </p>
    <ul>
      <li>
        <b>Rumus:</b>
        <br />
        <em
          >Zakat = (Penghasilan Per Bulan + Penghasilan Lain - Hutang/Cicilan) ×
          2,5%</em
        >
      </li>
      <li>
        <b>2,5%</b> dari total penghasilan bersih yang diperoleh setiap bulan.
      </li>
    </ul>
    <p class="description">
      Zakat ini wajib dikeluarkan setiap bulan jika total penghasilan mencapai
      nisab. Hal ini didasarkan pada prinsip bahwa penghasilan merupakan harta
      yang diperoleh secara terus-menerus.
    </p>
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
        HargaEmas: this.data.HargaEmas || 0,
      },
    };
  },
  computed: {
    formattedPenghasilanPerBulan() {
      return new Intl.NumberFormat("id-ID").format(
        this.localData.PenghasilanPerBulan
      );
    },
    formattedPenghasilanLain() {
      return new Intl.NumberFormat("id-ID").format(
        this.localData.PenghasilanLain
      );
    },
    formattedHutangCicilan() {
      return new Intl.NumberFormat("id-ID").format(
        this.localData.HutangCicilan
      );
    },
    formattedHargaEmas() {
      return new Intl.NumberFormat("id-ID").format(this.localData.HargaEmas);
    },
  },
  methods: {
    formatCustomAmount(key, event) {
      const rawValue = event.target.value.replace(/[^0-9]/g, "");
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
