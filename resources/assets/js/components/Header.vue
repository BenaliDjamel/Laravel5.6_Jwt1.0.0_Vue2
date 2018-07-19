<template>
<nav class="navbar navbar-expand-md navbar-light navbar-laravel pb-4">
            <div class="container">
                <router-link to='/' >Laravel</router-link>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                   

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <div class="ml-3" v-if="userLoggedIn"  ><router-link to='/users' >Users</router-link></div>
                            <div class="ml-3" v-if="!userLoggedIn"  ><router-link to='/register' >Register</router-link></div>
                           <div class="ml-3" v-if="!userLoggedIn"  ><router-link to='/login' >Login</router-link></div>
                           <div class="ml-3" v-else  ><a href="/logout" @click.prevent="logout">Logout</a></div>
                            
                    </ul>
                </div>
            </div>
        </nav>
</template>

<script>
export default {
  mounted() {
    console.log("header");
  },

  methods: {
      logout() {
          this.$store.commit('logout');
          this.$router.push('/login');
      }
  },
  computed: {
    userLoggedIn() {
      return this.$store.getters.currentUser;
    }
  }
};
</script>

<style>
</style>
