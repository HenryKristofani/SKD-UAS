<template>
    <section class="flex flex-col tracking-wide rounded-none">
        <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">
                Edit Reservasi Mendaki
            </h2>
            <form @submit.prevent="submitEditForm" enctype="multipart/form-data">
                <!-- Form Ketua Kelompok -->
                <div class="mb-4">
                    <label for="nama" class="block text-gray-700 font-semibold">Nama Ketua Kelompok</label>
                    <input
                        type="text"
                        id="nama"
                        v-model="formData.nama_ketua"
                        class="w-full mt-2 p-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                        required
                    />
                </div>

                <div class="mb-4">
                    <label for="nik" class="block text-gray-700 font-semibold">NIK Ketua Kelompok</label>
                    <input
                        type="text"
                        id="nik"
                        v-model="formData.nik_ketua"
                        class="w-full mt-2 p-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                        required
                    />
                </div>

                <div class="mb-4">
                    <label for="ktp" class="block text-gray-700 font-semibold">Upload Gambar KTP Ketua Kelompok</label>
                    <input
                        type="file"
                        id="ktp"
                        @change="handleFileUpload"
                        class="w-full mt-2 p-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                        accept="image/*"
                    />
                </div>

                <div class="mb-4">
                    <label for="telepon" class="block text-gray-700 font-semibold">Nomor Telepon Ketua Kelompok</label>
                    <input
                        type="tel"
                        id="telepon"
                        v-model="formData.telepon_ketua"
                        class="w-full mt-2 p-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                        required
                    />
                </div>

                <div class="mb-6">
                    <label for="alamat" class="block text-gray-700 font-semibold">Alamat</label>
                    <textarea
                        id="alamat"
                        v-model="formData.alamat_ketua"
                        rows="4"
                        class="w-full mt-2 p-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                        required
                    ></textarea>
                </div>

                <!-- Form Anggota Kelompok -->
                <div class="mb-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Anggota Kelompok</h3>
                    <div v-for="(member, index) in formData.anggota" :key="index" class="mb-4 border border-gray-300 rounded-md p-4">
                        <label :for="'nama_anggota_' + index" class="block text-gray-700 font-semibold">Nama Anggota</label>
                        <input
                            type="text"
                            :id="'nama_anggota_' + index"
                            v-model="member.nama"
                            :name="'nama_anggota_' + index"
                            class="w-full mt-2 p-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                            required
                        />

                        <label :for="'nik_anggota_' + index" class="block text-gray-700 font-semibold mt-4">NIK Anggota</label>
                        <input
                            type="text"
                            :id="'nik_anggota_' + index"
                            v-model="member.nik"
                            :name="'nik_anggota_' + index"
                            class="w-full mt-2 p-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                            required
                        />

                        <button type="button" @click="removeMember(index)" class="text-red-600 mt-2">Hapus Anggota</button>
                    </div>

                    <!-- Tombol Tambah Anggota -->
                    <button
                        type="button"
                        @click="addMember"
                        class="w-full bg-green-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-green-600 transition duration-200"
                        v-if="formData.anggota.length < 4"
                    >
                        Tambah Anggota
                    </button>
                </div>

                <div class="text-center">
                    <button
                        type="submit"
                        class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200"
                    >
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            formData: {
                nama_ketua: '',
                nik_ketua: '',
                telepon_ketua: '',
                alamat_ketua: '',
                anggota: [],
            },
        };
    },
    mounted() {
        this.fetchReservasiData();
    },
    methods: {
        async fetchReservasiData() {
            const id = this.$route.params.id; // Ambil ID dari route atau metode lain
            try {
                const response = await fetch(`API_ENDPOINT/reservasi/${id}`);
                const data = await response.json();
                this.formData = data; // Isi data form dengan data dari server
            } catch (error) {
                console.error("Gagal memuat data reservasi:", error);
            }
        },
        handleFileUpload(event) {
            const file = event.target.files[0];
            this.formData.ktp_ketua = file; // Simpan file untuk di-upload
        },
        addMember() {
            this.formData.anggota.push({ nama: '', nik: '' });
        },
        removeMember(index) {
            this.formData.anggota.splice(index, 1);
        },
        async submitEditForm() {
            try {
                // Lakukan request API untuk mengupdate data
                const response = await fetch(`API_ENDPOINT/reservasi/${this.$route.params.id}`, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(this.formData),
                });
                if (response.ok) {
                    alert("Reservasi berhasil diupdate");
                    this.$router.push("/reservasi"); // Arahkan kembali ke halaman reservasi
                } else {
                    alert("Gagal mengupdate reservasi");
                }
            } catch (error) {
                console.error("Error saat mengupdate reservasi:", error);
            }
        },
    },
};
</script>

<style scoped>
.container {
    max-width: 900px;
}
</style>
