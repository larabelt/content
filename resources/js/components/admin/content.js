import HandleIndex from './handle/ctlr-index';
import HandleCreate from './handle/ctlr-create';
import HandleEdit  from './handle/ctlr-edit';
import PageIndex from './page/ctlr-index';
import PageCreate from './page/ctlr-create';
import PageEdit  from './page/ctlr-edit';

export default class OhioContent {

    constructor() {

        if ($('#content-vue').length > 0) {

            const router = new VueRouter({
                mode: 'history',
                base: '/admin/ohio/content',
                routes: [
                    {path: '/handles', component: HandleIndex, canReuse: false, name: 'handleIndex'},
                    {path: '/handles/create', component: HandleCreate, name: 'handleCreate'},
                    {path: '/handles/edit/:id', component: HandleEdit, name: 'handleEdit'},
                    {path: '/pages', component: PageIndex, canReuse: false, name: 'pageIndex'},
                    {path: '/pages/create', component: PageCreate, name: 'pageCreate'},
                    {path: '/pages/edit/:id', component: PageEdit, name: 'pageEdit'},
                ]
            });

            const app = new Vue({router}).$mount('#content-vue');
        }
    }

}