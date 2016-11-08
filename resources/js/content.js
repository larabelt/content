import handleIndex from './components/handle/ctlr-index';
import handleCreate from './components/handle/ctlr-create';
import handleEdit  from './components/handle/ctlr-edit';
import pageIndex from './components/page/ctlr-index';
import pageCreate from './components/page/ctlr-create';
import pageEdit  from './components/page/ctlr-edit';

export default class OhioContent {

    constructor() {

        if ($('#ohio-content').length > 0) {

            const router = new VueRouter({
                mode: 'history',
                base: '/admin/ohio/content',
                routes: [
                    {path: '/handles', component: handleIndex, canReuse: false, name: 'handleIndex'},
                    {path: '/handles/create', component: handleCreate, name: 'handleCreate'},
                    {path: '/handles/edit/:id', component: handleEdit, name: 'handleEdit'},
                    {path: '/pages', component: pageIndex, canReuse: false, name: 'pageIndex'},
                    {path: '/pages/create', component: pageCreate, name: 'pageCreate'},
                    {path: '/pages/edit/:id', component: pageEdit, name: 'pageEdit'},
                ]
            });

            const app = new Vue({router}).$mount('#ohio-content');
        }
    }

}