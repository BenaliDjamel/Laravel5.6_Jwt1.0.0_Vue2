<template>
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register</div>

                <div class="card-body">
                    <form  @submit.prevent="registerUser">
                     

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" v-model="form.name"  >

                           
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" v-model="form.email" >

                              
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" v-model="form.password">

                               
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Register
                                </button>
                            </div>
                        </div>

                        <div>
                            {{errors}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import { register } from "./../helpers/auth";
export default {
  mounted() {
    console.log("register mounted.");
  },

  data() {
    return {
      form: {
        name: "",
        email: "",
        password: ""
      }
    };
  },

  methods: {
    registerUser() {
      register(this.$data.form)
        .then(response => {
          console.log(response);
         this.$store.commit('addUser', response.user)
          
        })
        .catch(err => this.$store.commit('RegisterError', err))
        .then(()=> this.$router.push('/login'));
    },
   
  },
   computed: {
      errors() {
        return this.$store.getters.RegisterErrors;
      }
    }
};
</script>
