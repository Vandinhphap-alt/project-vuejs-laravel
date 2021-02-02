import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/components/Home'
import Product from '@/components/Product'
import Checkout from '@/components/Checkout'
import ProductDetail from '@/components/ProductDetail'
import ListProduct from '@/components/ListProduct'

Vue.use(Router)

export default new Router({
    routes: [{
        path: '/',
        name: 'home',
        component: Home
    }, {
        path: '/products',
        name: 'products',
        component: Product
    }, {
        path: '/checkout',
        name: 'checkout',
        component: Checkout
    }, {
        path: '/product/:productID',
        name: 'details',
        component: ProductDetail,
        props: true,
    }, {
        path: '/listproducts/:categoryID',
        name: 'listproducts',
        component: ListProduct,
        props: true,
    }]
})