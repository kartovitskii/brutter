## README
This repository for site of «Brutter.ru»

## Base commands
npm install     // install dependencies
npm run dev     // development mode build
npm run build   // production mode build


## Structure
app/                        # project folder 
|-fonts                     # 
|-images/                   #
    |-img/
    |-svg/
|-js/                       #
|-static/                   # static files (favicon, robots & ets.)
    |-favicon.png
|-styles/                   #
    |-css/
    |-scss/
        |-modules/
        |-utils/
        |-main.scss
|-templates/                # 
    |-base/                 # templates for pages
        |-assets.twig
        |-meta.twig
        |-template.twig
    |-components/           # Vue components
    |-modules/              # blocks layouts
        |-header.twig
        |-hooter.twig
    |-pages/                # pages layouts
        |-index.twig
|-index.js                  # main project config
conf/                       # webpack config files
|-postcss.config.js
|-webpack.base.conf.js
|-webpack.build.conf.js
|-webpack.dev.conf.js
.babelrc                    # babel config
package.json                # build scripts and dependencies
package-lock.json
.gitignore