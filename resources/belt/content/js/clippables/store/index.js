import Vuex from 'vuex';

import clippable from 'belt/content/js/clippables/store/clippable';
import highlighted from 'belt/content/js/clippables/store/highlighted';

Vue.use(Vuex);

export default new Vuex.Store({
    namespaced: false,
    modules: {
        clippable,
        highlighted,
    },
});