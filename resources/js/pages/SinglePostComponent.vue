<template>
    <section>
        <div class="jumbotron">
            <div class="text">
            <h2>{{post.title}}</h2>
            </div>
        </div>
        <div class="card" v-if="post">
        <p>{{post.content}}</p>
        <ul v-if="post.tags">
            <li v-for="tag in post.tags" :key="tag.id">{{tag.name}}</li>
        </ul>
        <img :src="`/storage/${post.image}`" alt="">
        <div class="comment">
          <h3>Inserisci un commento</h3>
          <form @submit.prevent="addComment()">
              <label for="username" >Nome</label>
              <input v-model="formData.username" type="text" placeholder="Inserisci il tuo nome"/>
              <div class="text">
              <label for="content">Testo</label>
              <textarea class="ml-1"
                v-model="formData.content"
                type="text"
                rows="6"
                cols="50"
                placeholder="Inserisci qui il testo"
              >
              </textarea>
              <button class="mx-3 btn btn-primary" type="submit">Invia</button>
              </div>
          </form>
        </div>
        </div>
        <ul class="mt-3" v-if="post.comments.length > 0">
          <h4>Commenti:</h4>
          <li v-for="comment in post.comments" :key="comment.id">
            {{ comment.username }}: {{ comment.content }}
          </li>
        </ul>
    </section>
</template>

<script>
export default {
    name: 'SinglePostComponent',
    data(){
        return {
            post : null,
            formData: {
                username : "",
                content : "",
                post_id : "",
            },
        }
    },
    methods: {
        addComment() {
            axios.post('/api/comments', this.formData).then((response) =>{
                console.log(response);
                this.posts.comments.push(response.data);
            }).catch((error)=>{
                console.log(error);
            })
        }
    },
    mounted(){
        const slug = this.$route.params.slug;
        axios.get(`/api/posts/${slug}`).then((response)=>{
            this.post = response.data;
            this.formData.post_id = this.post.id;
        }).catch((error) =>{
            this.$router.push({name: 'page-404'});
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

.comment{
    padding-top: 100px;
}
</style>