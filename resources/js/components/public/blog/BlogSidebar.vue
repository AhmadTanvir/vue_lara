<template>
    <span id="blogsidebar">
        <div class="span4">
            <aside class="right-sidebar">
                <div class="widget">
                    <form class="form-search">
                        <input @keyup="RealSearch" placeholder="Type something" v-model="keyword" type="text" class="input-medium search-query">
                        <button type="submit" @click.prevent="RealSearch" class="btn btn-square btn-theme">Search</button>
                    </form>
                </div>
                <div class="widget">
                    <h5 class="widgetheading">Categories</h5>
                    <ul class="cat">
                        <li v-for="(category,index) in allcategories" v-if="index<5"><i class="icon-angle-right"></i>
                            <router-link :to="`/categories/${category.id}`">{{ category.catname }}</router-link><span> (20)</span>
                        </li>
                    </ul>
                </div>
                <div class="widget">
                    <h5 class="widgetheading">Latest posts</h5>
                    <ul class="recent">
                        <li v-for="(post,index) in blogpost" v-if="index<5">
                            <img :src="`images/uploadimage/${post.photo}`" width="60" height="60" class="pull-left" alt="">
                            <h6>
                                <router-link :to="`/blog/${post.id}`">{{ post.title | shorttext(30, " ") }}</router-link>
                            </h6>
                            <p>
                                {{ post.description | shorttext(100, " >>>") }}
                            </p>
                        </li>
                    </ul>
                </div>
            </aside>
        </div>
    </span>
</template>
<script>
import _ from 'lodash'
export default {
    name: "BlogSidebar",
    data() {
        return {
            keyword: ''
        }
    },
    mounted() { //property 
        this.$store.dispatch("latestpost"); //this 'blogpost' comes from store actions: and it'll load first in our template
        this.$store.dispatch('allcategories');
    },
    computed: { //to display category we'll hit a action
        allcategories() {
            return this.$store.getters.allcategories
        },
        blogpost() {
            return this.$store.getters.latestpost
        }
    },
    methods: {
        // RealSearch() {
        //     this.$store.dispatch('SearchPost', this.keyword);
        // },
        RealSearch: _.debounce(function() {
            this.$store.dispatch('SearchPost', this.keyword);
        }, 1000)
    }
}

</script>
<style scoped>
</style>
