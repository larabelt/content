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
                    {path: '/pages', component: pageIndex, canReuse: false, name: 'pageIndex'},
                    {path: '/pages/create', component: pageCreate, name: 'pageCreate'},
                    {path: '/pages/edit/:id', component: pageEdit, name: 'pageEdit'},
                ]
            });

            const app = new Vue({router}).$mount('#ohio-content');
        }
    }

}