<template>
<div class="container">
    <table class="table table-bordered  mt-5">
  <thead class="">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="user in users"  :key="user.id">
      <th scope="row">{{user.id}}</th>
      <td>{{user.name}}</td>
      <td>{{user.email}}</td>
      <td>
          <a   class="btn btn-danger" 
           
           :href="'/users/delete/user/'+user.id"
            @click.prevent="del(user.id)">delete</a>
         <router-link class="btn btn-success" :to="`/users/update/user/${user.id}`">Edit</router-link>
      </td>
    </tr>
   
  </tbody>
</table>
</div>
</template>

<script>
export default {
  mounted() {
    if (this.users) {
      console.log("exist");

      return;
    }
    axios
      .get("/api/users")
      .then(response => {
        this.$store.commit("setUsers", response.data.users);
      })
      .catch(err => console.log(err));
  },
  methods: {
    del(id) {
      this.$store.dispatch("deleteUser", id);
    }
  },

  computed: {
    users() {
      return this.$store.getters.getUsers;
    },
    currentUser() {
      return this.$store.getters.currentUser;
    }
  }
};
</script>

<style scoped>
.a {
  display: inline-block;
}
</style>
