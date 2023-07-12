<template>
    <div class="container mt-5">
        <div class="row">
            <h2 class="text-center mb-4">Agregar Productos</h2>
            <div class="col-6">
                <div class="mb-3">
                  <label for="claveProducto" class="form-label">Clave del producto</label>
                  <input type="text" class="form-control" v-model="form.claveProducto" name="claveProducto" id="claveProducto" aria-describedby="helpId" placeholder="">
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                  <label for="catProducto" class="form-label">Categoria del Producto</label>
                  <input type="text" class="form-control" v-model="form.catProducto" name="catProducto" id="catProducto" aria-describedby="helpId" placeholder="">
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                  <label for="nombreProducto" class="form-label">Producto</label>
                  <input type="text" class="form-control" v-model="form.nombreProducto" name="nombreProducto" id="nombreProducto" aria-describedby="helpId" placeholder="">
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                  <label for="precioProducto" class="form-label">Precio del producto</label>
                  <input type="text" class="form-control" v-model="form.precioProducto" name="precioProducto" id="precioProducto" aria-describedby="helpId" placeholder="">
                </div>
            </div>
            <div class="col-12">
                <div class="mb-4 text-center">
                    <button type="button" class="btn btn-primary" @click="agregarProductos">Agregar</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Clave</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="tabla.length === 0">
                            <td colspan="4" class="text-center">No hay registros</td>
                        </tr>
                        <tr v-else v-for="producto in tabla" :key="producto.id">
                            <td>{{ producto.clave }}</td>
                            <td>{{ producto.categoria }}</td>
                            <td>{{ producto.producto }}</td>
                            <td>$ {{ producto.precio }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div v-if="tabla.length != 0" class="text-center mt-5">
            <button type="button" class="btn btn-primary" @click="guardarProductos">Agregar Productos</button>
        </div>

    </div>
</template>

<script>
export default{
    name: "tabla",
    data(){
        return {
        form: {
            claveProducto: '',
            catProducto: '',
            nombreProducto: '',
            precioProducto:''
        },
        tabla: []
  };
    },
    methods:{
      async agregarProductos(){
       await this.axios.post('/api/searchProductos',{claveProducto : this.form.claveProducto})
       .then(response=>{
            if (response.data.status == "finded") {
                Swal.fire(
                'Advertencia',
                'Ya se encuentra un producto con esa clave',
                'error'
                );
            }else{
                 // Agregar el nuevo dato a la tabla
                 const nuevoProducto = {
                clave: this.form.claveProducto,
                categoria: this.form.catProducto,
                producto: this.form.nombreProducto,
                precio: this.form.precioProducto
                };

                const existeRegistro = this.tabla.some(dato => dato.clave === nuevoProducto.clave);
                console.log(existeRegistro);
                if (existeRegistro) {
                    Swal.fire(
                    'Advertencia',
                    'Ya se encuentra un producto con esa clave',
                    'error'
                    );
                } else {
                    this.tabla.push(nuevoProducto);
                    // Restablecer el formulario
                    this.form.claveProducto = '',
                    this.form.catProducto = '',
                    this.form.nombreProducto = '',
                    this.form.precioProducto = ''
                }
            }
       }).catch(error=>{
        console.log(error.msg)
       })
      },
      guardarProductos(){
        Swal.fire({
        title: 'Estas seguro?',
        text: "Los productos se guardaran!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmar'
        }).then((result) => {
        if (result.isConfirmed) {
            this.axios.post('/api/guardarProductos',{productos: this.tabla})
        .then(response => {
            if (response.data.status == "success") {
                Swal.fire(
                'Listo!',
                'Productos Agregados.',
                'success'
                );
                this.tabla = [];
            }
    
        })
        .catch(error => {
            console.error('Error al guardar los datos en la base de datos', error);
        });
          
        }
        })
      
      }
    }
}
</script>