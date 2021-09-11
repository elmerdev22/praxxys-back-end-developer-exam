<template>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-md-6">
                    <label>Categories</label>
                    <select v-model="category" v-on:change="getProducts" class="form-control">
                        <option value="">Select</option>
                        <option v-for="(item, index) in categories" :value="index" :key="index">{{item}}</option>
                    </select>
                </div>
                <div class="col-12 col-md-6">
                    <label>Search</label>
                    <input v-model="search" v-on:keyup="getProducts" type="text" class="form-control" placeholder="Search...">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive my-2">
                        <table class="table table-bordered table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th class="text-center" width="150px">Action</th>
                                </tr>
                            </thead>
                            <tbody v-if="products.total > 0">
                                <tr v-for="product in products.data" :key="product.id">
                                    <td>{{ product.name }}</td>
                                    <td>{{ product.category }} {{product.image_link}}</td>
                                    <td>
                                        <span v-html="product.description"></span>
                                    </td>
                                    <td class="text-center">
                                        <a :href="'products/edit/'+product.id" class="btn btn-success btn-sm">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                        <button v-on:click="deleteProduct(product.id)" class="btn btn-danger btn-sm">
                                            <span class="fa fa-trash"></span>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr class="text-center">
                                    <td colspan="4">
                                        <span v-if="isLoad">
                                            No Data Found.
                                        </span>
                                        <span v-else>
                                            Loading Data.
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-lg-4 text-center text-sm-left">
                            Showing {{products.from == null ? 0 : products.from}} to {{products.to == null ? 0 : products.to}} out of {{products.total}} items
                        </div>
                        <div class="col-sm-6 col-md-8 col-lg-8 text-center text-sm-right">
                            <pagination align="right" :data="products" @pagination-change-page="getProducts"></pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import ProductServices from "../../services/ProductServices";
    
    const List = {
        props: ['categories'],
        data() {
            return {
                products  : {},
                category  : '',
                search    : '',
                isLoad    : false
            }
        },
        mounted() {
            this.getProducts();
        },
        methods : {
            async getProducts(page = 1) {
                const data = {
                    page    : page,
                    category: this.category,
                    search  : this.search,
                };
                const response = await ProductServices.products(data);
                if(response){
                    this.products = response.data;
                    this.isLoad   = true;
                }
            },
            deleteProduct(id){
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
                            const response = await ProductServices.deleteProduct(id);
                            this.$swal({
                                position: 'center',
                                icon: response.status ? 'success' : 'error',
                                title: response.status ? 'Successfully Deleted!' : 'Opps Something went wrong. please try again',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            this.getProducts();
                        }
                });
            }
        }
    }

    export default List;
</script>
