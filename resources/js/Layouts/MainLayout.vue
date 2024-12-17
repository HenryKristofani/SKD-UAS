<template>
    <HeaderView />
    <main>
      <slot></slot>
    </main>
    <FooterView />
  </template>
  
  <script setup>
  import HeaderView from './HeaderView.vue';
  import FooterView from './FooterView.vue';
  </script>
  
