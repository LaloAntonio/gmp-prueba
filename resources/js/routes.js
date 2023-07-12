const Producto = () => import ('./components/Producto.vue')
const ProductoStore = () => import('./components/ProductoStore.vue')

export const routes = [

    {
        name: 'productos',
        path: '/productos',
        component: Producto
    },
    {
        name: 'productosStore',
        path: '/productosStore',
        component: ProductoStore
    }
]