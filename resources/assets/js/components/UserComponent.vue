<template>
  <div>
    <input
      type="text"
      v-model="user.keyword"
      placeholder="まだconsoleにしか結果を表示できません"
      class="form-control"
    />
    <button class="btn btn-success" @click="search">検索する（コンソールに結果を表示）</button>
    <p>{{ users.length }}人の一般ユーザーが在籍しています。</p>
    <button @click="createModal" class="btn btn-primary btn-block">ユーザーを追加する</button>

    <table class="table" v-if="users">
      <thead>
        <tr>
          <th scope="col">並び順</th>
          <th scope="col">id</th>
          <th scope="col">名前</th>
          <th scope="col">メールアドレス</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(user,index) in users" :key="index">
          <!--<td>{{ index + 1 }}</td>-->
          <td>{{ index }}</td>
          <td>{{ user.id }}</td>
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>
            <button
              class="btn btn-info"
              @click="updateModal(user.id,user.name,user.email,user.password)"
            >編集する</button>
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
            <!--<div class="form-group">
              <label for="id">id</label>
              <input v-model="user.updateId" type="text" name id="id" class="form-control" />
            </div>-->

            <div class="form-group">
              <label for="name">名前</label>
              <input v-model="user.updateName" type="text" name id="name" class="form-control" />
            </div>

            <div class="form-group">
              <label for="email">メールアドレス</label>
              <input v-model="user.updateEmail" type="text" name id="email" class="form-control" />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
            <!-- 　ここをアップデートしている配列のインデックスを取得できるようにしたい -->
            <button @click="updateUser(0)" type="button" class="btn btn-primary">編集する</button>
            <!--<button @click="updateUser(users[index])" type="button" class="btn btn-primary">編集する</button>-->
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
        id: "",
        name: "",
        email: "",
        password: "",
        updateId: "",
        updateName: "",
        updateEmail: "",
        updatePassword: "",
        keyword: ""
      },
      users: [],
      uri: "/api/user",
      errors: []
    };
  },
  created() {
    this.loadUsers();
  },
  methods: {
    search() {
      axios.get(this.uri + "?name=" + this.user.keyword).then(response => {
        //console.log(response);
        console.log(response.data.users);
        //console.log(response.data.users[0].name);
      });
    },
    createModal() {
      $("#create-modal").modal("show");
    },
    updateModal(id, name, email, password) {
      $("#update-modal").modal("show");
      console.log(password);
      //this.message = "";
      this.user.updateId = id;
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
    updateUser(index) {
      axios
        .put(this.uri + "/" + this.user.updateId, {
          name: this.user.updateName,
          email: this.user.updateEmail,
          password: this.user.updatePassword
        })
        .then(response => {
          console.log(this.users);
          console.log(Object.keys(this.users));
          //this.users[index].id = this.user.updateId;
          this.users[index].id = 17;
          this.users[index].name = this.user.updateName;
          console.log(this.users[index]);
          $("#update-modal").modal("hide");
        })
        .catch(error => {
          console.log(error);
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
        //console.log(response);
        //console.log(response.data.users[1].songs[0].title); // songsTableの一番目を取得
        this.users = response.data.users;
        //console.log(this.users.length);
      });
    }
  }
};
</script>