<template>
    <div>
        <section class="content mt-3">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Category List</h3>
                            <div class="card-tools">
                                <button class="btn btn-outline-success green" title="Add New">
                                    <router-link to="/add-category"><i class="fas fa-user-plus white" style="width: 50px;"></i></router-link>
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
                                                    <th>
                                                        <select v-model="select" name="" id="" @change="deleteSelected">
                                                            <!-- onchange Event -->
                                                            <option value="">Select</option>
                                                            <option value="">Delete All</option>}
                                                        </select> &nbsp;&nbsp;/&nbsp;&nbsp;
                                                        <input style="margin-top: 10px" v-model="all_select" type="checkbox" @click.prevent="selectAll" name="">
                                                        <span v-if="all_select==false">Check All</span>
                                                        <span v-else>Uncheck All</span>
                                                    </th>
                                                    <th>Sl. No.</th>
                                                    <th>Category Name</th>
                                                    <th>Created At</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(category,index) in getallCategory" :key="category.id">
                                                    <td><input type="checkbox" v-model="categoryItem" :value="category.id" name=""></td>
                                                    <td>{{ index+1 }}</td>
                                                    <td>{{ category.catname }}</td>
                                                    <td>{{ category.created_at | myDate }}</td>
                                                    <td>
                                                        <router-link :to="`/edit-category/${category.id}`" title="Edit" style="margin-right: 10px"><i class="fas fa-edit blue"></i></router-link><!-- editModal(user) --> |
                                                        <a href="#" @click.prevent="deleteCategory(category.id)" title="Delete" style="margin-left: 10px"><i class="fa fa-trash red"></i></a><!-- deleteUser(user.id) -->
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
    data() {
        return {
            categoryItem: [],
            select: '',
            all_select: false
        }
    },
    mounted() {
        this.$store.dispatch("allCategory")
    },
    computed: {
        getallCategory() {
            return this.$store.getters.getCategory
        }
    },
    methods: {
        deleteCategory(id) {
            axios.get('/category/' + id)
                .then(() => {
                    this.$store.dispatch("allCategory")
                    toast.fire({
                        type: 'success',
                        title: 'Category Deleted successfully !!'
                    });
                })
            // console.log(id)
        },
        deleteSelected() {
            axios.get('/deletecategory/' + this.categoryItem)
                .then(() => {
                    this.categoryItem = []
                    this.$store.dispatch("allCategory")
                    toast.fire({
                        type: 'success',
                        title: 'Category Deleted successfully !!'
                    });
                })
        },
        selectAll() {
            if (this.all_select == false) {
                this.all_select = true
                for (var category in this.getallCategory) {
                    this.categoryItem.push(this.getallCategory[category].id)
                }
            } else {
                this.all_select = false
                this.categoryItem = []
            }

        }
    }
}

</script>
<style scoped>
</style>
