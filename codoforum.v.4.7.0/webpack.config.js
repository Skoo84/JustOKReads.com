const path = require('path');

module.exports = {
  mode: 'production',
  entry: './sites/default/plugins/codopm/jsApp/index.js',
  output: {
    path: path.resolve(__dirname, 'sites/default/plugins/codopm/jsApp'),
    filename: 'codopm-out.js'
  },

  module: {
  rules: [{
    test: /\.js$/,
    exclude: /node_modules/,
    loader: 'babel-loader'
  }]
}

// devtool: 'inline-cheap-source-map',
};