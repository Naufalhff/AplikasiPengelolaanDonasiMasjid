import { createRouter, createWebHistory } from "vue-router";

// Import your components
import DefaultLayout from "@/Layout/DefaultLayout.vue";
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
import PilihKegiatan from "@/views/admin/PilihKegiatan.vue";
import RiwayatPengeluaran from "@/views/admin/RiwayatPengeluaran.vue";
import RingkasanPengeluaran from "@/views/admin/RingkasanPengeluaran.vue";
import BuatPengeluaran from "@/views/admin/BuatPengeluaran.vue";

const routes = [
  {
    path: "/",
    component: DefaultLayout,
    children: [
      {
        path: "/dashboard-page",
        name: "DashboardPage",
        component: DashboardPage,
        meta: {
          requiresAuth: true,
          hideNavbar: true,
          hideFooter: true,
          allowedRoles: ["Administrator"],
        },
      },
      {
        path: "/activity-list",
        name: "ActivityList",
        component: ActivityList,
        meta: {
          requiresAuth: true,
          hideNavbar: true,
          hideFooter: true,
        path: "/create-activity",
        name: "CreateActivity",
        component: CreateActivity,
        meta: {
          requiresAuth: true,
          hideNavbar: true,
          hideFooter: true,
          allowedRoles: ["Pengurus Masjid"],
        },
      },
      {
        path: "/edit-activity/:id",
        name: "EditActivity",
        component: EditActivity,
        meta: {
          requiresAuth: true,
          hideNavbar: true,
          hideFooter: true,
          allowedRoles: ["Pengurus Masjid"],
        },
      },
      {
        path: "/transaksidonasi",
        name: "TransaksiDonasi",
        component: TransaksiDonasi,
        meta: {
          requiresAuth: true,
          hideNavbar: true,
          hideFooter: true,
          allowedRoles: ["Bendahara", "Administrator"],
        },
      },
      {
        path: "/ringkasan-donasi/:id",
        name: "RingkasanDonasi",
        component: RingkasanDonasi,
        meta: {
          requiresAuth: true,
          hideNavbar: true,
          hideFooter: true,
          allowedRoles: ["Bendahara"],
        },
      },
      {
        path: "/laporankeuangan",
        name: "LaporanKeuangan",
        component: LaporanKeuangan,
        meta: {
          requiresAuth: true,
          hideNavbar: true,
          hideFooter: true,
          allowedRoles: ["Bendahara", "Administrator"],
        },
      },
      {
        path: "/pilih-kegiatan",
        name: "PilihKegiatan",
        component: PilihKegiatan,
        meta: {
          requiresAuth: true,
          hideNavbar: true,
          hideFooter: true,
          allowedRoles: ["Bendahara", "Administrator"],
        },
      },
      {
        path: "/riwayat-pengeluaran/:id",
        name: "RiwayatPengeluaran",
        component: RiwayatPengeluaran,
        meta: {
          requiresAuth: true,
          hideNavbar: true,
          hideFooter: true,
          allowedRoles: ["Bendahara"],
        },
      },
      {
        path: "/ringkasan-pengeluaran/:id",
        name: "RingkasanPengeluaran",
        component: RingkasanPengeluaran,
        meta: {
          requiresAuth: true,
          hideNavbar: true,
          hideFooter: true,
          allowedRoles: ["Bendahara"],
        },
      },
      {
        path: "/buat-pengeluaran/:id",
        name: "BuatPengeluaran",
        component: BuatPengeluaran,
        meta: {
          requiresAuth: true,
          hideNavbar: true,
          hideFooter: true,
          allowedRoles: ["Bendahara"],
        },
      },
    ],
  },
  {
    path: "",
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
    meta: { hideNavbar: true, hideFooter: true },
  },
  {
    path: "/forgot-password",
    name: "ForgotPassword",
    component: ForgotPassword,
    meta: { hideNavbar: true, hideFooter: true },
  },
  {
    path: "/verify-code",
    name: "VerifyCode",
    component: VerifyCode,
    meta: { hideNavbar: true, hideFooter: true },
  },
  {
    path: "/reset-password",
    name: "ResetPassword",
    component: ResetPassword,
    meta: { hideNavbar: true, hideFooter: true },
  },
  {
    path: "/register",
    name: "RegisterPage",
    component: RegisterPage,
    meta: { hideNavbar: true, hideFooter: true },
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
    meta: { hideNavbar: true, hideFooter: true },
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
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  const isLogin = sessionStorage.getItem("isLogin") === "true";
  const loginAs = sessionStorage.getItem("loginAs");

  if (to.matched.some((record) => record.meta.requiresAuth)) {
    if (!isLogin) {
      next({ path: "/login" });
    } else if (
      to.meta.allowedRoles &&
      !to.meta.allowedRoles.includes(loginAs)
    ) {
      next(false);
      alert("Forbidden");
    } else {
      next();
    }
  } else {
    next();
  }
});

export default router;
