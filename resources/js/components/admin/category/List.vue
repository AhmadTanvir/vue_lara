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
                                                    <th>Sl. No.</th>
                                                    <th>Category Name</th>
                                                    <th>Created At</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Category Name</td>
                                                    <td>10 Nov 2019</td>
                                                    <td>
                                                        <a href="#" @click="" title="Edit" style="margin-right: 10px"><i class="fas fa-edit blue"></i></a><!-- editModal(user) --> |
                                                        <a href="#" @click="" title="Delete" style="margin-left: 10px"><i class="fa fa-trash red"></i></a><!-- deleteUser(user.id) -->
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
    name: "List"
}

</script>
<style scoped>
</style>
