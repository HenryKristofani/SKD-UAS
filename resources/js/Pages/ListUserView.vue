<template>
  <div class="flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white h-screen p-4">
      <h2 class="text-xl font-semibold mb-6">Admin Dashboard</h2>
      <nav>
        <ul>
          <li>
            <a
              href="/admin/dashboard"
              :class="{
                'block py-2 px-4 rounded': true,
                'bg-gray-700': currentPath === '/admin/dashboard',
                'hover:bg-gray-700': currentPath !== '/admin/dashboard'
              }"
            >
              Menunggu Konfirmasi
            </a>
          </li>
          <li>
            <a
              href="/admin/terkonfirmasi"
              :class="{
                'block py-2 px-4 rounded': true,
                'bg-gray-700': currentPath === '/admin/terkonfirmasi',
                'hover:bg-gray-700': currentPath !== '/admin/terkonfirmasi'
              }"
            >
              Terkonfirmasi
            </a>
          </li>
          <li>
            <a
              href="/admin/list-users"
              :class="{
                'block py-2 px-4 rounded': true,
                'bg-gray-700': currentPath === '/admin/list-users',
                'hover:bg-gray-700': currentPath !== '/admin/list-users'
              }"
            >
              List Akun User
            </a>
          </li>
          <li>
            <a
              href="#"
              @click="logout"
              class="block py-2 px-4 mt-6 bg-red-600 hover:bg-red-500 rounded"
            >
              Logout
            </a>
          </li>
        </ul>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 bg-gray-100">
      <h1 class="text-2xl font-bold mb-6">List Akun User</h1>
      <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
          <tr class="bg-gray-200">
            <th class="border border-gray-300 px-4 py-2">ID</th>
            <th class="border border-gray-300 px-4 py-2">Name</th>
            <th class="border border-gray-300 px-4 py-2">Email</th>
            <th class="border border-gray-300 px-4 py-2">Status</th>
            <th class="border border-gray-300 px-4 py-2">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id" class="hover:bg-gray-100">
            <td class="border border-gray-300 px-4 py-2">{{ user.id }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ user.name }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ user.email }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ user.status }}</td>
            <td class="border border-gray-300 px-4 py-2">
              <button
                v-if="user.status === 'aktif'"
                @click="blockUser(user.id)"
                class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-400"
              >
                Block
              </button>
              <button
                v-if="user.status === 'blokir'"
                @click="unblockUser(user.id)"
                class="bg-green-500 text-white px-4 py-1 rounded hover:bg-green-400"
              >
                Unblock
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </main>
  </div>
</template>



<script>
export default {
  data() {
    return {
      users: [], // List of users
    };
  },
  computed: {
    currentPath() {
      return window.location.pathname; // Get the current URL path
    },
  },
  mounted() {
    this.fetchUsers(); // Fetch users when the component is mounted
  },
  methods: {
    // Fetch the list of users
    async fetchUsers() {
      try {
        const response = await fetch("/api/users");
        this.users = await response.json();
      } catch (error) {
        console.error("Error fetching users:", error);
      }
    },
    // Block a user
    async blockUser(userId) {
      if (confirm("Are you sure you want to block this user?")) {
        try {
          const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content"); // CSRF Token

          const response = await fetch(`/api/users/${userId}/block`, {
            method: "PUT",
            headers: {
              "Content-Type": "application/json",
              "X-CSRF-TOKEN": csrfToken,
            },
          });

          if (response.ok) {
            const data = await response.json();
            alert(data.message);
            this.fetchUsers(); // Refresh user list
          } else {
            alert("Failed to block user.");
          }
        } catch (error) {
          console.error("Error blocking user:", error);
        }
      }
    },
    // Unblock a user
    async unblockUser(userId) {
      if (confirm("Are you sure you want to unblock this user?")) {
        try {
          const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content"); // CSRF Token

          const response = await fetch(`/api/users/${userId}/unblock`, {
            method: "PUT",
            headers: {
              "Content-Type": "application/json",
              "X-CSRF-TOKEN": csrfToken,
            },
          });

          if (response.ok) {
            const data = await response.json();
            alert(data.message);
            this.fetchUsers(); // Refresh user list
          } else {
            alert("Failed to unblock user.");
          }
        } catch (error) {
          console.error("Error unblocking user:", error);
        }
      }
    },
    // Logout
    async logout() {
      if (confirm("Are you sure you want to logout?")) {
        try {
          const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content"); // CSRF Token

          const response = await fetch("/logout", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
              "X-CSRF-TOKEN": csrfToken,
            },
          });

          if (response.ok) {
            window.location.href = "/login"; // Redirect to login page
          } else {
            alert("Failed to logout.");
          }
        } catch (error) {
          console.error("Error during logout:", error);
        }
      }
    },
  },
};
</script>

<style scoped>
/* Tabel Umum */
table {
  width: 100%;
  border-collapse: collapse;
  font-family: Arial, sans-serif;
}

/* Header Tabel */
thead tr {
  background-color: #e5e7eb; /* Warna abu-abu muda untuk header */
  color: #000; /* Warna teks hitam */
  font-weight: bold;
  text-align: left;
}

th {
  padding: 12px 8px; /* Padding untuk header */
  border: 1px solid #d1d5db; /* Garis abu-abu */
  border-right: 1px solid #d1d5db; /* Pemisah vertikal antar kolom */
}

/* Isi Tabel */
td {
  background-color: #fff; /* Warna latar putih untuk kolom isi */
  color: #000; /* Warna teks hitam */
  padding: 10px 8px; /* Padding untuk sel */
  border: 1px solid #d1d5db; /* Garis abu-abu */
  border-right: 1px solid #d1d5db; /* Pemisah vertikal antar kolom */
  text-align: left;
  vertical-align: middle; /* Tengah secara vertikal */
}

/* Efek Hover pada Baris */
tbody tr:hover {
  background-color: #f9fafb; /* Warna hover abu-abu terang */
}

/* Button Hover */
button:hover {
  cursor: pointer;
}
</style>


