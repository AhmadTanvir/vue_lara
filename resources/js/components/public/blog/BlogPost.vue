<template>
    <span id="blogpost">
        <section id="inner-headline">
            <div class="container">
                <div class="row">
                    <div class="span4">
                        <div class="inner-heading">
                            <h2>Blog left sidebar </h2>
                        </div>
                    </div>
                    <div class="span8">
                        <ul class="breadcrumb">
                            <li><a href="#"><i class="icon-home"></i></a><i class="icon-angle-right"></i></li>
                            <li><a href="#">Blog</a><i class="icon-angle-right"></i></li>
                            <li class="active">Blog with left sidebar</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section id="content">
            <div class="container">
                <div class="row">
                    <div class="span8">
                        <article v-for="post in blogpost">
                            <div class="row">
                                <div class="span8">
                                    <div class="post-image">
                                        <div class="post-heading">
                                            <h3><a href="#">{{ post.title }}</a></h3>
                                        </div>
                                        <img :src="`images/uploadimage/${post.photo}`" alt=""><!-- have to bind :src like to get image -->
                                    </div>
                                    <p>
                                        {{ post.description | shorttext(200, "...") }}
                                    </p>
                                    <div class="bottom-article">
                                        <ul class="meta-post">
                                            <li><i class="icon-calendar"></i><a href="#"> {{ post | myDate }}</a></li>
                                            <li v-if="post.user" title="Contributor"><i class="icon-user"></i><a href="#"> {{ post.user.name }}</a></li>
                                            <li v-if="post.category" title="Category"><i class="icon-folder-open"></i><a href="#"> {{ post.category.catname }}</a></li>
                                            <li><i class="icon-comments"></i><a href="#">4 Comments</a></li>
                                        </ul>
                                        <router-link :to="`/blog/${post.id}`" class="pull-right">Continue reading <i class="icon-angle-right"></i></router-link>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <div id="pagination">
                            <span class="all">Page 1 of 3</span>
                            <span class="current">1</span>
                            <a href="#" class="inactive">2</a>
                            <a href="#" class="inactive">3</a>
                        </div>
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
    name: "BlogPost",
    components: {
        BlogSidebar
    },
    mounted() {
        this.$store.dispatch("getblogPost"); //this 'blogpost' comes from store actions: and it'll load first in our template
    },
    computed: { //data return here and show above
        blogpost() {
            return this.$store.getters.getblogPost
        }
    },
    methods: {
        getAllCategoryPost() { //have to create action inside index.js
            if (this.$route.params.id != null) {
                this.$store.dispatch('getPostByCatId', this.$route.params.id);
            } else {
                this.$store.dispatch("getblogPost");
            }
        }
    },
    watch: {
        $route(to, from) {
            this.getAllCategoryPost();
        }
    }

}

</script>
<style scoped>
</style>
