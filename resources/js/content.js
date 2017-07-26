import blocks  from 'belt/content/js/components/blocks/routes';
import handles  from 'belt/content/js/components/handles/routes';
import pages  from 'belt/content/js/components/pages/routes';
import posts  from 'belt/content/js/components/posts/routes';
import store from 'belt/core/js/store/index';
import touts  from 'belt/content/js/components/touts/routes';

export default class BeltContent {

    constructor() {

        if ($('#belt-content').length > 0) {

            const router = new VueRouter({
                mode: 'history',
                base: '/admin/belt/content',
                routes: []
            });

            router.addRoutes(blocks);
            router.addRoutes(handles);
            router.addRoutes(pages);
            router.addRoutes(posts);
            router.addRoutes(touts);

            const app = new Vue({router, store}).$mount('#belt-content');
        }
    }

}