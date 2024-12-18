<template>
  <div class="flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white h-screen p-4">
      <h2 class="text-xl font-semibold mb-6">Admin Dashboard</h2>
      <nav>
        <ul>
          <li>
            <a href="/admin/dashboard" 
               :class="{'bg-gray-700': true}" 
               class="block py-2 px-4 hover:bg-gray-700 rounded">
              Menunggu Konfirmasi
            </a>
          </li>
          <li>
            <a href="/admin/terkonfirmasi" 
               class="block py-2 px-4 hover:bg-gray-700 rounded">
              Terkonfirmasi
            </a>
          </li>
          <li>
            <a href="/admin/list-users" 
               class="block py-2 px-4 hover:bg-gray-700 rounded">
              List User
            </a>
          </li>







          <li>
            <a href="#" @click="logout" 
               class="block py-2 px-4 mt-6 bg-red-600 hover:bg-red-500 rounded">
              Logout
            </a>
          </li>
        </ul>
      </nav>
    </aside>
    
    <!-- Main Content Area -->
    <main class="flex-1 p-6 bg-gray-100">
      <h1 class="text-2xl font-bold mb-6">Menunggu Dikonfirmasi</h1>
      
      <table class="min-w-full bg-white mt-4 border border-gray-300">
        <thead>
          <tr class="bg-gray-200">
            <th class="py-2 px-4 border-b border-r">ID Booking</th>
            <th class="py-2 px-4 border-b border-r">Nama Ketua</th>
            <th class="py-2 px-4 border-b border-r">NIK Ketua</th>
            <th class="py-2 px-4 border-b border-r">Telepon Ketua</th>
            <th class="py-2 px-4 border-b border-r">Tanggal Reservasi</th>
            <th class="py-2 px-4 border-b border-r">Bukti Pembayaran</th>
            <th class="py-2 px-4 border-b">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="reservasi in reservasis" :key="reservasi.id">
            <td class="py-2 px-4 border-b border-r">{{ reservasi.id }}</td>
            <td class="py-2 px-4 border-b border-r">{{ reservasi.nama_ketua }}</td>
            <td class="py-2 px-4 border-b border-r">{{ reservasi.nik_ketua }}</td>
            <td class="py-2 px-4 border-b border-r">{{ reservasi.telepon_ketua }}</td>
            <td class="py-2 px-4 border-b border-r">{{ formatDate(reservasi.tanggal_reservasi) }}</td>
            <td class="py-2 px-4 border-b border-r">

              <img v-if="reservasi.bukti_pembayaran" 
                   :src="`/storage/${reservasi.bukti_pembayaran}`" 
                   alt="Bukti Pembayaran" 
                   class="w-16 h-16 cursor-pointer"
                   @click="viewImage(`/storage/${reservasi.bukti_pembayaran}`)" />

              <p v-else class="text-red-500">Belum Upload</p>
            </td>
            <td class="py-2 px-4 border-b flex space-x-2">
              <button @click="viewDetails(reservasi.id)" class="bg-gray-500 hover:bg-gray-400 text-white px-2 py-1 rounded">Detail</button>
              <button @click="confirmEdit(reservasi.id)" class="bg-blue-500 hover:bg-blue-400 text-white px-2 py-1 rounded">Edit</button>
              <button @click="confirmDelete(reservasi.id)" class="bg-red-500 hover:bg-red-400 text-white px-2 py-1 rounded">Delete</button>
              <button @click="konfirmasiReservasi(reservasi.id)" class="bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600">Konfirmasi</button>            
            </td>
          </tr>
        </tbody>
      </table>


      <!-- Modal for displaying reservation details -->
      <div v-if="selectedReservation" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg max-w-lg w-full">
          <h2 class="text-xl font-semibold mb-4">Detail Reservasi</h2>
          <p><strong>ID Booking:</strong> {{ selectedReservation.id }}</p>
          <p><strong>Nama Ketua:</strong> {{ selectedReservation.nama_ketua }}</p>
          <p><strong>NIK Ketua:</strong> {{ selectedReservation.nik_ketua }}</p>
          <p><strong>Telepon Ketua:</strong> {{ selectedReservation.telepon_ketua }}</p>
          <p><strong>Alamat Ketua:</strong> {{ selectedReservation.alamat_ketua }}</p>
          <p><strong>Tanggal Reservasi:</strong> {{ formatDate(selectedReservation.tanggal_reservasi) }}</p>

          <h3 class="mt-4 font-semibold">Anggota Kelompok:</h3>
          <ul v-if="selectedReservation.anggota && selectedReservation.anggota.length">
            <li v-for="(member, index) in selectedReservation.anggota" :key="index" class="mb-2">
              <p><strong>Nama Anggota {{ index + 1 }}:</strong> {{ member.nama }}</p>
              <p><strong>NIK Anggota {{ index + 1 }}:</strong> {{ member.nik }}</p>
            </li>
          </ul>
          <p v-else>Tidak ada anggota tambahan.</p>

          <button @click="closeDetails" class="mt-4 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Tutup</button>
        </div>
      </div>
      
      <!-- Modal for displaying image -->
      <div v-if="selectedImage" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-4 rounded-lg relative">
          <button @click="closeImage" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
            ✖
          </button>
          <img :src="selectedImage" alt="Detail Bukti Pembayaran" class="max-w-full max-h-screen rounded" />
        </div>
      </div>
    </main>
  </div>
</template>


<script>
import { Inertia } from '@inertiajs/inertia';

export default {
  props: {
    reservasiId: Number,
    reservasis: Array
  },
  data() {
    return {
      selectedReservation: null,
      selectedImage: null, // URL gambar yang dipilih
    };
  },
  methods: {
    async konfirmasiReservasi(reservasiId) {
      try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

        const response = await fetch(`/admin/reservasi/${reservasiId}/konfirmasi`, {
          method: "POST",
          headers: {
            "X-CSRF-TOKEN": csrfToken,
            "Content-Type": "application/json"
          }
        });

        if (response.ok) {
          const data = await response.json();
          console.log(data);
          this.$inertia.reload(); // Jika menggunakan Inertia
        } else {
          const errorData = await response.json();
          console.error('Gagal mengonfirmasi reservasi:', errorData);
          alert(errorData.message || 'Terjadi kesalahan saat mengonfirmasi reservasi');
        }
      } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan jaringan');
      }
    },
    formatDate(date) {
      const options = { year: 'numeric', month: 'long', day: 'numeric' };
      return new Date(date).toLocaleDateString('id-ID', options);
    },
    viewImage(imageUrl) {
      this.selectedImage = imageUrl; // Set URL gambar untuk ditampilkan di modal
    },
    closeImage() {
      this.selectedImage = null; // Hapus URL gambar untuk menutup modal




    },
    viewDetails(id) {
      fetch(`/reservasi/${id}`)
        .then(response => response.json())
        .then(data => {
          this.selectedReservation = data;
        })
        .catch(error => {
          console.error("Error fetching reservation details:", error);
        });
    },
    closeDetails() {
      this.selectedReservation = null;
    },
    confirmEdit(id) {
      if (confirm("Apakah Anda yakin ingin mengedit data reservasi ini?")) {
        this.editReservation(id);
      }
    },
    editReservation(id) {
      Inertia.visit(`/admin/reservations/${id}/edit`);
    },
    confirmDelete(id) {
      if (confirm('Apakah Anda yakin ingin menghapus data reservasi ini? Tindakan ini tidak dapat dibatalkan.')) {
        Inertia.delete(`/admin/reservations/${id}`);
      }
    },
    deleteReservation(id) {
      Inertia.delete(`/admin/reservasi/${id}`);
    },
    logout() {
      Inertia.post('/logout');
    }
  }
};
</script>

<style scoped>
/* Styling khusus untuk komponen ini */
</style>