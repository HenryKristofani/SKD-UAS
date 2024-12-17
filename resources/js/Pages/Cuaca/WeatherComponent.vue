<template>
  <div class="container mx-auto p-8">
    <h1 class="text-2xl font-semibold mb-4">Cuaca Terkini dan 7 Hari ke Depan</h1>
    
    <div v-if="loading" class="text-center">Memuat cuaca...</div>
    
    <div v-else>
      <div v-if="error" class="text-red-600 mb-4">{{ error }}</div>
      
      <div class="bg-white p-4 rounded-md shadow-md mb-6">
        <h2 class="text-xl font-semibold">{{ weather.city }}</h2>
        <p class="text-gray-600">Cuaca: {{ weather.condition }}</p>
        <p class="text-gray-600">Suhu: {{ weather.temperature }}°C</p>
        <p class="text-gray-600">Kecepatan Angin: {{ weather.windSpeed }} km/h</p>
      </div>

      <div v-if="forecast && forecast.length > 0">
        <h3 class="text-lg font-semibold mb-2">Perkiraan Cuaca 7 Hari ke Depan:</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <div v-for="(day, index) in forecast" :key="index" class="bg-white p-4 rounded-md shadow-md">
            <h4 class="text-lg font-semibold">{{ day.date }}</h4>
            <p class="text-gray-600">Kondisi: {{ day.condition }}</p>
            <p class="text-gray-600">Suhu Min: {{ day.min_temp }}°C</p>
            <p class="text-gray-600">Suhu Max: {{ day.max_temp }}°C</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      weather: null,
      forecast: [],
      loading: true,
      error: null,
    };
  },
  mounted() {
    this.fetchWeather();
  },
  methods: {
    async fetchWeather() {
      const apiKey = '0e9d2e6a7b1b44f5a50110256241512'; // Ganti dengan API Key Anda dari WeatherAPI.com
      const city = 'Tawangmangu'; // Gantilah dengan nama kota yang diinginkan
      const url = `https://api.weatherapi.com/v1/forecast.json?key=${apiKey}&q=${city}&days=7`;

      try {
        const response = await fetch(url);
        const data = await response.json();

        this.weather = {
          city: data.location.name,
          condition: data.current.condition.text,
          temperature: data.current.temp_c,
          windSpeed: data.current.wind_kph,
        };

        this.forecast = data.forecast.forecastday.map(day => ({
          date: this.formatDate(day.date),
          condition: day.day.condition.text,
          min_temp: day.day.mintemp_c,
          max_temp: day.day.maxtemp_c,
        }));
      } catch (error) {
        this.error = 'Terjadi kesalahan saat mengambil data cuaca';
      } finally {
        this.loading = false;
      }
    },

    // Fungsi untuk memformat tanggal
    formatDate(date) {
      const options = { day: 'numeric', month: 'long', year: 'numeric' };
      return new Intl.DateTimeFormat('id-ID', options).format(new Date(date));
    },
  },
};
</script>

<style scoped>
/* Styling untuk cuaca */
h1 {
  font-size: 2rem;
  font-weight: 600;
}

h2 {
  font-size: 1.5rem;
}

h3 {
  font-size: 1.25rem;
}

.text-red-600 {
  color: #f87171;
}

.grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 1.5rem;
}

@media (min-width: 640px) {
  .grid {
    grid-template-columns: 1fr 1fr;
  }
}

@media (min-width: 1024px) {
  .grid {
    grid-template-columns: 1fr 1fr 1fr;
  }
}
</style>
