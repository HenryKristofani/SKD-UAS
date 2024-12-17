<template>
  <section class="flex flex-col items-start rounded-2xl">
    <section class="flex flex-col self-stretch px-20 w-full max-md:px-5 max-md:max-w-full">
      <h1 class="z-10 mt-0 text-3xl font-semibold text-neutral-900">
        Trail Map Mongkrang
      </h1>
      <p class="mt-5 text-base tracking-wide leading-snug text-zinc-800 max-md:max-w-full">
        Kami akan membantu akomodasi Anda dari BaseCamp hingga ke Puncak!
      </p>
      <div class="self-stretch mt-8 w-full max-md:max-w-full">
        <div class="flex gap-5 max-md:flex-col">
          <!-- Local Image for Map -->
          <div class="flex flex-col w-6/12 max-md:ml-0 max-md:w-full">
            <img loading="lazy"
              src="/images/map.jpg"
              alt="Trail Map Mongkrang"
              class="object-contain w-full rounded-2xl aspect-[1.07] max-md:mt-10 max-md:max-w-full" />
          </div>
          
          <!-- Articles -->
          <div class="flex flex-col w-6/12 max-md:w-full">
            <div class="flex flex-col gap-5">
              <!-- Article for Weather Condition -->
              <article
                class="relative flex flex-col justify-between p-8 w-full h-[250px] rounded-2xl bg-cover bg-center shadow-lg"
                style="background-image: url('https://cdn.builder.io/api/v1/image/assets/TEMP/3ca3cd4e42ce0910e78bbb82932d987bf2c19401eb162af69d6c449bfedbee3e?placeholderIfAbsent=true&apiKey=a6a4bb1a991e4a4fa4c25aa0ed6e28da');">
                <h2 class="text-2xl font-semibold text-white">
                  Kondisi Terkini Cuaca
                </h2>
                <button
                  @click="goToCuaca" class="self-end px-5 py-2 mt-4 text-base font-medium text-stone-900 bg-stone-50 rounded-xl">
                  Detail
                </button>
              </article>

              <!-- Article for Checking Hiking Quota -->
              <article
                class="relative flex flex-col justify-between p-8 w-full h-[250px] rounded-2xl bg-cover bg-center shadow-lg"
                style="background-image: url('https://cdn.builder.io/api/v1/image/assets/TEMP/3cf7e7e130869d5e206f2aa569274e61d08730f816e04acef1c16fead482395e?placeholderIfAbsent=true&apiKey=a6a4bb1a991e4a4fa4c25aa0ed6e28da');">
                <h2 class="text-2xl font-semibold text-white">
                  Cek Kuota Pendakian
                </h2>
                <button
                @click="goToKuota" class="self-end px-5 py-2 mt-4 text-base font-medium text-stone-900 bg-stone-50 rounded-xl">
                  Detail
                </button>
              </article>
            </div>
          </div>
        </div>
      </div>
    </section>
  </section>
</template>

<script>
export default {
  name: 'Detail',
    methods: {
      goToCuaca() {
        window.location.href = '/cuaca';
      },

      goToKuota() {
        window.location.href = '/kuota';
      }
    },
  };
</script>