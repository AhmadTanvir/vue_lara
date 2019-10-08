export default {
    state: {
        category: [],
    },
    getters: {
        getCategory(state) { //for data fetch from database or data get
            return state.category
        }
    },
    actions: {
        allCategory(context) { //state, payload
            axios.get('/category')
                .then((response) => {
                    context.commit('categories', response.data.categories)
                    // console.log(response.data.categories)
                })
        }
    },
    mutations: {
        categories(state, data) { //can accept 2 parameter
            return state.category = data
        }
    }
}
