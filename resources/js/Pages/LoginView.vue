<template>
  <MainLayout>
    <Login />
  </MainLayout>
</template>

<script>
import MainLayout from '../Layouts/MainLayout.vue';
import Login from '../Pages/UserAuthentication/Login.vue'; 

export default {
  components: {
    MainLayout,
    Login
  }
};
</script>
