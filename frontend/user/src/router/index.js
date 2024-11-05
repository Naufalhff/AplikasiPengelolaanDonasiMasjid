import { createRouter, createWebHistory } from "vue-router";

// Import your components
import HomePage from "../views/HomePage.vue";
import AboutPage from "../views/AboutPage.vue";
import EventsPage from "../views/EventPage.vue";
import LoginPage from "@/views/LoginPage.vue";
import ForgotPassword from "@/views/ForgotPassword.vue";
import VerifyCode from "@/views/VerifyCode.vue";
import ResetPassword from "@/views/ResetPassword.vue";
import RegisterPage from "../views/RegisterPage.vue";
import DonasiPage from "../views/DonasiPage.vue";
import VerifyRegister from "@/views/VerifyRegister.vue";
import DashboardPage from "../views/DashboardPage.vue";
import DetailDonasi from "../views/DetailDonasi.vue";
import NominalPage from "../views/NominalPage.vue";
import FormDonasi from "../views/FormDonasi.vue";
import PembayaranPage from "../views/PembayaranPage.vue";
import UploadBukti from "../views/UploadBukti.vue";
import KalkulatorZakat from "../views/KalkulatorZakat.vue";
import DetailZakat from "../views/DetailZakat.vue";
import TransaksiDonasi from "../views/TransaksiDonasi.vue";
import RingkasanDonasi from "../views/RingkasanDonasi.vue";

const routes = [
  {
    path: "/",
    component: HomePage,
  },
  {
    path: "/home",
    component: HomePage,
  },
  {
    path: "/about",
    component: AboutPage,
  },
  {
    path: "/events",
    component: EventsPage,
  },
  {
    path: "/login",
    component: LoginPage,
    meta: { hideNavbar: true },
  },
  {
    path: "/forgot-password",
    name: "ForgotPassword",
    component: ForgotPassword,
    meta: { hideNavbar: true },
  },
  {
    path: "/verify-code",
    name: "VerifyCode",
    component: VerifyCode,
    meta: { hideNavbar: true },
  },
  {
    path: "/reset-password",
    name: "ResetPassword",
    component: ResetPassword,
    meta: { hideNavbar: true },
  },
  {
    path: "/register",
    name: "RegisterPage",
    component: RegisterPage,
    meta: { hideNavbar: true },
  },
  {
    path: "/donasi",
    name: "DonasiPage",
    component: DonasiPage,
  },
  {
    path: "/detaildonasi",
    name: "DetailDonasi",
    component: DetailDonasi,
  },
  {
    path: "/detaildonasi/nominal",
    name: "NominalPage",
    component: NominalPage,
  },
  {
    path: "/detaildonasi/nominal/formdonasi",
    name: "FormDonasi",
    component: FormDonasi,
  },
  {
    path: "/detaildonasi/nominal/formdonasi/pembayaran",
    name: "PembayaranPage",
    component: PembayaranPage,
  },
  {
    path: "/verify-register",
    name: "VerifyRegister",
    component: VerifyRegister,
    meta: { hideNavbar: true },
  },
  {
    path: "/dashboard",
    name: "DashboardPage",
    component: DashboardPage,
  },
  {
    path: "/detaildonasi/nominal/formdonasi/pembayaran/uploadbukti",
    name: "UploadBukti",
    component: UploadBukti,
  },
  {
    path: "/kalkulatorzakat",
    name: "KalkulatorZakat",
    component: KalkulatorZakat,
  },
  {
    path: "/DetailZakat",
    name: "DetailZakat",
    component: DetailZakat,
  },
  {
    path: "/transaksidonasi",
    name: "TransaksiDonasi",
    component: TransaksiDonasi,
  },
  {
    path: '/ringkasan-donasi/:id',
    name: "RingkasanDonasi",
    component: RingkasanDonasi,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
