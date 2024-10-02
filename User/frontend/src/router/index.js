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

const routes = [
  {
    path: "/",
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
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
