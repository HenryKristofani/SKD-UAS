<template>
    <MainLogLayout>
      <BayarReservasi />
    </MainLogLayout>
</template>
  
  <script>
  import MainLogLayout from '@/Layouts/MainLogLayout.vue';
  import BayarReservasi from './Reservasi/bayarreservasi.vue';
  
  export default {
    components: {
        MainLogLayout,
        BayarReservasi
    }
  };
  </script>  