
e# musicPlay

> A Vue.js project

## Build Setup

``` bash
# install dependencies
npm install

# serve with hot reload at localhost:8080
npm run dev

# build for production with minification
npm run build

# build for production and view the bundle analyzer report
npm run build --report

# run unit tests
npm run unit

# run e2e tests
npm run e2e

# run all tests
npm test
```

For detailed explanation on how things work, checkout the [guide](http://vuejs-templates.github.io/webpack/) and [docs for vue-loader](http://vuejs.github.io/vue-loader).
使用了网易云的api是百度的moon大神的服务器端解析部分api可能不能使用了下面上项目截图
个人歌单可以修改src里面的hello.vue来输入自己的playlistid 就能默认载入自己的网易云歌单了

mv由于网易云经过非常严格的加密 故只获取到了每首音乐的mvid来链接到网易云的mv页面了  项目地址:http://www.bechina.org/e/publics/#/
