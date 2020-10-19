<template>
  <div>
    <button @click="createModal" class="btn btn-primary btn-block">Add New Task</button>

    <table class="table" v-if="books">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">title</th>
          <th scope="col">author</th>
        </tr>
      </thead>
    </table>
    <!-- create-modal -->
    <div
      class="modal fade"
      id="create-modal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create Modal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="alert alert-danger" v-if="errors.length > 0">
              <ul>
                <li v-for="error in errors" :key="error">{{ error }}</li>
              </ul>
            </div>
            <div class="form-group">
              <label for="title">title</label>
              <input v-model="book.title" type="text" name id="title" class="form-control" />
            </div>

            <div class="form-group">
              <label for="author">author</label>
              <input v-model="book.author" type="text" name id="author" class="form-control" />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button @click="createUser" type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      book: {
        song_id: 1,
        title: "",
        author: "",
        description: "aaa",
        thumbnail: "test"
      },
      books: [],
      uri: process.env.MIX_VUE_APP_BOOK_URL,
      errors: []
    };
  },
  methods: {
    createModal() {
      $("#create-modal").modal("show");
    },
    createUser() {
      axios
        .post(this.uri, {
          song_id: this.book.song_id,
          title: this.book.title,
          author: this.book.author,
          description: this.book.description,
          thumbnail: this.book.thumbnail
        })
        .then(response => {
          this.books.push(response.data.book);
          $("#create-modal").modal("hide");
        })
        .catch(error => {
          this.errors = [];
          if (error.response.data.errors.title) {
            this.errors.push(error.response.data.errors.title[0]);
          }

          if (error.response.data.errors.author) {
            this.errors.push(error.response.data.errors.author[0]);
          }

          if (error.response.data.errors.password) {
            this.errors.push(error.response.data.errors.password[0]);
          }
        });
    }
  }
};
</script>