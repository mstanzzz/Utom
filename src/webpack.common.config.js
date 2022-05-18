const path = require('path');

const webpack = require('webpack');

module.exports = {
  entry: {
    app: './src/app.js'
  },
  plugins: [
    new webpack.ProvidePlugin({
      $: 'jquery',
      jQuery: 'jquery',
      "window.$": "jquery",
      "window.jQuery": "jquery",
    }),
  ],
  module: {
    rules: [
      {
        test: /\.html$/i,
        loader: 'html-loader',
      },
      {
        test: /\.(svg|png|jpg|gif|jpeg)$/i,
        use: {
          loader: 'file-loader',
          options: {
            name: "[name].[ext]",
            include: path.join(__dirname, 'src'),
            outputPath: 'images'
          }
        }
      },
      {
        test: /\.js$/,
        exclude: '/node_modules/',
        use: {
          loader: 'babel-loader',
          options: {
            presets: ["@babel/env"],
            plugins: ['transform-class-properties']
          },
        }
      },
      {
        test: /\.(ttf|woff|woff2)$/i,
        use: {
          loader: 'file-loader',
          options: {
            name: "[name].[ext]",
            outputPath: 'fonts/'
          }
        }
      },
    ],
  }
}
