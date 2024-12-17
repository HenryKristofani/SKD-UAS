import { createRouter, createWebHistory } from "vue-router";
import HomeBeforeView from "./Pages/HomeBeforeView.vue";
import HomeView from "./Pages/HomeView.vue";
import Login from "./Pages/LoginView.vue";
import Reservasi from "./Pages/ReservasiView.vue";
import ReservasiList from "./Pages/ReservasiListView.vue";
import EditReservasiView from "./Pages/EditReservasiView.vue"; // Import halaman edit reservasi
import IsiBerita from "./Pages/Berita/isiberita.vue";
import BayarReservasiView from "@/views/BayarReservasiView.vue"; // Import halaman pembayaran reservasi

const routes = [
    { path: "/", component: HomeBeforeView, name: "homeBefore" },
    { path: "/login", component: Login, name: "login" },
    { path: "/reservasi", component: Reservasi, name: "reservasi" },
    { path: "/home", component: HomeView, name: "home" },
    { path: "/reservasilist", component: ReservasiList, name: "reservasilist" },
    { path: "/reservasi/:id/edit", component: EditReservasiView, name: "reservasis.edit" },
    { path: "/berita", component: IsiBerita, name: "berita" },
    { 
        path: "/bayar/:id", 
        component: BayarReservasiView, 
        name: "bayar",
        props: true, // Mengirim parameter id sebagai props ke komponen
    },
    {
        path: '/admin/dashboard',
        component: DashboardView
    },
    {
        path: '/admin/terkonfirmasi',
        component: TerkonfirmasiView
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
