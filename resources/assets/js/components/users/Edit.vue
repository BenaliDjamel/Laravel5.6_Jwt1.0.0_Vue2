<template>
    <div class="container">
         <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update User</div>

                <div class="card-body">
                    <form  @submit.prevent="updateUser">
                     

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" v-model="user.name"  >

                           
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control"  v-model="user.email" >

                              
                            </div>
                        </div>

                       

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Update
                                </button>
                            </div>
                        </div>

                        <div>
                           
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
export default {
  mounted() {
    console.log("edit");
  },
  data() {
    return {
        user:''
    };
  },

  created() {

      if(this.users) {
          this.user = this.users.find(user => user.id === Number(this.$route.params.id));
            console.log(this.user);
      } else {
          axios.get(`/api/users/user/${this.$route.params.id}`)
                    .then((response) => {
                        console.log(response);
                        
                        this.user = response.data.user
                    }).catch(err => console.log(err));
      }

  },
  methods:{
      updateUser() {
          console.log('update');
           axios.post(`/api/users/update/user/${this.$route.params.id}`,this.user)
                    .then((response) => {
                      this.$router.push('/users')
                    }).catch(err => console.log(err));
      }
  },

  computed :{
      users() {
          return this.$store.getters.getUsers;
      }
  }
};
</script>

<style>
</style>
