var url = 'http://localhost:8000/';
var urlClientes = url + 'clientes';
var urlProductos = url + 'productos';
new Vue({
  el: '#create_factura',
  created: function(){
    this.getClientes();
    this.getProductos();
  },
  data: {
    clientes: [],
    cid: '',
    cnit: '',
    cnom: '',
    cdir: '',
    productos: [],
    busca: '',
    idpro: 0,
    pre: 0,
    pro: '',
    existencia: 0,
    canti: 0,
    cont: 0,
    total: 0,
    ListaProductos:[]
  },
  methods:
  {
    getClientes(){
      axios.get(urlClientes).then(response => {
        this.clientes = response.data
      });
    },
    verCliente(index){
      this.cid = this.clientes[index].id_cliente;
      this.cnit = this.clientes[index].nit;
      this.cnom = this.clientes[index].nombre;
      this.cdir = this.clientes[index].direccion;
    },
    getProductos(){
      axios.get(urlProductos).then(response => {
        this.productos = response.data
      })
    },
    verProducto(producto){
      this.idpro = producto.id_producto;
      this.pro = producto.producto;
      this.pre = producto.precio_venta;
      this.existencia = producto.existencia;
    },
    agregarFila(){
      if(this.canti != "" && this.canti > 0){
        this.ListaProductos.push({idpro: this.idpro, pre: this.pre, pro: this.pro,
          existencia: this.existencia, cantidad: this.canti, cont: this.cont+1, subtotal: this.pre*this.canti});
          this.cont=this.cont+1;
      }else{
        alert('Valor invalido');
      }
    },
    eliminarFila(index){
      this.ListaProductos.splice(index, 1);
    }
  },
  computed: {
    FiltroProducto(){
      return this.productos.filter((producto) => {
        return producto.producto.match(this.busca);
      });
    },
    sumarSubtotal(){
      this.total = 0;
      for (produc of this.ListaProductos){
        this.total = this.total + produc.subtotal;
      }
      return this.total;
    }
  }
});

new Vue({
  el: '#editar_factura',
  created: function(){
    this.getProductos();
  },
  data: {
    busca: '',
    lista: false,
    activo: true,
    productos: []
  },
  methods: {
    activar(){
      this.activo = !this.activo;
    },
    ver(){
      this.lista = !this.lista;
    },
    getProductos(){
      axios.get(urlProductos).then(response => {
        this.productos = response.data;
        console.log(response.data);
      })
    }
  },
  computed: {
    FiltroProducto(){
      return this.productos.filter((producto) => {
        return producto.producto.match(this.busca);
      });
    }
  }
});
