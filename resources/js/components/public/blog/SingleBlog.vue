<template>
    <span>
        <section id="content">
            <div class="container">
                <div class="row">
                    <div class="span8">
                        <article>
                            <div class="row">
                                <div class="span8">
                                    <div class="post-image">
                                        <div class="post-heading">
                                            <h3><a href="#">{{ singlepost.title }}</a></h3>
                                        </div>
                                        <img :src="`images/uploadimage/${singlepost.photo}`" alt="">
                                    </div>
                                    <p>
                                        {{ singlepost.description }}
                                    </p>
                                    <div class="bottom-article">
                                        <ul class="meta-post">
                                            <li v-if="singlepost.user" title="Contributor"><i class="icon-user"></i><a href="#"> {{ singlepost.user.name }}</a></li>
                                            <li v-if="singlepost.category" title="Category"><i class="icon-folder-open"></i><a href="#"> {{ singlepost.category.catname }}</a></li>
                                            <!-- <li><i class="icon-tags"></i><a href="#">Web design</a></li> -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                    <BlogSidebar />
                </div>
            </div>
        </section>
    </span>
</template>
<script>
import BlogSidebar from "./BlogSidebar.vue"
export default {
    name: "SingleBlog",
    components: {
        BlogSidebar
    },
    mounted() {
        this.singlePost();
    },
    computed: { //data return here and show above
        singlepost() {
            return this.$store.getters.singlepost
        }
    },
    methods: {
        singlePost() {
            this.$store.dispatch('getPostById', this.$route.params.id); //this 'blogpost' comes from store actions: and it'll load first in our template
        }
    },
    watch: { //watch property
        $route(to, from) {
            this.singlePost();
        }
    }
}

</script>
<style scoped>
</style>
