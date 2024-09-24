import { createRouter, createWebHistory } from "vue-router";

// Import your components
import HomePage from "../views/HomePage.vue";
import AboutPage from "../views/AboutPage.vue";
import DonationPage from "../views/DonationPage.vue";
import EventsPage from "../views/EventPage.vue";
import LoginPage from "@/views/LoginPage.vue";

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
    path: "/donation",
    component: DonationPage,
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
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
