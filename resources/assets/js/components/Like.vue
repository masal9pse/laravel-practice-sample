<template>
  <div>
    <button v-if="!liked" type="button" class="btn btn-danger" @click="like(songId)">
      <i class="fas fa-heart fa-fw"></i>
      <span>{{ likeCount }}</span>
    </button>
    <button v-else type="button" class="btn btn-primary" @click="unlike(songId)">
      <i class="fas fa-heart fa-fw"></i>
      <span>{{ likeCount }}</span>
    </button>
    <!--<ul v-for="(like,index) in likeArray" :key="index">
      <li>{{ like.song_id }}</li>
    </ul>-->
  </div>
</template>

<script>
export default {
  props: ["songId", "userId", "defaultCount", "defaultLiked"],
  data() {
    return {
      //songId,
      liked: false,
      likeCount: 0,
      likeArray: [],
      getUri: `/api/gets/`
    };
  },
  mounted() {
    this.liked = this.defaultLiked;
    this.likeCount = this.defaultCount;
    this.loadGetAll();
    this.propsCheck();
  },
  methods: {
    like(songId) {
      let uri = `/api/posts/${songId}/like`;
      axios
        .post(uri, {
          user_id: this.userId
        })
        .then(response => {
          this.liked = true;
          this.likeCount = response.data.likeCount;
        })
        .catch(error => {
          alert("いいねを使うにはログインしてください");
          return false;
        });
    },
    unlike(songId) {
      let uri = `/api/posts/${songId}/unlike`;
      axios
        .post(uri, {
          user_id: this.userId
        })
        .then(response => {
          this.liked = false;
          this.likeCount = response.data.likeCount;
        })
        .catch(error => {
          alert("いいねを使うにはログインしてください");
          return false;
        });
    },
    // 出力されない
    propsCheck() {
      console.log(this.songId);
      console.log(this.userId);
      console.log(this.defaultLiked);
      console.log(this.defaultCount);
      //console.log("songId");
    },
    loadGetAll() {
      axios.get(this.getUri + "index").then(response => {
        this.likeArray = response.data;
      });
    }
  }
};
</script>
