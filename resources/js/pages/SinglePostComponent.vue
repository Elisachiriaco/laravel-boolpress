<template>
    <section>
        <div class="card" v-if="post">
        <h1>{{post.title}}</h1>
        <p>{{post.content}}</p>
        <ul v-if="post.tags">
            <li v-for="tag in post.tags" :key="tag.id">{{tag.name}}</li>
        </ul>
        <img :src="`/storage/${post.image}`" alt="">
        </div>
    </section>
</template>

<script>
export default {
    name: 'SinglePostComponent',
    data(){
        return {
            post : null,
        }
    },
    mounted(){
        const slug = this.$route.params.slug;
        axios.get(`/api/posts/${slug}`).then((response)=>{
            this.post = response.data
        })
    }
}
</script>

<style lang="scss">
    .card{
        margin: 0 25%;
        align-items: center;
        width: 50%;
        padding: 5rem;
        border-radius: 10px;
    }
</style>