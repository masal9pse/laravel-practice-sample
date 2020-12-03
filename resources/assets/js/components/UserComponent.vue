<template>
  <div>
    <div v-if="!loading">
      <!--<img class="rounded mx-auto d-block" :src="image" alt="loader" />-->
      <img class="rounded mx-auto d-block" :src="'/public_images/loader1.gif'" alt="loader" />
      <!--<img :src="image" alt="loader" />-->
    </div>

    <div v-else>
      <button @click="loadCreateModal" class="btn btn-primary btn-block">ユーザーを追加</button>
      <table class="table" v-if="users">
        <thead>
          <tr>
            <th>並び順</th>
            <th>id</th>
            <th>名前</th>
            <th>メールアドレス</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(user, index) in users" :key="index">
            <td>{{index + 1}}</td>
            <td>{{ user.id }}</td>
            <td>{{user.name}}</td>
            <td>{{user.email}}</td>
            <td>
              <button @click="loadUpdateModal(index)" class="btn btn-info">Edit</button>
            </td>
            <td>
              <button @click="deleteTask(index)" class="btn btn-danger">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>

      <!-- Create Modal -->
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
              <h5 class="modal-title" id="exampleModalLabel">新規投稿</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-email">
              <div class="alert alert-danger" v-if="errors.length > 0">
                <ul>
                  <li v-for="(error,index) in errors" :key="index">{{error}}</li>
                </ul>
              </div>

              <div class="form-group">
                <label for="name">名前</label>
                <input v-model="user.name" type="text" id="name" class="form-control" />
              </div>

              <div class="form-group">
                <label for="description">メールアドレス</label>
                <input v-model="user.email" type="text" id="description" class="form-control" />
              </div>

              <div class="form-group">
                <label for="password">パスワード</label>
                <input v-model="user.password" type="text" name id="password" class="form-control" />
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button @click="createTask" type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>

      <!-- update Modal -->
      <div
        class="modal fade"
        id="update-modal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">更新画面</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-email">
              <div class="alert alert-danger" v-if="errors.length > 0">
                <ul>
                  <li v-for="error in errors" :key="error">{{error}}</li>
                </ul>
              </div>

              <div class="form-group">
                <label for="name">Name</label>
                <input v-model="new_update_user.name" type="text" id="name" class="form-control" />
              </div>

              <div class="form-group">
                <label for="description">メールアドレス</label>
                <input
                  v-model="new_update_user.email"
                  type="text"
                  id="description"
                  class="form-control"
                />
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button @click="updateTask" type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import toastr from "toastr";
export default {
  data() {
    return {
      user: {
        name: "",
        email: "",
        password: ""
      },
      users: [],
      uri: "/api/user/",
      errors: [],
      // 更新の答え、更新用の配列をつくる
      new_update_user: [],
      image: "public_images/loader1.gif",
      loading: false,
      toastr: (toastr.options = { positionClass: "toast-top-full-width" })
    };
  },

  methods: {
    loadCreateModal() {
      $("#create-modal").modal("show");
    },

    loadUpdateModal(index) {
      this.errors = [];
      $("#update-modal").modal("show");
      this.new_update_user = this.users[index];
      console.log(this.new_update_user);
    },

    createTask() {
      axios
        .post(this.uri, {
          name: this.user.name,
          email: this.user.email,
          password: this.user.password
        })

        .then(response => {
          this.users.push(response.data.user);

          this.resetData();
          $("#create-modal").modal("hide");

          toastr.success(response.data.message);
        })

        .catch(error => {
          this.errors = [];

          if (error.response.data.errors.name) {
            this.errors.push(error.response.data.errors.name[0]);
          }

          if (error.response.data.errors.email) {
            this.errors.push(error.response.data.errors.email[0]);
          }
        });
    },
    updateTask() {
      axios
        .patch(this.uri + this.new_update_user.id, {
          name: this.new_update_user.name,
          email: this.new_update_user.email
        })
        .then(response => {
          $("#update-modal").modal("hide");
          toastr.success(response.data.message);
        })
        .catch(error => {
          if (error.response.data.errors.name) {
            this.errors.push(error.response.data.errors.name[0]);
          }

          if (error.response.data.errors.email) {
            this.errors.push(error.response.data.errors.email[0]);
          }
        });
    },

    deleteTask(index) {
      let confirmBox = confirm("削除しますか?");

      if (confirmBox == true) {
        axios
          .delete(this.uri + this.users[index].id)
          .then(response => {
            this.$delete(this.users, index);
            toastr.success(response.data.message);
          })
          .catch(error => {
            console.log("削除できませんでした");
          });
      }
    },
    // try,catchはrequireではない
    async useAsyncUserList(url) {
      try {
        const response = await axios.get(url);
        console.log(await response.data);
      } catch (err) {
        console.log("fetch failed", err);
      }
    },
    loadTasks() {
      axios.get(this.uri).then(response => {
        this.users = response.data.users;
        this.loading = true;
      });
    },

    resetData() {
      this.user.name = "";
      this.user.email = "";
      this.user.password = "";
    }
  },

  mounted() {
    this.loadTasks();
    this.useAsyncUserList(this.uri);
  }
};
</script>
