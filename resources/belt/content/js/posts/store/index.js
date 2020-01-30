import config from 'belt/core/js/configs/store/local';
import params from 'belt/core/js/paramables/store';

/**
 * Pages
 */
export default {
    namespaced: true,
    modules: {
        config,
        params,
    },
    state: {
        data: {},
    },
    mutations: {
        config: (state, value) => state.config = value,
        data: (state, value) => state.data = value,
    },
    actions: {
        config: (context, value) => context.commit('config', value),
        construct: ({dispatch, commit}, options) => {
            dispatch('config/set', {entity_type: 'posts'});
            dispatch('params/set', {entity_type: 'posts', entity_id: options.id});
        },
        data: (context, value) => context.commit('data', value),
        load: ({dispatch, commit}, post) => {
            commit('data', post.data());
            dispatch('config/set', {configKey: post.subtype});
            dispatch('config/load');
        },
    },
    getters: {
        config: state => state.config,
        data: state => state.data,
    }
};