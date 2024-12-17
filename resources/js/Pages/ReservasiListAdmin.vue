<template>
    <section class="container mx-auto p-8">
        <h1 class="text-2xl font-semibold mb-6">Daftar Reservasi Pendakian</h1>

        <table class="w-full border border-gray-300 border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 border-gray-300">ID Booking</th>
                    <th class="px-4 py-2 border-gray-300">Nama Ketua</th>
                    <th class="px-4 py-2 border-gray-300">NIK Ketua</th>
                    <th class="px-4 py-2 border-gray-300">Telepon Ketua</th>
                    <th class="px-4 py-2 border-gray-300">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="reservasi in reservasis" :key="reservasi.id">
                    <td class="px-4 py-2 border-t border-gray-300">{{ reservasi.id }}</td>
                    <td class="px-4 py-2 border-t border-gray-300">{{ reservasi.nama_ketua }}</td>
                    <td class="px-4 py-2 border-t border-gray-300">{{ reservasi.nik_ketua }}</td>
                    <td class="px-4 py-2 border-t border-gray-300">{{ reservasi.telepon_ketua }}</td>
                    <td class="px-4 py-2 border-t border-gray-300 flex space-x-2">
                        <button @click="goToPembayaran(reservasi.id)" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Bayar</button>
                        <button @click="deleteReservasi(reservasi.id)" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Pembatalan</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
</template>

<script>
import { ref, onMounted } from 'vue';
import { Inertia } from '@inertiajs/inertia';

export default {
    name: "ReservasiListAdmin",
    setup() {
        const reservasis = ref([]);

        // Fetch data reservasi dari server saat komponen dimuat
        const fetchReservasis = async () => {
            try {
                const response = await fetch('/reservasis');
                if (!response.ok) throw new Error("Gagal mengambil data");
                reservasis.value = await response.json();
            } catch (error) {
                console.error(error);
                alert("Terjadi kesalahan saat mengambil data reservasi.");
            }
        };
        onMounted(fetchReservasis);

        // Fungsi untuk menghapus reservasi dan mengarahkan ke home
        const deleteReservasi = async (id) => {
            if (confirm("Yakin ingin membatalkan reservasi ini?")) {
                try {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const response = await fetch(`/reservasi/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken, // Menambahkan CSRF token
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                    });
                    if (!response.ok) throw new Error("Gagal menghapus data");
                    alert("Reservasi berhasil dibatalkan.");
                    window.location.href = '/home'; // Arahkan ke halaman home setelah pembatalan
                } catch (error) {
                    console.error(error);
                    alert("Terjadi kesalahan saat membatalkan reservasi.");
                }
            }
        };

        // Fungsi untuk pembayaran
        const goToPembayaran = (id) => {
            window.location.href = `/pembayaran/${id}`;
        };

        return { reservasis, deleteReservasi, goToPembayaran };
    }
};
</script>

<style scoped>
.container {
    max-width: 900px;
}

table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    border: 1px solid #D1D5DB; /* Warna border */
}

th {
    background-color: #E5E7EB; /* Warna latar header */
}
</style>
