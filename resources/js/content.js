import blockIndex from './components/block/ctlr-index';
import blockCreate from './components/block/ctlr-create';
import blockEdit  from './components/block/ctlr-edit';
import pageIndex from './components/page/ctlr-index';
import pageCreate from './components/page/ctlr-create';
import pageEdit  from './components/page/ctlr-edit';
import tagIndex from './components/tag/ctlr-index';
import tagCreate from './components/tag/ctlr-create';
import tagEdit  from './components/tag/ctlr-edit';

export default class OhioContent {

    constructor() {

        if ($('#ohio-content').length > 0) {

            const router = new VueRouter({
                mode: 'history',
                base: '/admin/ohio/content',
                routes: [
                    {path: '/blocks', component: blockIndex, canReuse: false, name: 'blockIndex'},
                    {path: '/blocks/create', component: blockCreate, name: 'blockCreate'},
                    {path: '/blocks/edit/:id', component: blockEdit, name: 'blockEdit'},
                    {path: '/pages', component: pageIndex, canReuse: false, name: 'pageIndex'},
                    {path: '/pages/create', component: pageCreate, name: 'pageCreate'},
                    {path: '/pages/edit/:id', component: pageEdit, name: 'pageEdit'},
                    {path: '/tags', component: tagIndex, canReuse: false, name: 'tagIndex'},
                    {path: '/tags/create', component: tagCreate, name: 'tagCreate'},
                    {path: '/tags/edit/:id', component: tagEdit, name: 'tagEdit'},
                ]
            });

            const app = new Vue({router}).$mount('#ohio-content');
        }
    }

}