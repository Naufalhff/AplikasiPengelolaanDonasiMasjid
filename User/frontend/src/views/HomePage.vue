<template>
  <div>
    <!-- Assuming Navbar is included in App.vue or as a global component -->
    <HeroSection />
    <AboutSection />
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
