<template>
  <div class="container mx-auto px-4 py-8">
    <!-- Bagian Pembayaran -->
    <div class="max-w-3xl mx-auto rounded-lg shadow-lg overflow-hidden bg-white">
      <!-- Header Pembayaran -->
      <div class="bg-gray-100 p-6">
        <div class="flex items-center justify-start">
          <img
            loading="lazy"
            src="https://cdn.builder.io/api/v1/image/assets/7a94906f21da4dddb192bb8dc0012a21/54259b3870bf538921b9b16f1e364ec0d873a9b3f6e78737adecb81a31fbaff4?apiKey=4dffe41f7e5549a097f03eb0e6bb8499&"
            class="w-10 h-10"
            alt="Payment icon"
          />
          <span class="font-semibold text-xl ml-4">Pembayaran</span>
        </div>
      </div>

      <!-- Pilihan Pembayaran (DANA) -->
      <div class="bg-white p-6 border-b border-gray-200 hover:bg-gray-50 cursor-pointer">
        <div class="flex items-center space-x-4">
          <div class="p-2 bg-gray-200 rounded-md text-sm font-medium text-gray-700">DANA</div>
        </div>
      </div>

      <!-- Detail DANA -->
      <div class="p-6 bg-white border-b border-gray-200">
        <div class="flex items-center space-x-4">
          <img
            loading="lazy"
            src="https://cdn.builder.io/api/v1/image/assets/7a94906f21da4dddb192bb8dc0012a21/f6dd6004b3762d7459c74ded146670ffad335a948530e6dc4bf50fdf209c5006?apiKey=4dffe41f7e5549a097f03eb0e6bb8499&"
            class="w-16 h-16 object-contain"
            alt="DANA payment logo"
          />
          <div class="flex-1">
            <div class="font-semibold text-lg">8100XXXX-XXXX</div>
            <div class="text-gray-500">DANA Official Bukit Mongkrang</div>
          </div>
        </div>
      </div>

      <!-- Pilihan Bank Transfer -->
      <div class="bg-white p-6 border-b border-gray-200 hover:bg-gray-50 cursor-pointer">
        <div class="flex items-center space-x-4">
          <div class="p-2 bg-gray-200 rounded-md text-sm font-medium text-gray-700">Bank Transfer</div>
        </div>
      </div>

      <!-- Detail Bank Mandiri -->
      <div class="p-6 bg-white">
        <div class="flex items-center space-x-4">
          <img
            loading="lazy"
            src="https://cdn.builder.io/api/v1/image/assets/7a94906f21da4dddb192bb8dc0012a21/21441cec5ccf8acbb324ad79db98f18369424066587a09cc9070c8d7ccc3651a?apiKey=4dffe41f7e5549a097f03eb0e6bb8499&"
            class="w-16 h-16 object-contain"
            alt="Bank Mandiri logo"
          />
          <div class="flex-1">
            <div class="font-semibold text-lg">131-00-4444298-8</div>
            <div class="text-gray-500">Livin' Mandiri Mongkrang Official</div>
          </div>
        </div>
      </div>

      <!-- Total Pembayaran dan Tombol Unggah Bukti -->
      <div class="bg-gray-100 p-6">
        <div class="text-left mb-4">
          <div class="text-lg font-medium text-gray-900">Detail Pembayaran</div>
          <div class="text-base text-gray-700 mt-2">
            <p>{{ tarifPerOrang }} x {{ jumlahPendaki }} pendaki</p>
            <p class="font-semibold mt-2">Total: Rp. {{ totalPembayaran }}</p>
          </div>
        </div>
        <!-- Tombol Unggah Bukti Transfer -->
        <form @submit.prevent="uploadBuktiPembayaran" class="text-center">
          <div class="flex justify-center items-center space-x-4">
            <input type="file" @change="handleFileUpload" class="file-input" />
            <button type="submit" class="btn-primary">Unggah Bukti Transfer</button>
          </div>
          <p v-if="message" class="text-sm text-red-600 mt-2">{{ message }}</p>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'PaymentDetails',
  data() {
    return {
      file: null,
      message: "",
      jumlahPendaki: null,  // Menyimpan jumlah pendaki
      tarifPerOrang: 15000, // Biaya per orang
    };
  },
  computed: {
    // Menghitung total pembayaran
    totalPembayaran() {
      if (this.jumlahPendaki !== null) {
        return this.tarifPerOrang * this.jumlahPendaki;
      }
      return 0;
    },
  },
  methods: {
    handleFileUpload(event) {
      this.file = event.target.files[0];
    },

    // Method untuk mengambil jumlah pendaki berdasarkan ID
    async getJumlahPendaki() {
      const reservasiId = 33;  // Ganti dengan ID reservasi yang relevan

      try {
        const response = await fetch(`http://127.0.0.1:8000/reservasi/${reservasiId}/jumlah-pendaki`);
        if (response.ok) {
          const data = await response.json();
          this.jumlahPendaki = data.jumlah_pendaki; // Menyimpan jumlah pendaki
        } else {
          console.error("Gagal mengambil jumlah pendaki");
        }
      } catch (error) {
        console.error("Terjadi kesalahan: ", error);
      }
    },

    async uploadBuktiPembayaran() {
      if (!this.file) {
        this.message = "Silakan pilih file terlebih dahulu!";
        return;
      }

      const formData = new FormData();
      formData.append("bukti_pembayaran", this.file);

      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

      try {
        const response = await fetch("http://127.0.0.1:8000/reservasi/upload-bukti", {
          method: "POST",
          headers: {
            "X-CSRF-TOKEN": csrfToken,
          },
          body: formData,
        });

        if (response.ok) {
          const data = await response.json();
          this.message = "Bukti pembayaran berhasil diunggah! Mengarahkan ke halaman utama...";

          // Memanggil metode untuk menampilkan jumlah pendaki setelah upload berhasil
          this.getJumlahPendaki();

          setTimeout(() => {
            window.location.href = "/home";
          }, 3000);
        } else {
          const errorData = await response.json();
          this.message = `Error: ${errorData.message}`;
        }
      } catch (error) {
        console.error("Terjadi kesalahan: ", error);
        this.message = "Terjadi kesalahan saat mengunggah bukti pembayaran!";
      }
    },
  },
  mounted() {
    // Mengambil jumlah pendaki saat komponen dimuat
    this.getJumlahPendaki();
  },
};
</script>

<style scoped>
.file-input {
  border: 1px solid #e5e7eb;
  padding: 8px 12px;
  border-radius: 8px;
  background-color: #f9fafb;
}

.btn-primary {
  background-color: #1e40af;
  color: white;
  padding: 12px 24px;
  border-radius: 8px;
  font-weight: 600;
  cursor: pointer;
  transition: background-color 0.3s;
}

.btn-primary:hover {
  background-color: #1d4ed8;
}

.notification {
  color: red;
  font-size: 0.875rem;
}

.bg-white {
  background-color: #ffffff;
}

.bg-gray-100 {
  background-color: #f7fafc;
}

.bg-gray-200 {
  background-color: #edf2f7;
}

.text-gray-500 {
  color: #6b7280;
}

.text-gray-700 {
  color: #4a5568;
}

.text-gray-900 {
  color: #1a202c;
}

.border-gray-200 {
  border-color: #e5e7eb;
}

.hover\:bg-gray-50:hover {
  background-color: #f9fafb;
}
</style>
