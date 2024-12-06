<template>
  <div class="mb-3">
    <!-- Modal yang Diputar selama 1 tahun -->
    <div class="mb-3">
      <label class="form-label">Modal yang Diputar selama 1 tahun</label>
      <div class="input-group">
        <span class="input-group-text">Rp</span>
        <input
          type="text"
          class="form-control"
          placeholder="0"
          :value="formattedModal"
          @input="formatCustomAmount('modal', $event)"
        />
      </div>
    </div>

    <!-- Keuntungan selama 1 tahun -->
    <div class="mb-3">
      <label class="form-label">Keuntungan selama 1 tahun</label>
      <div class="input-group">
        <span class="input-group-text">Rp</span>
        <input
          type="text"
          class="form-control"
          placeholder="0"
          :value="formattedKeuntungan"
          @input="formatCustomAmount('keuntungan', $event)"
        />
      </div>
    </div>

    <!-- Piutang Dagang (Optional) -->
    <div class="mb-3">
      <label class="form-label">Piutang Dagang (Optional)</label>
      <div class="input-group">
        <span class="input-group-text">Rp</span>
        <input
          type="text"
          class="form-control"
          placeholder="0"
          :value="formattedPiutangDagang"
          @input="formatCustomAmount('piutangDagang', $event)"
        />
      </div>
    </div>

    <!-- Utang Jatuh Tempo (Optional) -->
    <div class="mb-3">
      <label class="form-label">Utang jatuh tempo (Optional)</label>
      <div class="input-group">
        <span class="input-group-text">Rp</span>
        <input
          type="text"
          class="form-control"
          placeholder="0"
          :value="formattedUtangJatuhTempo"
          @input="formatCustomAmount('utangJatuhTempo', $event)"
        />
      </div>
    </div>

    <!-- Kerugian selama 1 tahun (Optional) -->
    <div class="mb-3">
      <label class="form-label">Kerugian selama 1 tahun (Optional)</label>
      <div class="input-group">
        <span class="input-group-text">Rp</span>
        <input
          type="text"
          class="form-control"
          placeholder="0"
          :value="formattedKerugian"
          @input="formatCustomAmount('kerugian', $event)"
        />
      </div>
    </div>

    <!-- Harga emas per gram saat ini -->
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
        HargaEmas: this.data.HargaEmas || 0,
      },
    };
  },
  computed: {
    formattedModal() {
      return new Intl.NumberFormat("id-ID").format(this.localData.modal);
    },
    formattedKeuntungan() {
      return new Intl.NumberFormat("id-ID").format(this.localData.keuntungan);
    },
    formattedPiutangDagang() {
      return new Intl.NumberFormat("id-ID").format(
        this.localData.piutangDagang
      );
    },
    formattedUtangJatuhTempo() {
      return new Intl.NumberFormat("id-ID").format(
        this.localData.utangJatuhTempo
      );
    },
    formattedKerugian() {
      return new Intl.NumberFormat("id-ID").format(this.localData.kerugian);
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
