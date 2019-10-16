<template>
    <div>
        <section class="content mt-3">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Post List</h3>
                            <div class="card-tools">
                                <button class="btn btn-outline-success green" title="Add New Post">
                                    <router-link to="/add-post"><i class="fas fa-user-plus white" style="width: 50px;"></i></router-link>
                                </button>
                                <!-- newModal
 -->
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6"></div>
                                    <div class="col-sm-12 col-md-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example2" class="table table-bordered table-hover dataTable text-center">
                                            <thead>
                                                <tr>
                                                    <th>Sl. No.</th>
                                                    <th>User Name</th>
                                                    <th>Category Name</th>
                                                    <th>Post Title</th>
                                                    <th>Description</th>
                                                    <th>Photo</th>
                                                    <th>Created At</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(post,index) in getallPost">
                                                    <td>{{ index+1 }}</td>
                                                    <td v-if="post.user">{{ post.user.name }}</td>
                                                    <td v-if="post.category">{{ post.category.catname }}</td>
                                                    <td>{{ post.title | shorttext(20, "---")}}</td>
                                                    <td>{{ post.description | shorttext(40, "...") | upText}}</td>
                                                    <td><img width="40" height="50" :src="postImage(post.photo)"></td><!-- have to bind src attribute by :src like otherwise it'll not work -->
                                                    <td>{{ post.created_at | myDate }}</td>
                                                    <td>
                                                        <router-link :to="`/edit-post/${post.id}`" title="Edit" style="margin-right: 10px"><i class="fas fa-edit blue"></i></router-link><!-- editModal(user) --> |
                                                        <a href="#" title="Delete" style="margin-left: 10px" @click.prevent="deletePost(post.id)"><i class="fa fa-trash red"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
    </div>
</template>
<script>
export default {
    name: "List",
    mounted() { //link to index.js action
        this.$store.dispatch("allPost")
    },
    computed: {
        getallPost() {
            return this.$store.getters.getallPost
        }
    },
    methods: {
        deletePost(id) {
            axios.get('/delete/' + id)
                .then(() => {
                    this.$store.dispatch("allPost")
                    toast.fire({
                        type: 'success',
                        title: 'Post Deleted successfully !!'
                    });
                }).catch(() => {

                })
            // console.log(id)
        },
        postImage(img) {
            return "images/uploadimage/" + img;
        }
    }
}

</script>
<style scoped>
</style>
