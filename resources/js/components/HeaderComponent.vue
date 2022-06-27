<template>
    <header>
        <li><a href="/">Home</a></li>
        <li><a href="/admin">Area riservata</a></li>
    </header>
</template>

<script>
export default {
    name: 'HeaderComponent',
    data(){
        return {
            'titolo': 'Boolpress'
        }
    },
}
</script>

<style lang="scss" scoped>
    h1{
        color: #117AC9;
        font-size: 70px;
    }
</style>