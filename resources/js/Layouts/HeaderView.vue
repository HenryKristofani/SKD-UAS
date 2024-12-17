<template>
    <header class="flex flex-wrap gap-5 justify-between items-center px-20 py-4 w-full bg-gray-900 text-white max-md:px-5 max-md:max-w-full">
      <div class="flex gap-1 items-center text-lg tracking-wide text-white">
        <img
          loading="lazy"
          src="images/icon.png"
          class="object-contain shrink-0 w-10 h-10"
          alt="Mendasky logo"
        />
        <h1 class="text-xl font-semibold">
          MENDA<span class="font-bold">SKY</span>
        </h1>
      </div>
      <nav class="flex flex-wrap gap-8 items-center text-base tracking-wide whitespace-nowrap">
        <a href="/" class="hover:underline text-gray-300 hover:text-white">Beranda</a>
        <a href="/reservasi" class="hover:underline text-gray-300 hover:text-white">Reservasi</a>
        <a href="/berita" class="hover:underline text-gray-300 hover:text-white">Berita</a>
        <a href="#" class="hover:underline text-gray-300 hover:text-white">Panduan</a>
        <a href="#" class="hover:underline text-gray-300 hover:text-white">Kontak</a>
      </nav>
      <div class="flex gap-3 text-base tracking-wide leading-none whitespace-nowrap">
        <!-- Register button with dark mode styling -->
        <button
          @click="goToRegister"
          class="px-4 py-2 text-cyan-400 bg-gray-900 border border-cyan-400 rounded-md hover:bg-cyan-400 hover:text-gray-900"
        >
          Register
        </button>
        <button
          @click="goToLogin"
          class="px-4 py-2 text-gray-900 bg-cyan-400 rounded-md hover:bg-cyan-300"
        >
          Login
        </button>
      </div>
    </header>
  </template>
  
  <script>
  export default {
    name: 'Header',
    methods: {
      goToLogin() {
        window.location.href = '/login';
      },
      goToRegister() {
        window.location.href = '/register';
      },
    },
  };
  </script>
  