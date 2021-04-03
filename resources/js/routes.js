import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
    routes:[
        {path: '/', component:require('./components/modulos/dashboard/index').default},
        {path: '/agenda', component:require('./components/modulos/agenda/index').default},
        {path: '/categorias', component:require('./components/modulos/categoria/index').default},
        {path: '/productos', component:require('./components/modulos/producto/index').default},
       
        {path: '/usuarios', component:require('./components/modulos/usuario/index').default},
        {path: '/usuarios/crear', component:require('./components/modulos/usuario/create').default},

        {path: '/roles', component:require('./components/modulos/rol/index').default},
    ],
    mode:'history',
    linkActiveClass: 'active'
})