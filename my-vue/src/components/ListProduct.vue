<template>
    <div>
        <div class="container" >
            <div class="row">
                <div class="col-md-4" v-for="product in products">

                    <div class="single-product" >
                        <div class="product-img">
                            <router-link :to="{ name: 'details', params: { productID: product.id }}">
                                <img width="100%" class="default-img" :src="'http://127.0.0.1:8000/storage//' + product.image" alt="#">
                            </router-link>
                            <div class="button-head">
                                <div class="product-action-2">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="product-content">
                            <h3 class="name-category">
                               <router-link style="color:black;" :to="{ name: 'details', params: { productID: product.id }}">{{product.name}}</router-link>
                            </h3>
                            <div class="product-price">
                                <span>{{ product.price }}$</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
export default{
    data(){
        return {
            categoryID: this.$route.params.categoryID,
            products : []
        }
    },
    mounted(){
        axios
      .get(
        "http://127.0.0.1:8000/api/category/find/" + this.categoryID)
      .then(response => {
        this.products = response.data.data.products;
        })
    }
}

</script>
<style scoped>
.name-category {
    margin: 0px;
    width: 100%;
    color: rgb(36, 36, 36);
    font-size: 13px;
    font-weight: 400;
    font-style: normal;
    font-stretch: normal;
    line-height: 1.54;
    letter-spacing: 0.1px;
}
</style>