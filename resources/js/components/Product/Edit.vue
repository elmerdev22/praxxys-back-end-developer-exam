<template>
    <div class="row">
        <div class="col-12">
            <form enctype="multipart/form-data" ref="form">
                <section v-if="step == 1">
                    <div class="row">
                        <div class="col-12">
                            <h5>Step {{ step }} <small>(Basic inputs)</small></h5>
                        </div>
                    </div>
                    <hr>
                    <div v-if="errors.length > 0" class="alert alert-danger w-100" role="alert">
                        <div v-for="(error, index) in errors" :key="index">
                            <li>{{ error }}</li>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name*</label>
                                <input type="text" v-model="data.name" name="name" class="form-control" placeholder="name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Category*</label>
                                <select v-model="data.category" class="form-control">
                                    <option value="">Select</option>
                                    <option v-for="(item, index) in categories" :value="index" :key="index">{{item}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Description*</label>
                                <vue-editor v-model="data.description"></vue-editor>
                            </div>
                        </div>
                    </div>
                </section>
                <section v-if="step == 2">
                    <div class="row">
                        <div class="col-12">
                            <h5>Step {{ step }} <small>(Image Upload)</small></h5>
                        </div>
                    </div>
                    <hr>
                    <div v-if="errors.length > 0" class="alert alert-danger w-100" role="alert">
                        <div v-for="(error, index) in errors" :key="index">
                            <li>{{ error }}</li>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="images">Images* <small>(.jpeg .jpg .png)</small></label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" accept="image/*" multiple="multiple" @change="previewImages" class="custom-file-input">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row justify-content-center">
                                <div class="col-md-2 text-center" v-for="item, index in previewList" :key="index">
                                    <div class="border p-2">
                                        <img :src="item" class="img-fluid" />
                                    </div>
                                    <div class="my-1">
                                        <button v-on:click="removeImage(index)" type="button" class="btn btn-danger btn-sm">Delete</button>
                                    </div>
                                    <div>file name: {{ data.images[index].name }}</div>
                                    <div>size: {{ (data.images[index].size/1048576).toFixed(2) }}MB</div>
                                </div>
                            </div>
                            <div v-if="currentImages.length > 0">
                                <hr>
                                <div class="row justify-content-center">
                                    <div class="col-12">
                                        <h6>Current Images</h6>
                                    </div>
                                    <div class="col-md-2 text-center" v-for="currentImage, index in currentImages" :key="currentImage.id">
                                        <div class="border p-2">
                                            <img :src="currentImage.image_link" class="img-fluid" />
                                        </div>
                                        <div class="my-1">
                                            <button v-on:click="removeCurrentImage(currentImage.id, index)" type="button" class="btn btn-danger btn-sm">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section v-if="step == 3">
                    <div class="row">
                        <div class="col-12">
                            <h5>Step {{ step }} <small>(DateTime Picker)</small></h5>
                        </div>
                    </div>
                    <hr>
                    <div v-if="errors.length > 0" class="alert alert-danger w-100" role="alert">
                        <div v-for="(error, index) in errors" :key="index">
                            <li>{{ error }}</li>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">DateTime</label>
                                <input type="datetime-local" v-model="data.datetime" class="form-control">
                            </div>
                        </div>
                    </div>
                </section>
                <hr>
                <div class="row">
                    <div class="col-12 text-right">
                        <button type="button" v-if="step > 1" v-on:click="backStep" class="btn btn-primary"><span class="fas fa-arrow-left"></span> Back</button>
                        <button type="button" v-if="step < 3" v-on:click="nextStep" class="btn btn-primary">Next <span class="fas fa-arrow-right"></span></button>
                        <button type="button" v-else v-on:click="nextStep" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
    import ProductServices from "../../services/ProductServices";
    import { VueEditor } from "vue2-editor";

    const Edit = {
        props: ['categories', 'id'],
        components : {
            VueEditor
        },
        mounted() {
            this.initialData();
        },
        data() {
            return {
                data  : {
                    category   : '',
                    name       : '',
                    description: '',
                    datetime   : '',
                    images     : []
                },
                currentImages      : [],
                currentImagesRemove: [],
                errors             : [],
                step               : 1,
                previewList        : []
            }
        },
        methods : {
            previewImages: function(event) {
                var input = event.target;
                var count = input.files.length;
                var index = 0;
                if (input.files) {
                    while(count --) {
                        var reader = new FileReader();
                        reader.onload = (e) => {
                            this.previewList.push(e.target.result);
                        }
                        this.data.images.push(input.files[index]);
                        reader.readAsDataURL(input.files[index]);
                        index ++;
                    }
                }
            },
            removeImage(index){
                this.data.images.splice(index, 1);
                this.previewList.splice(index, 1);
            },
            removeCurrentImage(id, index){
                this.$swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then(async (result) => {
                        if (result.isConfirmed) {
                            this.currentImages.splice(index, 1);
                            this.currentImagesRemove.push(id);
                            console.log(this.currentImagesRemove);
                        }
                });
            },
            async initialData(){
                console.log(this.id)
                const response = await ProductServices.editProduct(this.id);
                if(response){

                    const data              = response.data;
                    const datetime          = new Date(data.datetime);
                    const formattedDatetime = datetime.toISOString();

                    this.data = {
                        category   : data.category_id,
                        name       : data.name,
                        description: data.description,
                        datetime   : formattedDatetime.split('.')[0],
                        images     : []
                    }

                    this.currentImages = data.image;
                }
            },
            backStep(){
                this.errors = [];
                this.step--;
            },
            nextStep(){
                this.errors = [];
                var next = true;
                
                if(this.step == 1){
                    if(!this.data.name){
                        this.errors.push('Name is requred.');
                        next = false;
                    }
                    if(!this.data.category){
                        this.errors.push('Category is requred.');
                        next = false;
                    }
                    if(!this.data.description){
                        this.errors.push('Description is requred.');
                        next = false;
                    }
                }
                else if(this.step == 2){
                    
                    if(!this.data.images.length && !this.currentImages.length){
                        this.errors.push('Images is requred.');
                        next = false;
                    }
                } 
                else{
                    if(!this.data.datetime){
                        this.errors.push('DateTime is requred.');
                        next = false;
                    }
                }

                if(next){
                    this.errors = [];
                    this.step < 3 ? this.step++: this.proceed();
                }
            },
            proceed(){
                this.$swal({
                    title             : 'Please wait...',
                    html              : 'Saving Information...',
                    allowOutsideClick : false,
                    showCancelButton  : false,
                    showConfirmButton : false
                });
                this.$swal.showLoading();
                this.submit();
            },
            async submit(){
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }

                let data = new FormData();
                
                $.each(this.data.images, function(key, file) {
                    data.append('images[' + key + ']', file);
                });

                data.append('name', this.data.name);
                data.append('description', this.data.description);
                data.append('category', this.data.category);
                data.append('datetime', this.data.datetime);
                data.append('currentImagesRemove', this.currentImagesRemove);
                
                const response = await ProductServices.updateProduct(this.id, data, config);
                if(response){
                    this.$swal.close();
                    const data = response.data;
                    this.$swal({
                        icon             : data.success ? 'success' : 'error',
                        html             : data.message,
                        title            : data.success ? 'Successful' : 'Oppss.',
                        showConfirmButton: true,
                        allowOutsideClick: data.success ? false : true,
                    }).then((result) => {
                        if(result.value){
                            window.location = '/admin/products';                       
                        }
                    });
                    console.log(data)
                }
            },
        }
    }

    export default Edit;
</script>
