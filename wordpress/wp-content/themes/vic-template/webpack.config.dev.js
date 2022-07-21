const { merge } = require("webpack-merge");
const common = require("./webpack.config.common");
const BrowserSyncPlugin = require("browser-sync-webpack-plugin");

module.exports = merge(common, {
  mode: "development",
  watch: true,
  plugins: [
    new BrowserSyncPlugin(
      {
        host: "localhost",
        port: 8080,
        proxy: "http://localhost:8082",
      },
      {
        reload: true,
      }
    ),
  ],
});
