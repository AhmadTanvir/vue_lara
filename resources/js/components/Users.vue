<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users Table</h3>
                        <div class="card-tools">
                            <button class="btn btn-outline-success" title="Add New" @click="newModal"><i class="fas fa-user-plus fa-2x"></i></button>
                        </div><!-- data-toggle="modal" data-target="#addnew" -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive table-bordered p-0">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>E-Mail</th>
                                    <th>Type</th>
                                    <th>Registered At</th>
                                    <th>Modify</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users" :key="user.id">
                                    <td>{{ user.id }}</td>
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>{{ user.type | upText }}</td>
                                    <td>{{ user.created_at | myDate}}</td>
                                    <td>
                                        <a href="#" @click="editModal(user)" title="Edit" style="margin-right: 10px"><i class="fas fa-edit blue"></i></a> |
                                        <a href="#" @click="deleteUser(user.id)" title="Delete" style="margin-left: 10px"><i class="fa fa-trash red"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="addnew" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addnewLabel" v-show="editmode">Update User's Info</h5>
                        <h5 class="modal-title" id="addnewLabel" v-show="!editmode">Add New</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateUser():createUser()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.name" type="text" name="name" placeholder="Name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.email" type="email" name="email" placeholder="Email Address" class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                            </div>
                            <div class="form-group">
                                <textarea v-model="form.bio" name="bio" id="bio" placeholder="Short bio for user (Optional)" class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                                <has-error :form="form" field="bio"></has-error>
                            </div>
                            <div class="form-group">
                                <select name="type" v-model="form.type" id="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                                    <option value="">Select User Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">Standard User</option>
                                    <option value="author">Author</option>
                                </select>
                                <has-error :form="form" field="type"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.password" type="password" name="password" id="password" class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                <has-error :form="form" field="password"></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button v-show="editmode" type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> Update </button>
                            <button v-show="!editmode" type="submit" class="btn btn-primary"><i class="fa fa-user-plus"></i> Create </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            editmode: false,
            users: {},
            form: new Form({
                id: '',
                name: '',
                email: '',
                password: '',
                type: '',
                bio: '',
                photo: ''
            })
            // form: new Form([name])
        }
        // return { editmode: false, users: {}, form: new Form([email]) }
        // return { editmode: false, users: {}, form: new Form([password]) }
        // return { editmode: false, users: {}, form: new Form([type]) }
        // return { editmode: false, users: {}, form: new Form([bio]) }
        // return { editmode: false, users: {}, form: new Form([photo]) }
    },
    methods: {
        updateUser(id) {
            this.$Progress.start();
            // console.log('Editing Data');
            this.form.put('api/user/' + this.form.id)
                .then(() => {
                    //successfull
                    $('#addnew').modal('hide');
                    Swal.fire(
                        'Updated!',
                        'Information has been updated Successfully !!.',
                        'success'
                    )
                    this.$Progress.finish();
                    Fire.$emit('AfterCreated');
                })
                .catch(() => {
                    this.$Progress.fail();
                })
        },
        editModal(user) {
            this.editmode = true;
            this.form.reset();
            $('#addnew').modal('show');
            this.form.fill(user);
        },
        newModal() {
            this.editmode = false;
            this.form.reset();
            $('#addnew').modal('show');
        },
        deleteUser(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                //Send Ajax Request to the server
                if (result.value) {
                    this.form.delete('api/user/' + id).then(() => {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        Fire.$emit('AfterCreated');
                    }).catch(() => {
                        Swal("Faild!", "There was something wrong.", "warning");
                    });
                }
            })
        },
        loadUsers() {
            axios.get("api/user").then(({ data }) => (this.users = data.data))
        },
        createUser() {
            this.$Progress.start();
            this.form.post('api/user')
                .then(() => {
                    Fire.$emit('AfterCreated');
                    $('#addnew').modal('hide')
                    toast.fire({
                        type: 'success',
                        title: 'User Created successfully !!'
                    });
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                })
        }
    },
    created() {
        this.loadUsers();
        Fire.$on('AfterCreated', () => {
            this.loadUsers();
        });
        // setInterval(() => this.loadUsers(), 3000);
    }
    // mounted() {
    //     console.log('Component mounted.')
    // }
}

</script>
