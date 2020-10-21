<template>
  <div>
    {{ users.length }}人の一般ユーザーが在籍しています。
    <button
      @click="createModal"
      class="btn btn-primary btn-block"
    >ユーザーを追加する</button>

    <table class="table" v-if="users">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">名前</th>
          <th scope="col">メールアドレス</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(user,index) in users" :key="index">
          <!--<td>{{ user.id }}</td>-->
          <td>{{ index + 1 }}</td>
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>
            <button
              class="btn btn-info"
              @click="updateModal(user.name,user.email,user.password)"
            >詳細を見る</button>
          </td>
          <td>
            <button class="btn btn-danger" @click="deleteUser(user.id,index)">削除</button>
          </td>
        </tr>
      </tbody>
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
            <h5 class="modal-title text-danger" id="exampleModalLabel">非同期ユーザー追加リスト</h5>
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
              <label for="name">名前</label>
              <input v-model="user.name" type="text" name id="name" class="form-control" />
            </div>

            <div class="form-group">
              <label for="email">メール</label>
              <input v-model="user.email" type="text" name id="email" class="form-control" />
            </div>

            <div class="form-group">
              <label for="password">パスワード</label>
              <input v-model="user.password" type="text" name id="password" class="form-control" />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
            <button @click="createUser" type="button" class="btn btn-primary">登録する</button>
          </div>
        </div>
      </div>
    </div>

    <!-- update modal -->
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
            <h5 class="modal-title" id="exampleModalLabel">非同期ユーザー編集リスト</h5>
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
              <label for="name">名前</label>
              <input v-model="user.updateName" type="text" name id="name" class="form-control" />
              <!--<input v-model="user.name" type="text" name id="name" class="form-control" />-->
            </div>

            <div class="form-group">
              <label for="email">メールアドレス</label>
              <input v-model="user.updateEmail" type="text" name id="email" class="form-control" />
            </div>

            <div class="form-group">
              <label for="password">パスワード</label>
              <input
                v-model="user.updatePassword"
                type="text"
                name
                id="password"
                class="form-control"
              />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
            <!--<button @click="createUser" type="button" class="btn btn-primary">保存する</button>-->
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
      user: {
        name: "",
        email: "",
        password: "",
        updateName: "",
        updateEmail: "",
        updatePassword: ""
      },
      users: [],
      uri: "/user",
      errors: []
    };
  },
  methods: {
    createModal() {
      $("#create-modal").modal("show");
    },
    updateModal(name, email, password) {
      $("#update-modal").modal("show");
      //let this = self;
      //console.log(name);
      console.log(password);
      //this.message = "";
      this.user.updateName = name;
      this.user.updateEmail = email;
      this.user.updatePassword = password;
    },
    createUser() {
      axios
        .post(this.uri, {
          name: this.user.name,
          email: this.user.email,
          password: this.user.password
        })
        .then(response => {
          console.log(response);
          console.log(response.data.user.password);
          this.users.push(response.data.user);
          $("#create-modal").modal("hide");
        })
        .catch(error => {
          this.errors = [];
          if (error.response.data.errors.name) {
            this.errors.push(error.response.data.errors.name[0]);
          }

          if (error.response.data.errors.email) {
            this.errors.push(error.response.data.errors.email[0]);
          }

          if (error.response.data.errors.password) {
            this.errors.push(error.response.data.errors.password[0]);
          }
        });
    },
    deleteUser(id, index) {
      if (confirm("削除しますか？")) {
        axios
          .delete(this.uri + "/" + id)
          .then(response => {
            console.log(response);
            this.users.splice(index, 1); // この行をコメントアウトしてもサーバー側では削除される
          })
          .catch(error => {
            console.log(error);
          });
      }
    },
    loadUsers() {
      axios.get(this.uri).then(response => {
        console.log(response);
        console.log(response.data.users[2].songs[0].title); // songsTableの一番目を取得
        this.users = response.data.users;
        console.log(this.users.length);
      });
    }
  },
  created() {
    this.loadUsers();
    //console.log(this.loadUsers);
  }
};
</script>