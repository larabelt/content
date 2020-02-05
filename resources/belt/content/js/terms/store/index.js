import config from 'belt/core/js/configs/store/local';
import params from 'belt/core/js/paramables/store';

/**
 * Terms
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
            dispatch('config/set', {entity_type: 'terms'});
            dispatch('params/set', {entity_type: 'terms', entity_id: options.id});
        },
        data: (context, value) => context.commit('data', value),
        load: ({dispatch, commit}, term) => {
            commit('data', term.data());
            dispatch('config/set', {configKey: term.subtype});
            dispatch('config/load');
        },
    },
    getters: {
        config: state => state.config,
        data: state => state.data,
    }
};