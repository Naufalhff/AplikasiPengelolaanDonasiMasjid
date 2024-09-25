<template>
  <div>
    <!-- Assuming Navbar is included in App.vue or as a global component -->
    <HeroSection />
    <AboutSection />

    <!-- Divider Section -->
    <section class="divider">
      <div class="container text-center">
        <hr class="section-divider">
      </div>
    </section>

    <DonationsSection />
  </div>
</template>

<script>
import HeroSection from "@/components/HeroSection.vue";
import AboutSection from "@/components/AboutSection.vue";
import DonationsSection from "@/components/DonationsSection.vue";

export default {
  name: "HomePage",
  components: {
    HeroSection,
    AboutSection,
    DonationsSection,
  },
};
</script>

<style scoped>
/* Styling for the divider */
.divider {
  padding: 20px 0; /* Vertical padding to create space */
  background-color: #f8f9fa; /* Light background to match the theme */
}

.section-divider {
  border-top: 3px solid #28a745; /* Custom color for the divider */
  width: 70%; /* Width of the divider */
  margin: 0 auto; /* Centering the divider */
}
</style>
