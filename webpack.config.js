const path = require("path");

module.exports = {
    entry: "/public/js/index.js",
    output: {
        path: path.join(__dirname, "/public/dist"),
        filename: "main.js"
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: "babel-loader"
                },
            },
            {
                test: /\.css$/,
                use: ["style-loader", "css-loader"]
            }
        ]
    },
    devtool: 'source-map'
};