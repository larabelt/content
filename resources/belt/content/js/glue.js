import terms  from 'belt/content/js/terms/routes';
import store from 'belt/core/js/store/index';

window.larabelt.content = _.get(window, 'larabelt.content', {});

export default class BeltContent {

    constructor() {

        if ($('#belt-content').length > 0) {

            const router = new VueRouter({
                mode: 'history',
                base: '/admin/belt/content',
                routes: []
            });

            router.addRoutes(terms);

            const app = new Vue({router, store}).$mount('#belt-content');
        }
    }

}