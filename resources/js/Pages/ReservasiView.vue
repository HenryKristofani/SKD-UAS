<template>
    <MainLogLayout>
        <FormReservasi />
    </MainLogLayout>
  </template>
  
  <script>
  import MainLogLayout from '../Layouts/MainLogLayout.vue';
  import FormReservasi from './Reservasi/formreservasi.vue';
  
  export default {
    components: {
        MainLogLayout,
        FormReservasi
    }
  };
  </script>  