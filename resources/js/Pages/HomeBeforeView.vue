<template>
  <MainLayout>
      <!-- Hero Section -->
      <HeroSection />

      <!-- Alert Section -->
      <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 my-6 rounded-lg">
          <p class="font-semibold">Cek ketersediaan kondisi terbaru untuk melakukan pendakian. <a href="#" class="underline">Pelajari Selengkapnya</a></p>
      </div>
      
      <!-- Content Sections (Trail Map, Kondisi Cuaca, Berita, dll.) -->
      <div class="mt-8">
          <Detail />
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">
          <Peringatan title="Kondisi Terkini Cuaca" />
          <Peringatan title="Cek Kuota Pendakian" />
      </div>
        <Berita />
      <div class="mt-10 mb-10">
        <InstallApp />
      </div>
  </MainLayout>
</template>

<script>
import MainLayout from '../Layouts/MainLayout.vue';
import HeroSection from './HomeComponents/hero.vue';
import Detail from './HomeComponents/detail.vue';
import Berita from '../Pages/BeritaView.vue';
import InstallApp from './HomeComponents/installapp.vue'

export default {
  components: {
      MainLayout,
      HeroSection,
      Detail,
      Berita,
      InstallApp
  }
};
</script>
