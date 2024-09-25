const { defineConfig } = require("@vue/cli-service");
module.exports = defineConfig({
  transpileDependencies: true,
});

module.exports = {
  devServer: {
    port: 8000, // Ganti dengan port yang kamu inginkan
  },
};
