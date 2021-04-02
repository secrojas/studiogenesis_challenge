<template>
    <div>
        <!--Componente Navbar-->
        <Navbar :ruta="ruta"></Navbar>
        <!--Componente Sidebar-->     
        <Sidebar :ruta="ruta"></Sidebar>
         <!--Componente Content-->     
        <div class="content-wrapper">
            <transition name="slide-fade" mode="out-in">
                <router-view></router-view>
            </transition>
        </div>        
         <!--Componente Footer-->     
        <Footer></Footer>
    </div>    
</template>

<script>
    //importo componentes
    import Navbar from './plantilla/Navbar'
    import Sidebar from './plantilla/Sidebar'
    import Footer from './plantilla/Footer'

    export default {
        props:['ruta'],
        components:{Navbar,Sidebar,Footer}
    }
</script>