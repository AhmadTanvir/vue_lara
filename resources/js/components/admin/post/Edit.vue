<template>
    <section class="content mt-3">
        <div class="container-fluid">
            <div class="row justify-content-around">
                <div class="col-md-10">
                    <div class="card card-primary">
                        <div class="card-header text-center">
                            <h3 class="card-title">Update Post</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" @submit.prevent="updatePost()" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="text" v-model="form.title" name="title" class="form-control" id="postid" placeholder="Title" :class="{ 'is-invalid': form.errors.has('title') }">
                                    <has-error :form="form" field="title"></has-error>
                                </div>
                                <div class="form-group">
                                    <textarea v-model="form.description" cols="30" rows="10" name="description" class="form-control" id="postcontent" placeholder="Description" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                                    <!-- <markdown-editor v-model="form.description"></markdown-editor> -->
                                    <has-error :form="form" field="description"></has-error>
                                </div>
                                <div class="form-group">
                                    <select class="custom-select" :class="{ 'is-invalid': form.errors.has('cat_id') }" v-model="form.cat_id">
                                        <option disabled value="">Select One</option>
                                        <option :value="category.id" v-for="category in getallCategory">{{ category.catname }}</option>
                                    </select>
                                    <has-error :form="form" field="cat_id"></has-error>
                                </div>
                                <div class="form-group">
                                    <input type="file" name="photo" @change="changePhoto($event)" class="form-control" id="postid" :class="{ 'is-invalid': form.errors.has('photo') }">
                                    <img :src="updateImage()" alt="" width="120" height="70" class="mt-2">
                                    <has-error :form="form" field="photo"></has-error>
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
    data() {
        return {
            form: new Form({ //form instance
                title: '',
                description: '',
                cat_id: '',
                photo: ''
            })
        }
    },
    mounted() {
        this.$store.dispatch("allCategory");
    },
    created() { //request pass from here to fetch data from database first when load the page hite on this method
        axios.get(`/post/${this.$route.params.postid}`) //`` sign is instead of + concat operater
            .then((response) => {
                this.form.fill(response.data.post) //controller retern here by data.post
            }).catch(() => {

            })
    },
    computed: {
        getallCategory() {
            return this.$store.getters.getCategory
        }
    },
    methods: {
        changePhoto(event) { // console.log(event) using js onload event
            let file = event.target.files[0]; //get the file from what you choosen console.log(file) to see file size
            if (file.size > 1048576) { //1048576
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'You are uploading a large file !!'
                })
            } else {
                let reader = new FileReader(); //create FileReader class object
                reader.onload = event => { //the file data will print here
                    this.form.photo = event.target.result
                    console.log(event.target.result)
                };
                reader.readAsDataURL(file);
            }
        },
        updatePost() {
            this.$Progress.start();
            this.form.post(`/update/${this.$route.params.postid}`) //route in web.php 
                .then((response) => {
                    this.$router.push('/post-list')
                    toast.fire({
                        type: 'success',
                        title: 'Post Updated successfully !!'
                    });
                    this.$Progress.finish();
                }).catch(() => {
                    this.$Progress.fail();
                })
            // console.log(this.form.description)
        },
        updateImage() {
            let img = this.form.photo;
            if (img.length > 100) {
                return this.form.photo
            } else {
                return "images/uploadimage/" + this.form.photo
            }
        }
    }
}

</script>
<style scoped>
</style>
