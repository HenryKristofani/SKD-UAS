<template>
    <section class="container mx-auto p-8">
        <h1 class="text-2xl font-semibold mb-6">Daftar Reservasi Pendakian</h1>

        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 border border-gray-300">Nama Ketua</th>
                    <th class="px-4 py-2 border border-gray-300">NIK Ketua</th>
                    <th class="px-4 py-2 border border-gray-300">Telepon Ketua</th>
                    <th class="px-4 py-2 border border-gray-300">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="reservasi in reservasis" :key="reservasi.id">
                    <td class="border px-4 py-2">{{ reservasi.nama_ketua }}</td>
                    <td class="border px-4 py-2">{{ reservasi.nik_ketua }}</td>
                    <td class="border px-4 py-2">{{ reservasi.telepon_ketua }}</td>
                    <td class="border px-4 py-2 flex space-x-2">
                        <button @click="editReservasi(reservasi.id)" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit</button>
                        <button @click="deleteReservasi(reservasi.id)" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
</template>

<script>
import { ref, onMounted } from 'vue';

export default {
    name: "ReservasiListView",
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

        // Fungsi untuk menghapus reservasi
        const deleteReservasi = async (id) => {
            if (confirm("Yakin ingin menghapus reservasi ini?")) {
                try {
                    const response = await fetch(`/reservasi/${id}`, { method: 'DELETE' });
                    if (!response.ok) throw new Error("Gagal menghapus data");
                    reservasis.value = reservasis.value.filter(r => r.id !== id);
                    alert("Reservasi berhasil dihapus.");
                } catch (error) {
                    console.error(error);
                    alert("Terjadi kesalahan saat menghapus data.");
                }
            }
        };

        // Fungsi untuk mengedit reservasi
        const editReservasi = (id) => {
            // Arahkan ke halaman edit, sesuaikan dengan logika routing Anda
            alert("Fitur edit belum diimplementasikan."); // Placeholder
        };

        return { reservasis, deleteReservasi, editReservasi };
    }
};
</script>

<style scoped>
.container {
    max-width: 900px;
}
</style>
