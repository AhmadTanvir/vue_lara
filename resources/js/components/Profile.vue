<style type="text/css">
.widget-user-header {
    background-position: center center;
    background-size: cover;
    height: 250px !important;
}

</style>
<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header text-white" style="background-image:url('./images/user_cover.png')">
                        <h3 class="widget-user-usernam activee text-left">Elizabeth Pierce</h3>
                        <h5 class="widget-user-desc text-left">Web Designer</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" :src="getProfilePhoto()" active alt="User Avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">3,200</h5>
                                    <span class="description-text">SALES</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">13,000</h5>
                                    <span class="description-text">FOLLOWERS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">35</h5>
                                    <span class="description-text">PRODUCTS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                            <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane" id="activity">
                                <h1 class="text-center">DISPLAY USER ACTIVITY</h1>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane active" id="settings">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label ml-3">Name</label>
                                        <div class="col-sm-12">
                                            <input type="text" v-model="form.name" class="form-control" id="inputName" placeholder="Name" :class="{ 'is-invalid': form.errors.has('name') }">
                                            <has-error :form="form" field="name"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label ml-3">Email</label>
                                        <div class="col-sm-12">
                                            <input type="email" v-model="form.email" class="form-control" id="inputEmail" placeholder="Email" :class="{ 'is-invalid': form.errors.has('email') }">
                                            <has-error :form="form" field="email"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputExperience" class="col-sm-2 col-form-label ml-3">Experience</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" v-model="form.bio" id="inputExperience" placeholder="Experience" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                                            <has-error :form="form" field="bio"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputImage" class="col-sm-2 col-form-label ml-3">Profile Photo</label>
                                        <div class="col-sm-12">
                                            <input type="file" @change="updateProfile" class="form-control" id="inputImage" placeholder="Skills">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-5 col-form-label ml-3">Change Password (leave empty if not chenging)</label>
                                        <div class="col-sm-12">
                                            <input type="password" v-model="form.password" class="form-control" id="inputPassword" placeholder="Change Password" :class="{ 'is-invalid': form.errors.has('password') }">
                                            <has-error :form="form" field="password"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <button type="submit" @click.prevent="updateInfo" class="btn btn-success"><i class="fa fa-refresh"></i> Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">
export default {
    data() {
        return {
            form: new Form({
                id: '',
                name: '',
                email: '',
                password: '',
                type: '',
                bio: '',
                photo: ''
            })
        }
    },
    mounted() {
        console.log('Component mounted.')
    },
    methods: {
        getProfilePhoto() {
            return "images/profile/" + this.photo;
        },
        updateInfo() {
            this.$Progress.start();
            if (this.form.password == "") {
                this.form.password = undefined;
            }
            this.form.put('api/profile')
                .then(() => {
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                });
        },
        updateProfile(e) {
            // console.log('Updating');
            let file = e.target.files[0];
            console.log(file); //detect file size
            let reader = new FileReader();

            if (file['size'] < 2111775) {
                reader.onloadend = (file) => {
                    // console.log('RESULT', reader.result) result on console
                    //assignign photo
                    this.form.photo = reader.result;
                }
                reader.readAsDataURL(file);
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'You are uploading a large file !!'
                })
            }
        }
    },
    created() {
        axios.get("api/profile")
            .then(({ data }) => (this.form.fill(data)));
    }
}

</script>
