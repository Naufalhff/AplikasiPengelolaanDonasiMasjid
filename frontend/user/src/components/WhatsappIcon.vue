<template>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
  />

  <div class="whatsapp-button">
    <a
      href="https://wa.me/6287830664001"
      target="_blank"
      rel="noopener noreferrer"
      class="whatsapp-icon"
    >
      <i class="fab fa-whatsapp"></i>
    </a>
  </div>
</template>

<script>
export default {
  name: "WhatsAppButton",
};
</script>

<style scoped>
.whatsapp-button {
  position: fixed;
  bottom: 20px;
  right: 20px;
}

.whatsapp-icon {
  width: 60px;
  height: 60px;
  background-color: #25d366;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  color: white;
  font-size: 30px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  text-decoration: none;
}

.whatsapp-icon:hover {
  background-color: #20b954;
}
</style>
