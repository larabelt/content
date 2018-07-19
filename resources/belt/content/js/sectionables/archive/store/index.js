import config from 'belt/core/js/configs/store/local';
import params from 'belt/core/js/paramables/store';

/**
 * Sections
 */
export default {
    namespaced: true,
    modules: {
        config,
        params,
    },
    state() {
        return {
            data: {},
        }
    },
    mutations: {
        config: (state, value) => state.config = value,
        data: (state, value) => state.data = value,
    },
    actions: {
        config: (context, value) => context.commit('config', value),
        construct: ({dispatch}, options) => {
            dispatch('params/set', {entity_type: 'sections', entity_id: options.id});
        },
        data: (context, value) => context.commit('data', value),
        load: ({dispatch, commit}, section) => {
            commit('data', section.data());
            dispatch('config/set', {entity_type: 'sections', configKey: section.template});
            dispatch('config/load');
        },
    },
    getters: {
        config: state => state.config,
        data: state => state.data,
    }
};