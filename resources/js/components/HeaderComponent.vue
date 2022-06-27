<template>
    <header>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/admin">Area riservata</a></li>
        </ul>
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
    ul{
        list-style-type: none;
        display: flex;
        font-size: 15px;
        li{
            padding-right: 20px;
        }
    }
</style>