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
  </div>
</template>

<script>
export default {
  props: ["songId", "userId", "defaultLiked", "defaultCount"],
  data() {
    return {
      liked: false,
      likeCount: 0
    };
  },
  created() {
    this.liked = this.defaultLiked;
    this.likeCount = this.defaultCount;
  },
  methods: {
    like(songId) {
      let url = `/api/posts/${songId}/like`;
      axios
        .post(url, {
          user_id: this.userId
        })
        .then(response => {
          this.liked = true;
          this.likeCount = response.data.likeCount;
        })
        .catch(error => {
          alert(error);
        });
    },
    unlike(songId) {
      let url = `/api/posts/${songId}/unlike`;
      axios
        .post(url, {
          user_id: this.userId
        })
        .then(response => {
          this.liked = false;
          this.likeCount = response.data.likeCount;
        })
        .catch(error => {
          alert(error);
        });
    }
  }
};
</script>
