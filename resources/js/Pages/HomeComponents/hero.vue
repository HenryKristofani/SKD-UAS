<template>
  <section class="flex flex-col text-white rounded-none">
      <div class="relative flex flex-col items-center px-20 pt-48 pb-24 w-full rounded-xl min-h-[500px] max-md:px-5 max-md:py-24 max-md:max-w-full">
          <!-- Background Image -->
          <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/51cbec863ba28f0504d9058ca2d4452a4659a7a8961d09034f38e3625f39fcfe?placeholderIfAbsent=true&apiKey=a6a4bb1a991e4a4fa4c25aa0ed6e28da" alt="Background image" class="object-cover absolute inset-0 w-full h-full" />
          
          <!-- Content Container -->
          <div class="relative flex flex-col items-center max-w-[800px] w-full max-md:p-5">
              <h1 class="text-3xl font-bold text-center max-md:text-2xl">
                  Langkah yang baik untuk pengalaman terbaik Anda!
              </h1>
              <p class="mt-3.5 text-base text-center max-md:text-sm">
                  Temukan Tempat yang Sempurna untuk Liburan Anda di Mongkrang
              </p>
              <button @click="goToReservasi" class="mt-10 px-8 py-4 bg-cyan-700 text-base font-medium tracking-wide rounded-md min-h-[50px] max-w-[200px] text-center hover:bg-cyan-800">
                  Daftar Sekarang
              </button>
          </div>
      </div>
  </section>
</template>

<script>
export default {
  name: 'HeroSection',
  methods: {
      goToReservasi() {
        window.location.href = '/reservasi';
      }
    },
}
</script>

<style scoped>
/* Tambahkan style tambahan di sini jika diperlukan */
</style>
