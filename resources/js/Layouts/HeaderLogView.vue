<template>
  <header class="flex justify-between items-center px-20 py-4 w-full bg-gray-900 text-white max-md:px-5 max-md:max-w-full">
    <div class="flex gap-1 items-center text-lg tracking-wide text-white flex-shrink-0">
      <img loading="lazy" src="images/icon.png" class="object-contain w-10 h-10" alt="Mendasky logo" />
      <h1 class="text-xl font-semibold">
        MENDA<span class="font-bold">SKY</span>
      </h1>
    </div>
    
    <!-- Navbar Links -->
    <nav class="flex gap-8 items-center text-base tracking-wide whitespace-nowrap text-gray-300 justify-center flex-grow">
      <a href="/home" class="hover:underline hover:text-white">Beranda</a>
      
      <!-- Dropdown attached to Reservasi link -->
      <div 
        class="relative group"
        @mouseenter="showDropdown"
        @mouseleave="hideDropdown"
      >
        <a href="#" @click.prevent="toggleDropdown" class="hover:underline hover:text-white relative inline-block">Reservasi</a>
        <div
          v-if="dropdownOpen"
          class="absolute left-0 top-full bg-gray-800 shadow-lg rounded-md w-40 border border-gray-700 z-10"
        >
          <a href="/reservasi" class="block px-4 py-2 hover:bg-gray-700 text-gray-300 hover:text-white">Buat Reservasi</a>
          <a href="/reservasilist" class="block px-4 py-2 hover:bg-gray-700 text-gray-300 hover:text-white">Riwayat Reservasi</a>
        </div>
      </div>

      <a href="/berita" class="hover:underline hover:text-white">Berita</a>
      <a href="#" class="hover:underline hover:text-white">Panduan</a>
      <a href="#" class="hover:underline hover:text-white">Kontak</a>
    </nav>

    <!-- Profile and Logout section -->
    <div class="flex gap-3 items-center relative">
      <!-- Profile Dropdown -->
      <div class="relative">
        <button @click="toggleProfileDropdown" class="flex items-center gap-1.5 px-3 py-2 text-white bg-gray-800 rounded-md hover:bg-gray-700 text-sm">
          <!-- Profile Icon -->
          <i class="fas fa-user text-sm"></i>
        </button>
        <div v-if="profileDropdownOpen" class="absolute left-1/2 transform -translate-x-1/2 top-full bg-gray-800 shadow-lg rounded-md w-60 border border-gray-700 z-10 mt-2">
          <div class="px-6 py-3 text-gray-300">Nama: {{ user.name }}</div>
          <div class="px-6 py-3 text-gray-300">Email: {{ user.email }}</div>
        </div>
      </div>

      <!-- Logout Button -->
      <button @click="logout" class="gap-1.5 px-4 py-2 text-white bg-red-700 rounded-md min-h-[40px] hover:bg-red-600 text-sm">
        Logout
      </button>
    </div>
  </header>
</template>

<script>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { Inertia } from '@inertiajs/inertia';

export default {
  setup() {
    const router = useRouter();
    const dropdownOpen = ref(false);
    const profileDropdownOpen = ref(false);
    const user = ref({ name: '', email: '' });

    // Fetch user data
    const fetchUserData = async () => {
      try {
        const response = await fetch('/api/user'); // Adjust this URL to your API
        if (!response.ok) throw new Error('Failed to fetch user data');
        const data = await response.json();
        user.value = data;
      } catch (error) {
        console.error(error);
        alert("Failed to load user profile.");
      }
    };

    // Call fetchUserData when the component is mounted
    onMounted(fetchUserData);

    const toggleDropdown = () => {
      dropdownOpen.value = !dropdownOpen.value;
    };

    const showDropdown = () => {
      dropdownOpen.value = true;
    };

    const hideDropdown = () => {
      dropdownOpen.value = false;
    };

    const toggleProfileDropdown = () => {
      profileDropdownOpen.value = !profileDropdownOpen.value;
    };

    const logout = async () => {
      await Inertia.post(route('logout'), {}, {
        onSuccess: () => {
          router.push('/');
        }
      });
    };

    return {
      dropdownOpen,
      profileDropdownOpen,
      user,
      toggleDropdown,
      showDropdown,
      hideDropdown,
      toggleProfileDropdown,
      logout,
    };
  },
};
</script>

<style scoped>
.relative {
  cursor: pointer;
}

.relative .absolute {
  top: 100%;
  left: 0;
  margin-top: 0;
}

.bg-gray-900 {
  background-color: #1a202c;
}

.text-white {
  color: #fff;
}

.text-gray-300 {
  color: #d1d5db;
}

.bg-gray-800 {
  background-color: #2d3748;
}

.border-gray-700 {
  border-color: #4a5568;
}

.hover\:bg-gray-700:hover {
  background-color: #4a5568;
}

.hover\:text-white:hover {
  color: #ffffff;
}

.fas.fa-user {
  font-size: 1.2rem;
}

.text-sm {
  font-size: 0.875rem;
}

/* Dropdown Styles */
.relative {
  position: relative;
}

.absolute {
  position: absolute;
  top: 100%;
  left: 50%; /* Center dropdown horizontally */
  transform: translateX(-50%); /* Center dropdown horizontally */
  margin-top: 8px;
  width: 240px; /* Increased width for dropdown */
}

.block {
  display: block;
}

.px-4, .py-2 {
  padding-left: 16px;
  padding-right: 16px;
  padding-top: 8px;
  padding-bottom: 8px;
}
</style>
