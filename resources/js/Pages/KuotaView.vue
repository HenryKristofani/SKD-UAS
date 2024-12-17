<template>
  <section class="container mx-auto p-8">
    <h1 class="text-4xl font-extrabold text-center text-green-800 mb-10 tracking-widest">
      Jumlah Pendaki per Tanggal
    </h1>

    <!-- Dropdown untuk memilih bulan dan tahun -->
    <div class="flex justify-center items-center gap-4 mb-8">
      <select
        v-model="selectedMonth"
        @change="fetchKuotaForMonth"
        class="p-2 rounded-lg border border-green-300 shadow-md text-green-800 focus:outline-none"
      >
        <option v-for="(month, index) in months" :key="index" :value="index">
          {{ month }}
        </option>
      </select>
      <select
        v-model="selectedYear"
        @change="fetchKuotaForMonth"
        class="p-2 rounded-lg border border-green-300 shadow-md text-green-800 focus:outline-none"
      >
        <option v-for="year in availableYears" :key="year" :value="year">
          {{ year }}
        </option>
      </select>
    </div>

    <!-- Card Tabel -->
    <div class="relative bg-green-100 p-6 rounded-3xl shadow-2xl overflow-hidden">
      <div class="absolute inset-0 opacity-20 bg-[url('https://source.unsplash.com/800x600/?forest,trees')] bg-cover">
      </div>
      <div class="relative z-10 bg-white/80 backdrop-blur-sm p-8 rounded-lg shadow-inner border border-green-300">
        <table class="w-full table-auto border-collapse rounded-lg overflow-hidden">
          <thead>
            <tr class="bg-gradient-to-r from-green-600 to-green-400 text-white">
              <th class="px-6 py-4 text-left font-bold text-lg uppercase tracking-wide">Tanggal</th>
              <th class="px-6 py-4 text-left font-bold text-lg uppercase tracking-wide">Jumlah Pendaki</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(day, index) in daysInMonth" :key="index"
              class="hover:bg-green-200 transition duration-300 ease-in-out">
              <td class="px-6 py-4 border-b border-green-300 font-medium text-green-800">{{ formatDate(day.date) }}</td>
              <td class="px-6 py-4 border-b border-green-300 font-semibold" :class="{
                'text-green-700': day.kuota > 50,
                'text-yellow-600': day.kuota <= 50 && day.kuota > 20,
                'text-red-600': day.kuota <= 20,
                'italic': day.kuota === null || day.kuota === 'Loading...'
              }">
                {{ day.kuota !== null ? day.kuota : 'Loading...' }}
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'KuotaView',
  data() {
    return {
      daysInMonth: [], // Array untuk menyimpan data tanggal dan kuota
      months: [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
      ],
      availableYears: [2023, 2024, 2025], // Tahun yang tersedia untuk dipilih
      selectedMonth: new Date().getMonth(), // Bulan yang dipilih (0-indexed)
      selectedYear: new Date().getFullYear(), // Tahun yang dipilih
    };
  },
  mounted() {
    this.fetchKuotaForMonth(); // Ambil data kuota saat komponen dimuat
  },

  methods: {
    // Fungsi untuk mengambil data kuota selama satu bulan
    async fetchKuotaForMonth() {
      const firstDay = new Date(this.selectedYear, this.selectedMonth, 2); // Tanggal pertama bulan
      const lastDay = new Date(this.selectedYear, this.selectedMonth + 1, ); // Tanggal terakhir bulan

      // Membuat array tanggal dalam satu bulan
      let days = [];
      for (let day = firstDay; day <= lastDay; day.setDate(day.getDate() + 1)) {
        const formattedDate = day.toISOString().split('T')[0]; // Format tanggal YYYY-MM-DD
        days.push({ date: formattedDate, kuota: null });
      }
      this.daysInMonth = days; // Menyimpan tanggal dalam array

      // Ambil kuota untuk setiap tanggal
      for (let i = 0; i < this.daysInMonth.length; i++) {
        const day = this.daysInMonth[i];
        await this.fetchKuota(day.date, i); // Ambil kuota untuk setiap tanggal
      }
    },

    // Fungsi untuk memformat tanggal ke "DD Month YYYY"
    formatDate(date) {
      const options = { day: 'numeric', month: 'long', year: 'numeric' };
      return new Intl.DateTimeFormat('id-ID', options).format(new Date(date));
    },

    // Fungsi untuk mengambil kuota berdasarkan tanggal
    async fetchKuota(date, index) {
      try {
        const response = await fetch(`/api/kuota/${date}`);
        const data = await response.json();
        this.daysInMonth[index].kuota = data.kuota;
      } catch (error) {
        console.error("Terjadi kesalahan:", error);
        this.daysInMonth[index].kuota = 'Error';
      }
    },
  },
};
</script>

<style scoped>
.container {
  max-width: 1000px;
}

table {
  border-spacing: 0;
  overflow: hidden;
}

th:first-child,
td:first-child {
  border-top-left-radius: 8px;
  border-bottom-left-radius: 8px;
}

th:last-child,
td:last-child {
  border-top-right-radius: 8px;
  border-bottom-right-radius: 8px;
}

body {
  font-family: 'Poppins', sans-serif;
}
</style>
