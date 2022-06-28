<template>
    <main>
        <router-view></router-view>
    </main>
</template>

<script>
export default {
    name: 'MainComponent',
    data(){
        return {
            posts:[],
        }
    },
}
</script>

<style lang="scss" scoped>
    h1{
        color: #117AC9;
        font-size: 70px;
    }
    main{
        padding-left: 10px;
    }
    ul{
        list-style-type: none;
    }
</style>