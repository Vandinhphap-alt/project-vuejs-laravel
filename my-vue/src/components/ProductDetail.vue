<template>
  <div>
      <div id="myproduct">
            <div class="row mt-2 mb-2">
                <div class="col-md-10">&nbsp;</div>
                <div class="col-md-2 mr">
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#cart" >
                        <i class="fa fa-shopping-cart"></i> <span class="badge badge-light"> {{badge}} </span>
                    </button>
                    <!-- Modal -->
                    <div id="cart" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">your cart</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        X
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-striped text-left">
                                        <tbody>
                                            <tr v-for="(cart, n) in carts" v-bind:key="cart.id">
                                                <td>{{cart.name}}</td>
                                                <td>Rp. {{cart.price}}</td>
                                                <td width="100"><input type="text" readonly class="form-control" v-model="cart.amount"/></td>
                                                <td width="60">
                                                    <button @click="removeCart(n)" class="btn btn-danger btn-sm">x</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                                <div class="modal-footer">
                                    total price : {{totalprice}} &nbsp;
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   <div class="container">
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">
						<div class="preview-pic tab-content">
						  <div class="tab-pane active" id="pic-1"><img :src="'http://127.0.0.1:8000/storage//' + products.image" /></div>
						</div>
					</div>
					<div class="details col-md-6">
						<h3 class="product-title">{{products.name}}</h3>
						<div class="rating">
							<div class="stars">
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
							</div>
							<span class="review-no">41 reviews</span>
						</div>
						<p class="product-description">{{products.description}}</p>
						<h4 class="price">current price: <span>{{products.price}}$</span></h4>
						<p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>
				
						<div class="action">
							<button @click="addCart(products)" class="btn btn-primary">Add to cart</button>
							<button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  
  
  </div>
  
</template>
<script>
import axios from "axios";
export default{
    data(){
        return{
            productID: this.$route.params.productID,
            products:[],
            carts: [],
            cartadd: {
                id: '',
                name: '',
                description: '',
                price: '',
                amount: '',
                image: ''
            },
            badge: "0",
            quantity: "1",
            totalprice: "0",
            prices: [],
        }
    },
    created() {
        this.viewCart();
    },
    methods:{
      viewCart() {
            if (localStorage.getItem("carts")) {
                this.carts = JSON.parse(localStorage.getItem("carts"));
                this.badge = this.carts.length;
                this.totalprice = this.carts.reduce((total, item) => {
                    return total + this.quantity * item.price;
                }, 0);
            }
            console.log(this.carts);
        },
        addCart(pro) {
            this.cartadd.id = pro.id;
            this.cartadd.name = pro.name;
            this.cartadd.price = pro.price;
            this.cartadd.description = pro.description;
            this.cartadd.amount = this.quantity;
            this.carts.push(this.cartadd);
            this.cartadd = {};
            this.storeCart();
        },
        removeCart(pro) {
            this.carts.splice(pro, 1);
            this.storeCart();
        },
        storeCart() {
            let parsed = JSON.stringify(this.carts);
            localStorage.setItem("carts", parsed);
            this.viewCart();
        },
    },
    mounted() {
    axios
      .get(
        "http://127.0.0.1:8000/api/products/find/" + this.productID)
      .then(response => {
        this.products = response.data.data;
        console.log(this.products);
        })
    },
}

</script>
<style scoped>
body {
  font-family: 'open sans';
  overflow-x: hidden; }

img {
  max-width: 100%; }

.preview {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
      -ms-flex-direction: column;
          flex-direction: column; }
  @media screen and (max-width: 996px) {
    .preview {
      margin-bottom: 20px; } }

.preview-pic {
  -webkit-box-flex: 1;
  -webkit-flex-grow: 1;
      -ms-flex-positive: 1;
          flex-grow: 1; }

.preview-thumbnail.nav-tabs {
  border: none;
  margin-top: 15px; }
  .preview-thumbnail.nav-tabs li {
    width: 18%;
    margin-right: 2.5%; }
    .preview-thumbnail.nav-tabs li img {
      max-width: 100%;
      display: block; }
    .preview-thumbnail.nav-tabs li a {
      padding: 0;
      margin: 0; }
    .preview-thumbnail.nav-tabs li:last-of-type {
      margin-right: 0; }

.tab-content {
  overflow: hidden; }
  .tab-content img {
    width: 100%;
    -webkit-animation-name: opacity;
            animation-name: opacity;
    -webkit-animation-duration: .3s;
            animation-duration: .3s; }

.card {
  margin-top: 50px;
  background: #eee;
  padding: 3em;
  line-height: 1.5em; }

@media screen and (min-width: 997px) {
  .wrapper {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex; } }

.details {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
      -ms-flex-direction: column;
          flex-direction: column; }

.colors {
  -webkit-box-flex: 1;
  -webkit-flex-grow: 1;
      -ms-flex-positive: 1;
          flex-grow: 1; }

.product-title, .price, .sizes, .colors {
  text-transform: UPPERCASE;
  font-weight: bold; }

.checked, .price span {
  color: #ff9f1a; }

.product-title, .rating, .product-description, .price, .vote, .sizes {
  margin-bottom: 15px; }

.product-title {
  margin-top: 0; }

.size {
  margin-right: 10px; }
  .size:first-of-type {
    margin-left: 40px; }

.color {
  display: inline-block;
  vertical-align: middle;
  margin-right: 10px;
  height: 2em;
  width: 2em;
  border-radius: 2px; }
  .color:first-of-type {
    margin-left: 20px; }

.add-to-cart, .like {
  background: #ff9f1a;
  padding: 1.2em 1.5em;
  border: none;
  text-transform: UPPERCASE;
  font-weight: bold;
  color: #fff;
  -webkit-transition: background .3s ease;
          transition: background .3s ease; }
  .add-to-cart:hover, .like:hover {
    background: #b36800;
    color: #fff; }

.not-available {
  text-align: center;
  line-height: 2em; }
  .not-available:before {
    font-family: fontawesome;
    content: "\f00d";
    color: #fff; }

.orange {
  background: #ff9f1a; }

.green {
  background: #85ad00; }

.blue {
  background: #0076ad; }

.tooltip-inner {
  padding: 1.3em; }

@-webkit-keyframes opacity {
  0% {
    opacity: 0;
    -webkit-transform: scale(3);
            transform: scale(3); }
  100% {
    opacity: 1;
    -webkit-transform: scale(1);
            transform: scale(1); } }

@keyframes opacity {
  0% {
    opacity: 0;
    -webkit-transform: scale(3);
            transform: scale(3); }
  100% {
    opacity: 1;
    -webkit-transform: scale(1);
            transform: scale(1); } }

/*# sourceMappingURL=style.css.map */
</style>
