<template>
    <HeaderLogView />
    <main>
      <slot></slot>
    </main>
    <FooterView />
  </template>
  
  <script setup>
  import HeaderLogView from './HeaderLogView.vue';
  import FooterView from './FooterView.vue';
  </script>

  
  
