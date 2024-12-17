<template>
  <section class="flex flex-col text-base tracking-wide leading-snug text-blue-500 rounded-none">
    <section class="flex flex-col self-stretch px-20 w-full max-md:px-5 max-md:max-w-full">
      <div class="flex flex-wrap gap-5 items-start px-6 pt-7 pb-3.5 bg-orange-200 rounded-lg max-md:px-5">
        <img loading="lazy"
          src="https://cdn.builder.io/api/v1/image/assets/TEMP/658149e06e1fa0e2e61ecfee7534502504f909d75033b9b4716fde48108aeb13?placeholderIfAbsent=true&apiKey=a6a4bb1a991e4a4fa4c25aa0ed6e28da"
          class="object-contain shrink-0 w-8 aspect-square" alt="Health check icon" />
        <p class="flex-auto mt-1.5 w-[1135px] max-md:max-w-full">
          Cek kesehatan kondisi tubuh anda sebelum memulai pendakian.
          <a href="#" class="text-blue-500">Pelajari Selengkapnya</a>
        </p>
      </div>
    </section>
  </section>
</template>

<script>
  export default {
    name: 'HealthCheckBanner'
  }
</script>