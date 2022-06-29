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

<style lang="scss">
section{
    padding-top: 90px;
}
</style>