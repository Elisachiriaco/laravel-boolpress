<template>
    <div class="title">
        <app-main/>
    </div>
</template>

<script>
import AppMain from '../components/AppMain'
export default {
    name: 'App',
    components: {
        AppMain
    },
}
</script>

<style lang="scss" scoped>
.title{
    height: calc(100% - 80px);
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    text-align: center;
}
</style>