<template>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
  />
  <footer class="footer bg-success text-white py-4">
    <div class="container">
      <div class="row">
        <!-- Left section -->
        <div class="col-md-6">
          <h2>Mesjid Luqmanul Hakim</h2>
          <p>
            Politeknik Negeri Bandung, Jl. Ciwaruga, Ciwaruga, Kec. Parongpong,
            Kabupaten Bandung Barat, Jawa Barat 40559
          </p>
          <div>
            <a
              href="https://www.youtube.com/redirect?event=channel_description&redir_token=QUFFLUhqa2Rtc3VmVk9wOFBIRGstNmpTN2Y0ak5OZ1l4QXxBQ3Jtc0tuU2RPQjFtNjN4N1o3MUJaVjM3dkU4bmd3bE5adnlyQnpxbFpyY1hUUi1uNHJDSWtUaGNGLVVMc0xwaHFKdFBSU3c5TEk3UU15MS1zeDJORXJSRGhlbmU0b1RFZXlmdkI4Q1VfMjNUUWdGM09FRmh0bw&q=https%3A%2F%2Fwww.facebook.com%2Fpolbanofficial"
              target="_blank"
              class="text-white me-3 mr-2"
              ><i class="fab fa-facebook"></i> Facebook</a
            >
            <a
              href="https://www.instagram.com/politekniknegeribandung?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
              target="_blank"
              class="text-white me-3 mr-2"
              ><i class="fab fa-instagram"></i> Instagram</a
            >
            <a
              href="https://www.youtube.com/channel/UCdRxGHXVIJLCNXmxbeHWtUw"
              target="_blank"
              class="text-white"
              ><i class="fab fa-youtube"></i> YouTube</a
            >
          </div>
        </div>
      </div>
      <!-- Footer Links -->
      <div class="mb-2 text-center">
        <p>© DKM Luqmanul Hakim</p>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  name: "FooterComponent",
};
</script>

<style scoped>
.footer {
  background-color: #28a745;
  color: white;
  padding: 40px 0;
}

.footer a {
  text-decoration: none;
}

.footer a:hover {
  text-decoration: underline;
}
</style>
