<template>
    <main>
        <ul>
            <li v-for="(post, index) in posts" :key="index">
                {{post.title}}
                <a href="#" @click="getDetail(post.slug, index)">Vedi dettaglio</a>
                <span v-if="post.detail">
                    {{post.detail.slug}}
                </span>
            </li>
        </ul>
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
    methods:{
    getDetail(slug,index ){
            axios.get('/api/posts/'+ slug).then((response)=>{
            console.log(response.data);
            this.posts[index].detail = response.data;
            console.log(this.post[index]);
        }
        )
    }
    },
    created(){
        axios.get('/api/posts').then((response)=>{
            console.log(response.data);
            this.posts = response.data;
        }
        )
    }
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