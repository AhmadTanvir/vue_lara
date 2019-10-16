export default {
    state: {
        category: [],
        post: [],
        blogpost: [],
        singlepost: [],
        allcategories: [],
        latestpost: []
    },
    getters: {
        getCategory(state) { //for data fetch from database or data get
            return state.category
        },
        getallPost(state) { //now if we call this getter from any component we can get all data from database
            return state.post
        },
        getblogPost(state) { //now if we call this getter from any component we can get all data from database
            return state.blogpost
        },
        singlepost(state) {
            return state.singlepost
        },
        allcategories(state) {
            return state.allcategories
        },
        latestpost(state) {
            return state.latestpost
        }
    },
    actions: {
        allCategory(context) { //state, payload
            axios.get('/category')
                .then((response) => {
                    context.commit('categories', response.data.categories)
                    // console.log(response.data.categories)
                })
        },
        allPost(context) {
            axios.get('/post') //have to create this route in web.php
                .then((response) => {
                    context.commit('allpost', response.data.posts) //here posts comes from post controller 'posts' and have to create 'allpost' mutation
                })
        },
        getblogPost(context) {
            axios.get('/blogpost') //have to create this route in web.php
                .then((response) => {
                    context.commit('getblogPost', response.data.posts) //this is hit to mutations and we'll create in mutations: as like 'blogpost' name, here posts comes from post controller 'posts' and have to create 'allpost' mutation
                })
        },
        getPostById(context, payload) {
            axios.get('/singlepost/' + payload)
                .then((response) => {
                    context.commit('singlePost', response.data.post)
                })
        },
        allcategories(context) {
            axios.get('/categories')
                .then((response) => {
                    context.commit('allCategories', response.data.categories)
                })
        },
        getPostByCatId(context, payload) {
            axios.get('/categorypost/' + payload) //request pass here to get post with cat id have to create it in web.php
                .then((response) => {
                    // console.log(response.data.posts)
                    context.commit('getPostByCatId', response.data.posts)
                })
        },
        SearchPost(context, payload) {
            axios.get('/search?s=' + payload)
                .then((response) => {
                    context.commit('getSearchPost', response.data.posts)
                })
        },
        latestpost(context) {
            axios.get('/latestpost')
                .then((response) => {
                    context.commit('latestpost', response.data.posts)
                })
        }
    },
    mutations: {
        categories(state, data) { //can accept 2 parameter
            return state.category = data
        },
        allpost(state, payload) {
            return state.post = payload //this payload receve from actions response.data.posts
        },
        getblogPost(state, payload) {
            return state.blogpost = payload //initially state.blogpost has no value but when we load this payload it receve data from actions response.data.posts
        },
        singlePost(state, payload) {
            return state.singlepost = payload //initially state.blogpost has no value but when we load this payload it receve data from actions response.data.posts
        },
        allCategories(state, payload) {
            return state.allcategories = payload
        },
        getPostByCatId(state, payload) {
            state.blogpost = payload
        },
        getSearchPost(state, payload) {
            state.blogpost = payload
        },
        latestpost(state, payload) {
            state.latestpost = payload
        }
    }
}
