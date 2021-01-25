import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/components/Home'
import Product from '@/components/Product'
import Checkout from '@/components/Checkout'
import ProductDetail from '@/components/ProductDetail'

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
        path: '/detail',
        name: 'detail',
        component: ProductDetail
    }, {
        path: '/prduct/:productID/details',
        name: 'details',
        component: ProductDetail,
        props: true,
    }]
})