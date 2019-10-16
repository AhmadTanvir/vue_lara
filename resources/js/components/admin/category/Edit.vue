<template>
    <section class="content mt-3">
        <div class="container-fluid">
            <div class="row justify-content-around">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header text-center">
                            <h3 class="card-title">Edit Category</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" @submit.prevent="updateCategory()
">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="categoryid">Edit Category</label>
                                    <input type="text" v-model="form.catname" name="catname" class="form-control" id="categoryid" :class="{ 'is-invalid': form.errors.has('catname') }">
                                    <has-error :form="form" field="catname"></has-error>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
export default {
    name: "Edit",
    mounted() { //property related to route.js edit-category
        axios.get(`/editcategory/${this.$route.params.categoryid}`)
            .then((response) => {
                this.form.fill(response.data.category)
            })
    },
    data() {
        return {
            form: new Form({
                catname: '',
            })
        }
    },
    methods: {
        updateCategory() {
            this.$Progress.start();
            this.form.post(`/update-category/${this.$route.params.categoryid}`)
                .then((response) => {
                    this.$router.push('/category-list')
                    toast.fire({
                        type: 'success',
                        title: 'Category Updated successfully !!'
                    });
                    this.$Progress.finish();
                }).catch(() => {
                    this.$Progress.fail();
                })
            // console.log("Category")
        }
    }
}

</script>
<style scoped>
</style>
