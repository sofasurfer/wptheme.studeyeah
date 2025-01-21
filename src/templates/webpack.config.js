import path from 'path';
import fs from 'fs';
import HtmlWebpackPlugin from 'html-webpack-plugin';
import MiniCssExtractPlugin from 'mini-css-extract-plugin';
import WebpackBar from 'webpackbar';
import createFontFile from '../bud/createFontFile.mjs';

const devMode = process.env.WEBPACK_SERVE ?? false;

let htmlPageNames = [];
let entryPoints = {};

createFontFile('../fonts/');

// get all files in the ./html directory and write the filenames into an array
fs.readdirSync('./html').forEach(file => {
    if (file.split('.')[1] !== 'html') return;

    htmlPageNames.push(file.split('.')[0]);
})

/**
 * Creates a new entry for each page provided in htmlPageNames
 */
let multipleHtmlPlugins = htmlPageNames.map(name => {
    return new HtmlWebpackPlugin({
        template: `./html/${name}.html`, // relative path to the HTML files
        filename: `${name}.html`, // output HTML files
        chunks: [`${name}`] // respective JS files
    })
});

/**
 * Example output
 * entry: {
 *         index: './index.js',
 *         teaser: './index.js',
 *     }
 *
 * Using the same JS file for both pages
 */
htmlPageNames.map(name => {
    entryPoints = {...entryPoints, [name]: './index.js'};
});

export default {
    mode: 'development',
    entry: entryPoints,
    // not meant for production
    devtool: 'inline-source-map',
    // https://webpack.js.org/configuration/dev-server/#devserverdevmiddleware
    devServer: {
        static: ['./dist', './html'],
        open: true,
        devMiddleware: {
            index: true,
            writeToDisk: true,
        },
    },
    plugins: [
        new WebpackBar({
            name: 'neofluxe webpack',
            color: '#00D4B4'
        }),
        new MiniCssExtractPlugin()
    ].concat(multipleHtmlPlugins),
    output: {
        assetModuleFilename: "[name]_[hash:4][ext]",
        filename: '[name].js',
        path: path.resolve('dist'),
        clean: true,
    },
    module: {
        rules: [
            {
                test: /\.s[ac]ss$/i,
                use: [
                    // Creates `style` nodes from JS strings with "style-loader"
                    devMode ? "style-loader" : MiniCssExtractPlugin.loader,
                    // Translates CSS into CommonJS
                    "css-loader",
                    {
                        // Rewrites URLs
                        loader: 'resolve-url-loader',
                        options: {}
                    },
                    {
                        // Compiles Sass to CSS
                        loader: 'sass-loader',
                        options: {
                            sourceMap: true, // <-- !!IMPORTANT!!
                        }
                    },
                ],
            },
            // {
            //     test: /\.(png|svg|jpg|jpeg|gif)$/i,
            //     exclude: /node_modules/,
            //     use: [
            //         {
            //             loader: 'url-loader',
            //             options: {
            //                 limit: 1000,
            //                 name : '/images/[name].[ext]'
            //             }
            //         }
            //     ]
            // },
            {
                test: /\.html$/i,
                loader: "html-loader",
                options: {},
            },
        ],
    },
    optimization: {
        runtimeChunk: 'single',
    },
};
