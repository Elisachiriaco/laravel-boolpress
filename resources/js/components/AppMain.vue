<template>
    <section>
        <h1>{{titolo}}</h1>
    </section>
</template>

<script>
export default {
    name: 'AppMain',
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