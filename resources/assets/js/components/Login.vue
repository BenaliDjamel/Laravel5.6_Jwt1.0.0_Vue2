<template>
    <div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login</div>

                <div class="card-body">
                    <form  @submit.prevent="authenticate">
                        
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" v-model="form.email" class="form-control" >

                              
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password"  v-model="form.password" class="form-control" >

                               
                            </div>
                        </div>

                       

                        <div class="form-group row mb-0" >
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Login
                                </button>

                               
                            </div>
                        </div>

                        <div v-if="errors">
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
import {login} from './../helpers/auth'
export default {
  data() {
      return {
         form: {
               email:'',
               password:''
         },
         
      }
  },
  methods: {
     
       
            authenticate() {
                login(this.$data.form)
                  .then(res => {
                      console.log(res);
                      
                      this.$store.commit('loginSuccess', res);
                      this.$router.push('/users');
                  }).catch(err => this.$store.commit('authError', err))
            }
         
     
  },
  computed: {
     errors() {
          return  this.$store.getters.authErrors;
     }
  }



}
</script>

<style>

</style>
