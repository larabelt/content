import PageIndex from './components/page/page-index';

export default class OhioContent {

    constructor() {

        if ($('#content-vue').length > 0) {

            const router = new VueRouter({
                routes: [
                    {path: '/pages', component: PageIndex, canReuse: false},
                ],
                mode: 'history',
                base: '/admin/ohio/content'
            });

            const app = new Vue({router}).$mount('#content-vue');
        }
    }

}