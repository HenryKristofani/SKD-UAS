<template>
  <div class="flex flex-col items-center bg-gray-900 text-gray-200 pt-10">
    <header class="mt-8">
      <h1 class="text-3xl font-semibold leading-snug text-center text-white max-md:max-w-full">
        Jelajahi Mongkrang Bersama Mendasky!
      </h1>
      <p class="mt-4 text-base tracking-wide leading-snug text-center text-white">
        Langkah yang baik untuk pengalaman terbaik Anda!
      </p>
    </header>

    <main class="flex flex-wrap gap-10 justify-between items-start mt-16 w-full max-w-[1220px] max-md:mt-10 max-md:max-w-full">
      <section class="flex flex-col items-start text-lg font-medium text-gray-200">
        <div class="flex items-center gap-1">
          <img loading="lazy" src="images/icon.png" alt="Mendasky logo" class="object-contain w-[41px]" />
          <h2 class="font-bold">MENDASKY</h2>
        </div>
        <p class="text-xs text-gray-400 mt-2">
          Temukan Tempat yang Sempurna untuk Liburan Anda di Mongkrang
        </p>
      </section>

      <nav class="flex flex-col">
        <h3 class="text-base font-medium text-white mb-5">Company</h3>
        <ul class="space-y-3">
          <li><a href="#about" class="hover:text-gray-200">About</a></li>
          <li><a href="#jobs" class="hover:text-gray-200">Jobs</a></li>
          <li><a href="#newsroom" class="hover:text-gray-200">Newsroom</a></li>
          <li><a href="#advertising" class="hover:text-gray-200">Advertising</a></li>
          <li><a href="#contact-us" class="hover:text-gray-200">Contact us</a></li>
        </ul>
      </nav>

      <nav class="flex flex-col">
        <h3 class="text-base font-medium text-white mb-5">Explore</h3>
        <ul class="space-y-3">
          <li><a href="#merbabu" class="hover:text-gray-200">Merbabu</a></li>
          <li><a href="#sumbing" class="hover:text-gray-200">Sumbing</a></li>
          <li><a href="#merapi" class="hover:text-gray-200">Merapi</a></li>
          <li><a href="#slamet" class="hover:text-gray-200">Slamet</a></li>
          <li><a href="#sindoro" class="hover:text-gray-200">Sindoro</a></li>
          <li><a href="#muria" class="hover:text-gray-200">Muria</a></li>
        </ul>
      </nav>

      <!-- Adjusted Terms and Policies Section -->
      <nav class="flex flex-col" style="margin-left: 2rem;">
        <h3 class="text-base font-medium text-white mb-5">Terms and Policies</h3>
        <ul class="space-y-3">
          <li><a href="#privacy-policy" class="hover:text-gray-200">Privacy Policy</a></li>
          <li><a href="#terms-of-use" class="hover:text-gray-200">Terms of use</a></li>
          <li><a href="#accessibility" class="hover:text-gray-200">Accessibility</a></li>
          <li><a href="#reward-system-policy" class="hover:text-gray-200">Reward system policy</a></li>
        </ul>
      </nav>

      <nav class="flex flex-col">
        <h3 class="text-base font-medium text-white mb-5">Help</h3>
        <ul class="space-y-3">
          <li><a href="#support" class="hover:text-gray-200">Support</a></li>
          <li><a href="#cancel-bookings" class="hover:text-gray-200">Cancel your bookings</a></li>
          <li><a href="#use-coupon" class="hover:text-gray-200">Use Coupon</a></li>
          <li><a href="#refund-policies" class="hover:text-gray-200">Refund Policies</a></li>
          <li><a href="#travel-documents" class="hover:text-gray-200">International Travel Documents</a></li>
        </ul>
      </nav>
    </main>

    <footer class="flex flex-col items-center py-4 w-full bg-gray-800 text-gray-500 mt-8">
      <p>&copy; copyright MendaSKY 2024</p>
    </footer>
  </div>
</template>

<script>
export default {
  name: 'MongkrangExplorer',
};
</script>
