<template>
    <div class="title">
        <header-component />
        <main-component />
        <footer-component />
    </div>
</template>

<script>
import HeaderComponent from '../components/HeaderComponent';
import MainComponent from '../components/MainComponent';
import FooterComponent from '../components/FooterComponent';

export default {
    name: 'App',
    components: {
        HeaderComponent,
        MainComponent,
        FooterComponent
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