<template>
  <div>
    <button class="btn btn-primary btn-block">Add New Task</button>

    <table class="table" v-if="users">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">Name</th>
          <th scope="col">Body</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(user,index) in users" :key="index">
          <td>{{ index+1 }}</td>
          <!-- <td>{{ task.id }}</td> -->
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>
            <button class="btn btn-info">Edit</button>
          </td>
          <td>
            <button class="btn btn-danger">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>


<script>
export default {
  data() {
    return {
      user: {
        name: "",
        email: ""
      },
      users: [],
      uri: "http://localhost:8000/user"
    };
  },
  methods: {
    loadTasks() {
      axios.get(this.uri).then(response => {
        this.users = response.data.users;
      });
    }
  },
  mounted() {
    this.loadTasks();
    console.log(this.loadTasks);
  }
};
</script>