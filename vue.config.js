const path = require('path');
const webpack = require('webpack');
module.exports = {
    resolve: {
        extensions: ['.js', '.vue', '.json'],
        alias: {
            vue$: 'vue/dist/vue.esm.js',
            '@': path.join(__dirname, '/resources/js'),
        },
        fallback: {
            path: require.resolve('path-browserify'),
            crypto: require.resolve('crypto-browserify'),
            stream: require.resolve('stream-browserify'),
            assert: require.resolve('assert'),
            http: require.resolve('stream-http'),
            https: require.resolve('https-browserify'),
            url: require.resolve('url'),
            vm: require.resolve('vm-browserify'), // Add this line for vm
        },  
     
    }  
}

