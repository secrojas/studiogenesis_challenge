<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Usuarios</h1>
          </div>          
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">

        <div class="card-header">
          <div class="card-tools">
              <router-link class="btn btn-info btn-sm" :to="'/usuarios/crear'" style="color:white">
                <i class="fas fa-plus-square"></i> Nuevo usuario
              </router-link>
          </div>
        </div>

        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">

              <div class="card-header">
                  <h3 class="card-title">Criterios de Búsqueda</h3>
              </div>
              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-laber">Nombre</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="fillBsqUsuario.cNombre" @keyup.enter="getListadoUsuarios">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-laber">Usuario</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="fillBsqUsuario.cUsuario" @keyup.enter="getListadoUsuarios">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-laber">Email</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="fillBsqUsuario.cCorreo" @keyup.enter="getListadoUsuarios">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-laber">Estado</label>
                        <div class="col-md-9">
                          <el-select  v-model="fillBsqUsuario.cEstado" 
                                      placeholder="Seleccione un Estado"
                                      clearable>
                            <el-option
                              v-for="item in listEstados"
                              :key="item.value"
                              :label="item.label"
                              :value="item.value">
                            </el-option>
                          </el-select>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>

              <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button class="btn btn-flat btn-info btnWidth" @click.prevent="getListadoUsuarios">Buscar</button>
                    <button class="btn btn-flat btn-default btnWidth" @click.prevent="limpiarCriteriosBsq">Limpiar</button>
                  </div>
                </div>
              </div>

            </div> 

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Resultados</h3>
              </div>
              <div class="card-body table-responsive">

                  <table class="table table-hover table-head-fixed text-nowrap projects">
                    <thead>
                      <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Usuario</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in listarUsuariosPaginated" :key="index">
                        <td>
                          <li class="user-block">
                            <img src="/img/avatar.png" alt="item.username" class="profile-avatar-img img-fluid img-circle">
                          </li>                          
                        </td>
                        <td v-text="item.fullname"></td>
                        <td v-text="item.email"></td>
                        <td v-text="item.username"></td>
                        <td>
                          <template v-if="item.state == 'A'">
                            <span class="badge badge-success" v-text="item.state_alias"></span>
                          </template>   
                          <template v-else>
                            <span class="badge badge-danger" v-text="item.state_alias"></span>
                          </template>                        
                        </td>
                        <td>
                          <router-link class="btn btn-primary btn-sm" :to="'/'">
                            <i class="fas fa-folder"></i> Ver
                          </router-link>
                          <router-link class="btn btn-info btn-sm" :to="'/'">
                            <i class="fas fa-pencil-alt"></i> Editar
                          </router-link>
                          <router-link class="btn btn-danger btn-sm" :to="'/'">
                            <i class="fas fa-trash"></i> Desactivar
                          </router-link>
                          <router-link class="btn btn-success btn-sm" :to="'/'">
                            <i class="fas fa-check"></i> Activar
                          </router-link>
                        </td>
                      </tr>                    
                    </tbody>
                  </table>
  
                  <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm- m-0 float-right">
                      <li class="page-item" v-if="pageNumber > 0">
                        <a href="" class="page-link" @click.prevent="prevPage">Anterior</a>
                      </li>
                      <li class="page-item" v-for="(page,index) in pagesList" :key="index"
                          :class="[page == pageNumber ? 'active' : '']">
                        <a href="" class="page-link" @click.prevent="selectPage(page)">{{ page+1 }}</a>
                      </li>
                      <li class="page-item" v-if="pageNumber < pageCount - 1">
                        <a href="" class="page-link" @click.prevent="nextPage">Siguiente</a>
                      </li>
                    </ul>
                  </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

  export default {
    data(){
      return{
        //objeto para filtros de búsqueda
        fillBsqUsuario:{
          cNombre:'',
          cUsuario:'',
          cCorreo:'',
          cEstado:''
        },
        //arreglo para listar resultados de la búsqueda
        listUsuarios: [],
        //arreglo para filtro por estados
        listEstados:[
          {value: 'A', label:'Activo'},
          {value: 'I', label:'Inactivo'}
        ],
        //paginación
        pageNumber: 0,
        perPage: 5
      } 
    },
    //métodos para escuchar cambios y ejecutarse
    computed:{
      //Obtener el número de páginas
      pageCount(){
        //20
        //5
        //20/5=4
        let a = this.listUsuarios.length,
            b = this.perPage;
        return Math.ceil(a / b);
      },
      //Obtener regisros paginados
      listarUsuariosPaginated(){
        let inicio = this.pageNumber * this.perPage,
            fin = inicio + this.perPage;
        return this.listUsuarios.slice(inicio,fin);
      },
      pagesList()
      {
        let a = this.listUsuarios.length,
            b = this.perPage;
        let pageCount = Math.ceil(a / b);
        let count = 0,
            pagesArray = [];

        while (count < pageCount){
          pagesArray.push(count);
          count++;
        }
        return pagesArray;
      }
    },
    methods: {
      //método para limpiar los campos de búsqueda
      limpiarCriteriosBsq(){
        this.fillBsqUsuario.cNombre = '';
        this.fillBsqUsuario.cUsuario = '';
        this.fillBsqUsuario.cCorreo = '';
        this.fillBsqUsuario.cEstado = '';
      },
      //método para limpiar el arreglo de usuarios
      limpiarListadoUsuarios(){
        this.listUsuarios=[];
      },
      //método para obtener los usuarios
      getListadoUsuarios(){
        var url='/administracion/usuario/getListadoUsuarios'
        axios.get(url, {
          params:{
            'cNombre': this.fillBsqUsuario.cNombre,
            'cUsuario': this.fillBsqUsuario.cUsuario,
            'cCorreo': this.fillBsqUsuario.cCorreo,
            'cEstado': this.fillBsqUsuario.cEstado
          }
        }).then(response=>{
          this.inicializarPaginacion();
          this.listUsuarios = response.data;
        })
      },
      //métodos para la paginación
      nextPage(){
        this.pageNumber++;
      },
      prevPage(){
        this.pageNumber--;
      },
      selectPage(page){
        this.pageNumber=page;
      },
      inicializarPaginacion(){
        this.pageNumber = 0;
      }
    }
  }

</script>

<style>

</style>