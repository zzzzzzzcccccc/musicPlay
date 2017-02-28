<template>
  <div class="mv-box">
     当前Mvid为：{{ mvid == 0 ? '这个音乐没有mv' : mvid }}
  </div>
</template>

<script>
export default {
  name: 'mv',
  data () {
    return {
      mvid: ''
    }
  },
  beforeCreate () {
    console.log('loading')
  },
  created: function () {
    this.Load()
  },
  methods: {
    Load () {
      this.mvid = this.$route.path.split('=')[1]
      console.log(this.mvid)
    }
  }
}
</script>
