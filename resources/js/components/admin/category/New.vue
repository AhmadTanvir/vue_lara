<template>
    <section class="content mt-3">
        <div class="container-fluid">
            <div class="row justify-content-around">
                <div></div>
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header text-center">
                            <h3 class="card-title">Add New Category</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="categoryid">Add New Category</label>
                                    <input type="text" class="form-control" id="categoryid" placeholder="Add New Category">
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

    }
}

</script>
<style scoped>
</style>
