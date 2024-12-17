<template>
    <section class="flex items-center justify-between w-full rounded-2xl bg-gray-200 p-10 min-h-[280px] max-md:flex-col max-md:p-5">
      <!-- Teks dan Tombol -->
      <div class="flex flex-col justify-center w-1/2 max-md:w-full max-md:text-center">
        <h2 class="text-3xl font-semibold text-gray-900 leading-snug max-md:text-2xl max-md:max-w-full">
          Unduh aplikasi mobile untuk mendapatkan diskon sebesar 10% dan kode perjalanan
        </h2>
        <a href="#"
          class="inline-block mt-6 px-5 py-3 text-base font-medium text-white bg-blue-600 rounded-md">
          Download mobile app
        </a>
      </div>
  
      <!-- Gambar -->
      <div class="w-1/2 flex justify-center max-md:w-full max-md:mt-6">
        <img loading="lazy"
          src="https://cdn.builder.io/api/v1/image/assets%2Fa6a4bb1a991e4a4fa4c25aa0ed6e28da%2Fd3b12f21e4c1461faac43031a88adf08"
          alt="Download App Preview" class="object-cover w-3/4 rounded-lg">
      </div>
    </section>
  </template>
  
  <script>
  export default {
    name: 'DownloadAppBanner'
  }
  </script>
  
  <style scoped>
  /* Menambahkan gaya untuk memaksimalkan lebar tampilan mobile */
  @media (max-width: 768px) {
    .max-md\:flex-col {
      flex-direction: column;
    }
    .max-md\:w-full {
      width: 100%;
    }
    .max-md\:text-center {
      text-align: center;
    }
    .max-md\:p-5 {
      padding: 20px;
    }
    .max-md\:mt-6 {
      margin-top: 24px;
    }
  }
  </style>
  