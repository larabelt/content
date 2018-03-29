import blocks  from 'belt/content/js/blocks/routes';
import handles  from 'belt/content/js/handles/routes';
import pages  from 'belt/content/js/pages/routes';
import posts  from 'belt/content/js/posts/routes';
import store from 'belt/core/js/store/index';
import touts  from 'belt/content/js/touts/routes';

import inputBlock from 'belt/content/js/inputs/block';
import inputTout from 'belt/content/js/inputs/tout';
Vue.component('input-block', inputBlock);
Vue.component('input-tout', inputTout);

window.larabelt.content = _.get(window, 'larabelt.content', {});

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