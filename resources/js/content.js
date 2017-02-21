import blocks  from './components/blocks/routes';
import pages  from './components/pages/routes';
import store from 'belt/core/js/store/index';

export default class BeltContent {

    constructor() {

        if ($('#belt-content').length > 0) {

            const router = new VueRouter({
                mode: 'history',
                base: '/admin/belt/content',
                routes: []
            });

            router.addRoutes(blocks);
            router.addRoutes(pages);

            const app = new Vue({router, store}).$mount('#belt-content');
        }
    }

}