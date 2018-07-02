import attachments from 'belt/content/js/attachments/routes';
import blocks from 'belt/content/js/blocks/routes';
import handles from 'belt/content/js/handles/routes';
import lists from 'belt/content/js/lists/routes';
import pages from 'belt/content/js/pages/routes';
import posts from 'belt/content/js/posts/routes';
import store from 'belt/core/js/store/index';
import terms from 'belt/content/js/terms/routes';

import seo from 'belt/content/js/base/seo';
import templateDropdown from 'belt/content/js/templates';

Vue.component('seo', seo);
Vue.component('template-dropdown', templateDropdown);

import inputAttachments from 'belt/content/js/inputs/attachments';
import inputBlocks from 'belt/content/js/inputs/blocks';
import inputPages from 'belt/content/js/inputs/pages';

Vue.component('input-attachments', inputAttachments);
Vue.component('input-blocks', inputBlocks);
Vue.component('input-pages', inputPages);

import tilePages from 'belt/content/js/pages/tile';

Vue.component('tile-pages', tilePages);

window.larabelt.content = _.get(window, 'larabelt.content', {});

export default class BeltContent {

    constructor() {

        if ($('#belt-content').length > 0) {

            const router = new VueRouter({
                mode: 'history',
                base: '/admin/belt/content',
                routes: []
            });

            router.addRoutes(attachments);
            router.addRoutes(blocks);
            router.addRoutes(handles);
            router.addRoutes(lists);
            router.addRoutes(pages);
            router.addRoutes(posts);
            router.addRoutes(terms);

            const app = new Vue({router, store}).$mount('#belt-content');
        }
    }

}