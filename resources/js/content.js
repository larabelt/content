import PageIndex from './components/page/page-index';
import PageEdit  from './components/page/page-edit';

export default class OhioContent {

    constructor() {

        if ($('#content-vue').length > 0) {

            const router = new VueRouter({
                routes: [
                    {path: '/pages', component: PageIndex, canReuse: false, name: 'pageIndex'},
                    {path: '/pages/edit/:id', component: PageEdit, name: 'pageEdit'},
                ],
                mode: 'history',
                base: '/admin/ohio/content'
            });

            const app = new Vue({router}).$mount('#content-vue');
        }
    }

}