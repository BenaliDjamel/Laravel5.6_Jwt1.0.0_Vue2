<template>
<div>
    <Header/>
    <router-view></router-view>
</div>
</template>

<script>
import Header from './Header.vue';
export default {
    name:'main-app',
    components: {
        Header
    },
mounted() {
    console.log('Main');
    
}
}
</script>

<style>

</style>
