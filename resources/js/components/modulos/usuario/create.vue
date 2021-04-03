<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Crear Usuario</h1>
          </div>          
        </div>
      </div>
    </div>

    <div class="content container-fluid">
      <div class="card">

        <div class="card-header">
          <div class="card-tools">
              <router-link class="btn btn-info btn-sm" :to="'/usuarios'" style="color:white">
                <i class="fas fa-arrow-left"></i> Regresar
              </router-link>
          </div>
        </div>

        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">

              <div class="card-header">
                  <h3 class="card-title">Formulario Registrar Usuario</h3>
              </div>
              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-laber">Primer Nombre</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="fillCrearUsuario.cPrimerNombre" @keyup.enter="setRegistrarUsuarios">
                        </div>
                      </div>
                    </div> 
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-laber">Segundo Nombre</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="fillCrearUsuario.cSegundoNombre" @keyup.enter="setRegistrarUsuarios">
                        </div>
                      </div>
                    </div>
                     <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-laber">Apellido</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="fillCrearUsuario.cApellido" @keyup.enter="setRegistrarUsuarios">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-laber">Usuario</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="fillCrearUsuario.cUsuario" @keyup.enter="setRegistrarUsuarios">
                        </div>
                      </div>
                    </div>  
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-laber">Email</label>
                        <div class="col-md-9">
                          <input type="email" class="form-control" v-model="fillCrearUsuario.cCorreo" @keyup.enter="setRegistrarUsuarios">
                        </div>
                      </div>
                    </div>  
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-laber">Contraseña</label>
                        <div class="col-md-9">                          
                          <el-input placeholder="Ingresar una Contraseña" v-model="fillCrearUsuario.cContrasena"  @keyup.enter="setRegistrarUsuarios" show-password></el-input>
                        </div>
                      </div>
                    </div> 
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-laber">Imagen de Perfil</label>
                        <div class="col-md-9">
                          <input type="file" class="form-control" @change="getFile">
                        </div>
                      </div>
                    </div>                
                  </div>
                </form>
              </div>

              <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button class="btn btn-flat btn-info btnWidth" @click.prevent="setRegistrarUsuarios"
                    v-loading.fullscreen.lock="fullscreenLoading">Registrar</button>
                    <button class="btn btn-flat btn-default btnWidth" @click.prevent="limpiarCriterios">Limpiar</button>
                  </div>
                </div>
              </div>

            </div> 
           
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" :class="{show: modalShow}" :style="modalShow ? mostrarModal : ocultarModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registro de Nuevo Usuario</h5>
                <button class="close" @click="abrirModal"></button>
            </div>
            <div class="modal-body">
              <div class="callout callout-danger" style="padding:5px" v-for="(item,index) in mensajeError" :key="index" 
                v-text="item">
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" @click="abrirModal">Cerrar</button>
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
        fillCrearUsuario:{
          cPrimerNombre:'',
          cSegundoNombre:'',
          cApellido:'',
          cUsuario:'',
          cCorreo:'',
          cContrasena:'',
          oFotografia:''
        },
        form: new FormData,
        fullscreenLoading:false,
        modalShow: false,
        mostrarModal:{
          display:'block',
          background:'#0000006b'
        },
        ocultarModal:{
          display:'none',
        },
        error:0,
        mensajeError:[]
      } 
    },
    //métodos para escuchar cambios y ejecutarse
    computed:{

    },
    methods: {
      limpiarCriterios(){
         this.fillCrearUsuario.cPrimerNombre='',
         this.fillCrearUsuario.cSegundoNombre='',
         this.fillCrearUsuario.cApellido='',
         this.fillCrearUsuario.cUsuario='',
         this.fillCrearUsuario.cCorreo='',
         this.fillCrearUsuario.cContrasena='',
         this.fillCrearUsuario.oFotografia=''
      },
      abrirModal(){
        this.modalShow = !this.modalShow;
      },
      getFile(e){
        this.fillCrearUsuario.oFotografia = e.target.files[0];
      },
      setRegistrarUsuarios(){
        if(this.validarRegistrarUsuario()){
          this.modalShow = true;
          return;
        }
        this.fullscreenLoading = true;
        if(!this.fillCrearUsuario.oFotografia || this.fillCrearUsuario.oFotografia == undefined){
          this.setGuardarUsuario(0);
        } else{
          this.setRegistrarArchivo();
        }
      },
      setRegistrarArchivo(){
        this.form.append('file', this.fillCrearUsuario.oFotografia)
        const config = {headers:{'Content-Type': 'multipart/form-data'}}
        var url = '/archivo/setRegistrarArchivo'
        axios.post(url,this.form,config).then(response=>{
          // console.log(response)
          var nIdFile = response.data[0].nIdFile;
          this.setGuardarUsuario(nIdFile);
        })
      },
      setGuardarUsuario(nIdFile){
        var url = '/administracion/usuario/setRegistrarUsuarios'
        axios.post(url,{
          'cPrimerNombre' : this.fillCrearUsuario.cPrimerNombre,
          'cSegundoNombre' : this.fillCrearUsuario.cSegundoNombre,
          'cApellido' : this.fillCrearUsuario.cApellido,
          'cUsuario' : this.fillCrearUsuario.cUsuario,
          'cCorreo' : this.fillCrearUsuario.cCorreo,
          'cContrasena' : this.fillCrearUsuario.cContrasena,
          'oFotografia' : nIdFile
        }).then(response=>{
          console.log("Usuario registrado exitosamente");
          this.fullscreenLoading = false;
          this.$router.push('/usuarios');
        })
      },
      validarRegistrarUsuario(){
        this.error = 0;
        this.mensajeError = [];

        if(!this.fillCrearUsuario.cPrimerNombre){
          this.mensajeError.push("El Primer Nombre es un campo obligatorio")
        }
        if(!this.fillCrearUsuario.cApellido){
          this.mensajeError.push("El Apellido es un campo obligatorio")
        }
        if(!this.fillCrearUsuario.cUsuario){
          this.mensajeError.push("El nombre de Usuario es un campo obligatorio")
        }
        if(!this.fillCrearUsuario.cCorreo){
          this.mensajeError.push("El Email es un campo obligatorio")
        }
        if(!this.fillCrearUsuario.cContrasena){
          this.mensajeError.push("Debe ingresar una contraseña")
        }

        if(this.mensajeError.length){
          this.error = 1;          
        }

        return this.error;
      }
    }
  }

</script>

<style>

</style>