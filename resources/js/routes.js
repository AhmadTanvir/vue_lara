import EditCategory from './components/admin/category/Edit.vue'
export const routes = [
    { path: '/dashboard', component: require('./components/admin/Dashboard.vue').default },
    { path: '/users', component: require('./components/admin/Users.vue').default },
    { path: '/profile', component: require('./components/admin/Profile.vue').default },
    { path: '/developer', component: require('./components/admin/Developer.vue').default },
    { path: '*', component: require('./components/admin/NotFound.vue').default },

    //category route component
    { path: '/category-list', component: require('./components/admin/category/List.vue').default },
    { path: '/add-category', component: require('./components/admin/category/New.vue').default },
    { path: '/edit-category/:categoryid', component: EditCategory },

    //post route component
    { path: '/post-list', component: require('./components/admin/post/List.vue').default },
    { path: '/add-post', component: require('./components/admin/post/New.vue').default },
    { path: '/edit-post/:postid', component: require('./components/admin/post/Edit.vue').default },

    //frontEnd route component
    { path: '/', component: require('./components/public/PublicHome.vue').default },
    { path: '/blog', component: require('./components/public/blog/BlogPost.vue').default },
    { path: '/blog/:id', component: require('./components/public/blog/SingleBlog.vue').default },
    { path: '/categories/:id', component: require('./components/public/blog/BlogPost.vue').default },
]
