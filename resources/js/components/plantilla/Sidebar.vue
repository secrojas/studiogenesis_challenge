<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
       
        <a href="../../index3.html" class="brand-link">
            <img :src="ruta + '/img/icon.png'"
                alt="StudioGenesis"
                class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">StudioGenesis</span>
        </a>
       
        <div class="sidebar">
        
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img :src="ruta + '/img/profile.png'" class="img-circle elevation-2" alt="Sebastian Rojas">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{usuario.fullname}}</a>
                </div>
            </div>

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">                
                <div class="info">
                    <a href="#" class="d-block" @click.prevent="logout" v-loading.fullscreen.lock="fullscreenLoading">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión                        
                    </a>
                </div>
            </div>

        
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <router-link class="nav-link active" :to="'/'">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard                        
                        </p>
                    </router-link>               
                </li>
            
                <li class="nav-header">OPERACIONES</li>
                <li class="nav-item">
                    <router-link class="nav-link" :to="'/agenda'">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Agenda                    
                        </p>
                    </router-link> 
                </li>                      
                <li class="nav-header">CONFIGURACION</li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="'/categorias'">
                            <i class="nav-icon fas fa-file"></i>
                            <p>Categorias</p>
                        </router-link> 
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="'/productos'">
                            <i class="nav-icon fas fa-file"></i>
                            <p>Productos</p>
                        </router-link> 
                    </li>
                <li class="nav-header">ADMINISTRACIÓN</li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="'/usuarios'">
                            <i class="nav-icon fas fa-file"></i>
                            <p>Usuarios</p>
                        </router-link> 
                    </li>                                       
                </ul>
            </nav>
      
        </div>
       
    </aside>
</template>

<script>
    export default {
        props:['ruta', 'usuario'],
        data() {
            return {
                fullscreenLoading: false
            }
        },
        methods: {
            logout(){
                this.fullscreenLoading = true;
                var url = 'authenticate/logout'
                axios.post(url).then(response => {
                    if (response.data.code == 204){
                        this.$router.push({'name': 'login'})
                        location.reload();
                        this.fullscreenLoading = false;
                    }                    
                })
            }
        }
    }
</script>

<style>

</style>