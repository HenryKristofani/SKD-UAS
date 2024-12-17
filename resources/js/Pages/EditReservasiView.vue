<template>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Edit Ketua Reservasi</h1>

        <form @submit.prevent="updateReservation">
            <!-- Nama Ketua -->
            <div class="mb-4">
                <label class="block text-gray-700">Nama Ketua</label>
                <input
                    v-model="reservation.nama_ketua"
                    type="text"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                />
            </div>

            <!-- NIK Ketua -->
            <div class="mb-4">
                <label class="block text-gray-700">NIK Ketua</label>
                <input
                    v-model="reservation.nik_ketua"
                    type="text"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                />
            </div>

            <!-- Submit Button -->
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500">
                Update
            </button>
        </form>
    </div>
</template>
  
<script>
import { Inertia } from '@inertiajs/inertia';

export default {
    props: {
        reservation: Object, // Reservation data from the backend
    },
    methods: {
        updateReservation() {
            // Prepare the data to send to the backend with only editable fields
            const data = {
                nama_ketua: this.reservation.nama_ketua,
                nik_ketua: this.reservation.nik_ketua
            };

            // Update the reservation with the specified data
            Inertia.put(`/admin/reservations/${this.reservation.id}`, data, {
                onSuccess: () => {
                    this.$inertia.visit('/admin/dashboard'); // Redirect to the dashboard after update
                }
            });
        }
    }
}
</script>
  
  <style scoped>
  /* Optional styling */
  </style>
  