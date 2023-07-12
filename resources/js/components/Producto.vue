<template>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-5 d-flex">
                <router-link to="/productosStore" type="button" class="btn btn-primary"><i class="fas fa-plus-circle fa-lg"></i> Agregar</router-link>
                <button type="button" class="btn btn-success ms-3"  @click="exportarProductos"><i class="fas fa-file-excel fa-lg"></i> Exportar a Excel</button>
            </div>
            <div class="col-12 mt-4">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Clave</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Producto</th>
                                <th scope="col">Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                           <tr v-for="producto in productos" :key="producto.idProducto">
                                <td>{{ producto.idProducto }}</td>
                                <td>{{ producto.clave }}</td>
                                <td>{{ producto.categoria }}</td>
                                <td>{{ producto.producto }}</td>
                                <td>$ {{ producto.precio | toFixed(2)}}</td>
                           </tr>
                        </tbody>
                    </table>
                </div>
            </div>
       
        
        </div>
    </div>
</template>

<script>
export default{
    name: "productos",
    data(){
        return{
            productos:[]
        }
    },
    mounted(){
        this.mostrarProductos()
    },
    methods:{
        async mostrarProductos(){
           await this.axios.get('/api/getproductos')
            .then(response=>{
                this.productos = response.data;
            }).catch(error=>{
                console.log(error.msg)
            })
        },
        exportarProductos(){
            const url = '/api/exportarProductos';
    window.open(url, '_blank');
        }
    },
    //filtro para agregar los decimales al precio
    filters: {
        toFixed(value, decimals) {
            if (!value) return '';
            return value.toFixed(decimals);
        }
    }
}
</script>