<template>
  <div class="search-box" :style="win">
    <el-input placeholder="输入歌手/歌名/歌词" icon="search" v-model="searchMusicVal"></el-input>
    <ul class="search-box-list" v-if="search_show" v-loading.body="playLoading">
      <li v-for="item in search" v-bind:id="item.id">
         <div class="name">{{ item.name }}</div>
         <div class="artists">
           歌手：{{ item.artists[0].name }} <span v-on:click.stop="searchAlbum(item.album.id,item.album.name)"  @click="dialogTableVisible = true">专辑：{{item.album.name}} <i class="el-icon-menu"></i></span>
         </div>
         <el-button type="primary" v-on:click.stop="playMusic(item.id)">播放</el-button>
         <a v-bind:href="'http://music.163.com/#/mv?id='+item.mvid">
            <el-button>Mv</el-button>
         </a>
      </li>
    </ul>

    <div class="playlist" v-loading.body="hidden">
       <h4 v-bind:id="playlistId">{{ playlistName }}</h4>
       <ul>
         <li v-for="item in playlist">
           <div class="name">{{ item.name }}</div>
           <div class="artists">
             歌手：{{ item.album.artists[0].name }} <span @click="dialogTableVisible = true" v-on:click.stop="searchAlbum(item.album.id,item.album.name)">专辑：{{ item.album.name }} <i class="el-icon-menu"></i></span>
           </div>
           <el-button type="primary" v-on:click.stop="playMusic(item.id)">播放</el-button>
           <a v-bind:href="'http://music.163.com/#/mv?id='+item.mvid">
             <el-button>Mv</el-button>
           </a>
         </li>
       </ul>
    </div>
        <div v-if="radio_show" class="play-box">
          <div class="play-info">
             <img v-bind:src="mp3.mp3bg" /><el-button type="primary">{{ mp3.mp3name }}</el-button>
          </div>
          <audio controls="controls" v-bind:src="mp3.mp3url" autoplay="autoplay"></audio>
        </div>

    <el-dialog v-model="dialogTableVisible" class="album-dialog" size="large" v-bind:title="albumName" v-loading.body="playLoading">
       <div class="album-info">
         <div class="album-bg"><img v-bind:src="albumBg"></div>
           <ul>
               <li v-for="item in album">
                   <el-button v-on:click.stop="playMusic(item.id)">{{ item.name }}</el-button>
               </li>
           </ul>
       </div>
    </el-dialog>
  </div>
</template>

<script>
export default {
  name: 'hello',
  data () {
    return {
      playLoading: false,
      search: [],
      searchMusicVal: '',
      search_show: false,
      radio_show: false,
      dialogTableVisible: false,
      mp3: [],
      album: [],
      albumName: '',
      albumBg: '',
      playlist: [],
      playlistName: '',
      playlistId: '',
      hidden: false,
      win: {
        height: ''
      }
    }
  },
  created: function () {
    this.playlistajax()
    this.win.height = window.innerHeight + 'px'
  },
  watch: {
    searchMusicVal: function (val) {
      var that = this
      if (val === '') {
        return false
      }
      setTimeout(function () {
        that.$http.jsonp('http://www.bechina.org/e/publics/data/musicapi.php', {
          params: {
            search: val,
            limit: 100
          }
        }).then((res) => {
          that.search = res.data.result.songs
          that.search_show = true
        })
      }, 500)
    }
  },
  methods: {
    playMusic (id) {
      this.playLoading = true
      this.$http.jsonp('http://www.bechina.org/e/publics/data/play.php', {
        params: {
          id: id
        }
      }).then((res) => {
        this.playLoading = false
        this.radio_show = true
        this.mp3 = res.data
      })
    },
    searchAlbum (id, name) {
      this.albumName = name
      this.$http.jsonp('http://www.bechina.org/e/publics/data/album.php', {
        params: {
          id: id
        }
      }).then((res) => {
        this.album = res.data.result
        this.albumBg = res.data.result[0].album.blurPicUrl
      })
    },
    playlistajax () {
      this.hidden = true
      this.$http.jsonp('http://www.bechina.org/e/publics/data/playlist.php', {
        params: {
          id: 320201522
        }
      }).then((res) => {
        this.playlist = res.data.result
        this.playlistName = res.data.name
        this.playlistId = res.data.id
        this.hidden = false
      })
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.blue{color:#20a0ff;}
.search-box{width:90%;display:flex;flex-direction: column;justify-content:space-around;margin:0 auto;}
.search-box-list{overflow: auto;border-radius: 0.2rem;border:1px solid #20a0ff;margin:0.5rem auto;width:98%;height:11rem;}
.search-box-list li{width:90%;margin:0 auto;position: relative;border-bottom: 1px dashed #999;padding-bottom:0.3rem;}
.search-box-list li:last-child{border-bottom:0;}
.search-box .artists{color:#666;}
.play-box{width:98%;margin:0 auto;border:1px solid #20a0ff;border-radius: 0.2rem;}
.play-box .play-info{width:100%;height:2.5rem;position:relative;}
.play-box .play-info img{width:2.5rem;height:2.5rem;border-radius:0.1rem;position: absolute;left:1rem;top:0;}
.play-box .play-info button{position: absolute;right:1rem;top:0.1rem;}
.play-box audio{width:100%;}
.album-bg{width:5rem;height:5rem;}
.album-bg img{widht:100%;height:100%;}
.album-info{height:15rem;overflow: auto;}
.playlist{overflow: auto;border-radius: 0.2rem;border:1px solid #20a0ff;margin:0.5rem auto;width:98%;height:11rem;}
.playlist li{width:90%;margin:0 auto;position: relative;border-bottom: 1px dashed #999;padding-bottom:0.3rem;}
.playlist li:last-child{border-bottom:0;}
</style>
