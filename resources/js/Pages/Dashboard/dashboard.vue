<template>
    <div class="dashboard">
        <h1>Admin Dashboard</h1>
        <p>Selamat datang di halaman dashboard khusus admin dengan email admin@gmail.com!</p>
        <button @click="logout" class="mt-4 px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
            Logout
        </button>
    </div>
</template>

<script>
export default {
    methods: {
        async logout() {
            try {
                const response = await fetch('/admin/logout', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                if (response.ok) {
                    // Redirect to login page after logout
                    window.location.href = '/';
                } else {
                    alert('Gagal logout. Silakan coba lagi.');
                }
            } catch (error) {
                console.error('Logout error:', error);
                alert('Terjadi kesalahan saat logout.');
            }
        }
    }
}
</script>

<style scoped>
.dashboard {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    text-align: center;
    background-color: #f4f6f8;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

h1 {
    font-size: 2rem;
    color: #333;
}

p {
    font-size: 1.2rem;
    color: #555;
}
</style>