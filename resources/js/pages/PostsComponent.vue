<template>
    <section>
        <div class="jumbotron">
            <div class="text">
            <h2>Posts</h2>
            </div>
        </div>
        <div class="card">
        <ul v-if="posts.length > 0">
            <li v-for="(post,index) in posts" :key="post.id">
                {{index}} - {{post.title}}
                <router-link :to="{ name: 'single-post', params: { slug: post.slug } }"> Visualizza Post </router-link>
            </li>
        </ul>
        </div>
    </section>
</template>

<script>
export default {
    name: 'PostsComponent',
    data(){
        return {
            posts : []
        }
    },
    created(){
        axios.get('/api/posts').then((response)=>{
            this.posts = response.data;
        })
    }
}
</script>

<style lang="scss" scoped>
.card{
    margin: 0 25%;
    align-items: center;
    width: 50%;
    padding: 5rem;
    border-radius: 10px;
    ul{
    list-style-type: none;
    }
}
.jumbotron{
    width: 100%;
    .text{
        position: absolute;
        top: 50%;
        right: 50%;
        text-transform: translate(-50%,-50%);
    }
}
</style>