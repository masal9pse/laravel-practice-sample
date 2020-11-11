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
    <ul v-for="(like,index) in likeArray" :key="index">
      <li>{{ like.song_id }}</li>
    </ul>
  </div>
</template>

<script>
export default {
  props: ["songId", "userId", "defaultLiked", "defaultCount"],
  data() {
    return {
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

    loadGetAll() {
      axios.get(this.getUri + "index").then(response => {
        this.likeArray = response.data;
        //this.loading = true;
        console.log(response);
        //console.log(response.data[0]);
        console.log(this.likeArray);
      });
    }
  }
};
</script>
