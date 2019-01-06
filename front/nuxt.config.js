var webpack = require('webpack') // Do not forget to add this dependency, or else you will get an error

require("dotenv").config()
const axios = require("axios")
const resolve = require("path").resolve

module.exports = {
    modules: [
      '@nuxtjs/apollo',
    "@nuxtjs/axios",
    "@nuxtjs/dotenv",
    "@nuxtjs/font-awesome",
    //"@nuxtjs/google-analytics",
    "@nuxtjs/sitemap",
    "@nuxtjs/pwa",
    "@nuxtjs/moment",
    "@nuxtjs/webpackmonitor",
    "nuxt-device-detect",
    // @TODO enable component cache only in prod
    // ['@nuxtjs/component-cache', {maxAge: 1000 * 60 * 60}],
    /*["@nuxtjs/google-tag-manager", {
        id: process.env.GOOGLE_TAG_MANAGER
    }]*/
  ],
  // Give apollo module options
  apollo: {
    tokenName: 'yourApolloTokenName', // optional, default: apollo-token
    tokenExpires: 10, // optional, default: 7 (days)
    includeNodeModules: true, // optional, default: false (this includes graphql-tag for node_modules folder)
    authenticationType: 'Basic', // optional, default: 'Bearer'
    // optional
    errorHandler(error) {
      console.log('%cError', 'background: red; color: white; padding: 2px 4px; border-radius: 3px; font-weight: bold;', error.message)
    },
    // required
    clientConfigs: {
      default: {
        // required
        httpEndpoint: 'http://local.laravel-vuejs.com/graphql',
        // optional
        // See https://www.apollographql.com/docs/link/links/http.html#options
        httpLinkOptions: {
          credentials: 'same-origin'
        },
        // You can use `wss` for secure connection (recommended in production)
        // Use `null` to disable subscriptions
        wsEndpoint: 'ws://localhost:4000', // optional
        // LocalStorage token
        tokenName: 'apollo-token', // optional
        // Enable Automatic Query persisting with Apollo Engine
        persisting: false, // Optional
        // Use websockets for everything (no HTTP)
        // You need to pass a `wsEndpoint` for this to work
        websocketsOnly: false // Optional
      },
      test: {
        httpEndpoint: 'http://localhost:5000',
        wsEndpoint: 'ws://localhost:5000',
        tokenName: 'apollo-token'
      },
      // alternative: user path to config which returns exact same config options
      // test2: '~/plugins/my-alternative-apollo-config.js'
    }
  },
    sitemap: {
        path: "/sitemap.xml",
        // hostname: 'https://example.com',
        cacheTime: 1000 * 60 * 15,
        gzip: true,
        generate: false, // Enable me when using nuxt generate
        exclude: [
      // '/cms/**'
    ],
        routes() {
            return axios
                .get(process.env.SITE_MAP_URL)
                .then(res => res.data.data.data.map(post => "/" + post.slug))
        }
    },
    /*"google-analytics": {
        id: process.env.GOOGLE_ANALYTICS
    },*/
    axios: {
        baseURL: process.env.API_URL,
        headers: {
            "X-Requested-With": "XMLHttpRequest"
        },
        withCredentials: false
    },
    manifest: {
        name: "Nuxt Demo",
        short_name: "NuxtDemo",
        title: "Nuxt Demo Title",
        "og:title": "Nuxt Demo ogTitle",
        description: "Nuxt Demo  appDescription",
        "og:description": "Nuxt Demo  ogDescription",
        lang: "en",
        theme_color: "#42b883",
        background_color: "#35495e"
    },
    router: {
        middleware: "platform"
    },
    /*
     ** Headers of the page
     */
    head: {
        title: "Nuxt Demo",
        meta: [
            {
                charset: "utf-8"
            },
            {
                name: "viewport",
                content: "width=device-width, initial-scale=1"
            },
            {
                hid: "description",
                name: "description",
                content: "Nuxt.js project"
            }
    ],
        htmlAttrs: {
            dir: "ltr"
        },
        link: [
            {
                rel: "icon",
                type: "image/x-icon",
                href: "/favicon.ico"
            },
    ],
        script: []
    },
    /*
     ** Customize the progress bar color
     */
    loading: {
        color: "#63F9E6"
    },
    // @TODO : custom loading
    //  loading: '~/components/loading.vue'

    /*
     ** Build configuration
     */
    build: {
        plugins: [
            new webpack.LoaderOptionsPlugin({
                options: {
                    stylus: {
                        import: [
                            resolve(__dirname, "./assets/stylus/index.styl"),
                            "~rupture/rupture/index.styl"
                        ]
                    }
                }
            })
        ],
        // vendor: ['vue-i18n'],
        postcss: [require("postcss-rtl")(), require("lost")()],
        extend(config, {
            isDev,
            isClient
        }) {}
    },

    //
    plugins: [
        {
            src: "~/plugins/ui"
        },
        {
            src: "~/plugins/http"
        },
        {
            src: "~/plugins/social-sharing"
        },
        {
            src: "~/plugins/swiper",
            ssr: false
        },
        {
            src: "~/plugins/lazyload",
            ssr: false
        },
        {
            src: '~/plugins/vue-tags-input',
            ssr: false
        }
    ],

    css: [
        "swiper/dist/css/swiper.css",
        "ionicons/dist/css/ionicons.min.css",
        "bootstrap/dist/css/bootstrap.css",
        "~/assets/AvenirNextLTPro.css"
    ],

    // yarn nuxt build --webpackmonitor --analyze
    webpackMonitor: {
        capture: true, // -> default 'true'
        // target: '../monitor/myStatsStore.json', // default -> '../monitor/stats.json'
        launch: true, // -> default 'false'
        port: 3030, // default -> 8081
        excludeSourceMaps: true // default 'true'
    }
}
