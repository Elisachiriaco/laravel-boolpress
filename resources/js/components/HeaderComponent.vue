<template>
    <header>
        <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <div v-for="(item, index) in menuItem" :key="index">
                    <router-link :to="{ name: item.routeName} " class="navbar-brand">{{item.label}}</router-link>
                </div>
                <li class="reserved"><a href="/admin">Area riservata</a></li>
            </ul>
            </div>
        </div>
        </nav>
    </header>
</template>

<script>
export default {
    name: 'HeaderComponent',
    data(){
        return {
        menuItem: [
        {
            label: 'Home',
            routeName: 'home'
        },
        {
            label: 'Posts',
            routeName: 'posts'
        },
        {
            label: 'Chi Siamo',
            routeName: 'about'
        },
        {
            label: 'Contatti',
            routeName: 'contact',
        }
        ],
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

    .router-link-active{
        border-bottom: 2px solid #117AC9;
    }

    .reserved{
        position: fixed;
        top: 15px;
        right: 10px;
    }
</style>