<template>
    <header>
        <nav>
            <h1>Boolpress</h1>
            <ul>
                <div v-for="(item, index) in menuItem" :key="index" class="pl-5">
                    <router-link :to="{ name: item.routeName} " class="link">{{item.label}}</router-link>
                </div>
                <li class="link pl-5"><a href="/admin">Area riservata</a></li>
            </ul>
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

<style lang="scss">
nav{
    background-color: white;
    position: fixed;
    width: 100%;
    z-index: 200;
    height: 80px;
    vertical-align: middle;
    line-height: 40px;
    ul{
    position: fixed;
    top: 20px;
    right: 10px;
    justify-content: flex-end;
    list-style-type: none;
    display: flex;
    font-size: 15px;
    text-transform: uppercase;
    li{
        justify-content: flex-end;
        a{
            color: black;
            &:hover{
                color: #EAA480;
                text-decoration: none;
                transition-duration: 1s;
            }
        }
    }
}
}

.router-link-exact-active{
    color: #EAA480;
}

.link{
    color: black;
    &:hover{
        color: #EAA480;
        text-decoration: none;
        transition-duration: 1s;
    }
}
h1{
    position: fixed;
    top: 20px;
    left: 10px;
    vertical-align: middle;
    line-height: 40px;
}
</style>