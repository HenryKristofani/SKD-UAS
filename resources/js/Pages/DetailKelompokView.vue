<template>
    <div class="p-6 bg-white shadow rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">Detail Reservasi</h2>
        
        <div class="mb-4">
            <p><strong>ID Booking:</strong> {{ reservasi.id }}</p>
            <p><strong>Nama Ketua:</strong> {{ reservasi.nama_ketua }}</p>
            <p><strong>NIK Ketua:</strong> {{ reservasi.nik_ketua }}</p>
            <p><strong>Telepon Ketua:</strong> {{ reservasi.telepon_ketua }}</p>
            <p><strong>Alamat Ketua:</strong> {{ reservasi.alamat_ketua }}</p>
            <p><strong>Anggota Kelompok:</strong></p>
            <ul>
                <li v-for="(anggota, index) in reservasi.anggota" :key="index">
                    Nama: {{ anggota.nama }}, NIK: {{ anggota.nik }}
                </li>
            </ul>
        </div>

        <button @click="goBack" class="px-4 py-2 bg-gray-800 text-white rounded">Kembali</button>
    </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';

export default {
    props: {
        reservasi: Object // Expect a reservation object from the controller
    },
    methods: {
        goBack() {
            Inertia.visit('/admin/dashboard');
        }
    }
}
</script>

<style scoped>
/* Additional styling */
p, ul {
    margin: 0.5rem 0;
}
</style>
