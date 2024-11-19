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
import DashboardPage from "../views//admin/DashboardPage.vue";
import CreateActivity from "../views/admin/CreateActivity.vue";
import EditActivity from "../views/admin/EditActivity.vue";
import ActivityList from "@/views/admin/ActivityList.vue";
import DetailDonasi from "../views/DetailDonasi.vue";
import NominalPage from "../views/NominalPage.vue";
import FormDonasi from "../views/FormDonasi.vue";
import PembayaranPage from "../views/PembayaranPage.vue";
import UploadBukti from "../views/UploadBukti.vue";
import KalkulatorZakat from "../views/KalkulatorZakat.vue";
import DetailZakat from "../views/DetailZakat.vue";
import TransaksiDonasi from "../views/admin/TransaksiDonasi.vue";
import RingkasanDonasi from "../views/admin/RingkasanDonasi.vue";
import LaporanKeuangan from "../views/admin/LaporanKeuangan.vue";
import SideNav from "../components/SideNav";

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
    path: "/dashboard-page",
    name: "DashboardPage",
    component: DashboardPage,
    meta: { hideNavbar: true },
  },

  {
    path: "/activity-list",
    name: "ActivityList",
    component: ActivityList,
    meta: { hideNavbar: true },
  },
  {
    path: "/create-activity",
    name: "CreateActivity",
    component: CreateActivity,
    meta: { hideNavbar: true },
  },
  {
    path: "/edit-activity/:id",
    name: "EditActivity",
    component: EditActivity,
    meta: { hideNavbar: true },
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
    path: "/ringkasan-donasi/:id",
    name: "RingkasanDonasi",
    component: RingkasanDonasi,
  },
  {
    path: "/laporankeuangan",
    name: "LaporanKeuangan",
    component: LaporanKeuangan,
  },
  {
    path: "/sidenav",
    name: "SideNav",
    component: SideNav,
    meta: { hideNavbar: true },
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
