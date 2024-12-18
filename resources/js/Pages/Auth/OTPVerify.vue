<template>
    <GuestLayout>
        <div class="mb-4 text-sm text-gray-600">
            Please check your email for the OTP and enter it below.
        </div>

        <form @submit.prevent="submitOTP" class="space-y-4">
            <div>
                <label 
                    for="otp" 
                    class="block text-sm font-medium text-gray-700"
                >
                    OTP
                </label>
                <input 
                    id="otp"
                    type="text" 
                    v-model="form.otp" 
                    required 
                    maxlength="6"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    placeholder="Enter 6-digit OTP"
                />
                <div v-if="form.errors.otp" class="text-red-500 text-sm mt-1">
                    {{ form.errors.otp }}
                </div>
            </div>

            <div>
                <button 
                    type="submit" 
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    :disabled="form.processing"
                >
                    {{ form.processing ? 'Verifying...' : 'Verify OTP' }}
                </button>
            </div>
        </form>
    </GuestLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import GuestLayout from '@/Layouts/GuestLayout.vue'

const form = useForm({
    email: route().params.email || '',
    otp: ''
})

const submitOTP = () => {
    form.post(route('otp.verify.submit'), {
        preserveScroll: true,
        onError: () => {
            form.reset('otp')
        }
    })
}
</script>