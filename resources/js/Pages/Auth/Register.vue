<template>
    <GuestLayout>
        <form @submit.prevent="submit" class="space-y-4">
            <div>
                <label 
                    for="name" 
                    class="block text-sm font-medium text-gray-700"
                >
                    Name
                </label>
                <input 
                    id="name"
                    type="text" 
                    v-model="form.name" 
                    required 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                />
                <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">
                    {{ form.errors.name }}
                </div>
            </div>

            <div>
                <label 
                    for="email" 
                    class="block text-sm font-medium text-gray-700"
                >
                    Email
                </label>
                <input 
                    id="email"
                    type="email" 
                    v-model="form.email" 
                    required 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                />
                <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">
                    {{ form.errors.email }}
                </div>
            </div>

            <div>
                <label 
                    for="password" 
                    class="block text-sm font-medium text-gray-700"
                >
                    Password
                </label>
                <input 
                    id="password"
                    type="password" 
                    v-model="form.password" 
                    required 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                />
                <div v-if="form.errors.password" class="text-red-500 text-sm mt-1">
                    {{ form.errors.password }}
                </div>
            </div>

            <div>
                <label 
                    for="password_confirmation" 
                    class="block text-sm font-medium text-gray-700"
                >
                    Confirm Password
                </label>
                <input 
                    id="password_confirmation"
                    type="password" 
                    v-model="form.password_confirmation" 
                    required 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                />
            </div>

            <div>
                <button 
                    type="submit" 
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    :disabled="form.processing"
                >
                    {{ form.processing ? 'Registering...' : 'Register' }}
                </button>
            </div>
        </form>
    </GuestLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import GuestLayout from '@/Layouts/GuestLayout.vue'

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
})

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation')
    })
}
</script>