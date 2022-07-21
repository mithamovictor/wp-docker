const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const ImageminPlugin = require("imagemin-webpack-plugin").default;
const glob = require("glob");

module.exports = {
  mode: "development",
  // context: path.resolve(__dirname, "src"),
  entry: path.resolve(__dirname, "src", "js") + "/app.js",
  output: {
    filename: "app.js",
    path: path.resolve(__dirname, "dist", "js"),
  },
  plugins: [
    new ImageminPlugin({
      externalImages: {
        context: path.resolve(__dirname),
        sources: glob.sync(
          path.resolve(__dirname, "src", "img") + "**/*.{jpg,png,svg,jpeg}"
        ),
        destination: path.resolve(__dirname, "dist", "images"),
        fileName: "[name].[ext]",
      },
    }),
    new MiniCssExtractPlugin({
      filename: "../css/app.css",
    }),
  ],
  module: {
    rules: [
      {
        test: /\.(sa|sc|c)ss$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
          },
          {
            loader: "css-loader",
            options: {
              importLoaders: 1,
            },
          },
          {
            loader: "postcss-loader",
            options: {
              postcssOptions: {
                ident: "postcss",
                plugins: [require("tailwindcss")],
              },
            },
          },
          "sass-loader",
        ],
      },
    ],
  },
};
