<template>
    <section class="content mt-3">
        <div class="container-fluid">
            <div class="row justify-content-around">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header text-center">
                            <h3 class="card-title">Add New Category</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" @click.prevent="addCategory()">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="categoryid">Add New Category</label>
                                    <input type="text" v-model="form.catname" name="catname" class="form-control" id="categoryid" placeholder="Add New Category" :class="{ 'is-invalid': form.errors.has('catname') }">
                                    <has-error :form="form" field="catname"></has-error>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Save</button>
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
    name: "New",
    data() {
        return {
            form: new Form({
                catname: '',
            })
        }
    },
    methods: {
        addCategory() {
            this.$Progress.start();
            this.form.post('/add-category')
                .then((response) => {
                    this.$router.push('/category-list')
                    toast.fire({
                        type: 'success',
                        title: 'Category Added successfully !!'
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
