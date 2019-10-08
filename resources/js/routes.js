export let routes = [
    { path: '/dashboard', component: require('./components/admin/Dashboard.vue').default },
    { path: '/users', component: require('./components/admin/Users.vue').default },
    { path: '/profile', component: require('./components/admin/Profile.vue').default },
    { path: '/developer', component: require('./components/admin/Developer.vue').default },
    { path: '*', component: require('./components/admin/NotFound.vue').default },

    { path: '/category-list', component: require('./components/admin/category/List.vue').default },
    { path: '/add-category', component: require('./components/admin/category/New.vue').default },
]
