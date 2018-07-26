import Form from 'belt/content/js/blocks/form';
import config from 'belt/core/js/configs/store/local';
import params from 'belt/core/js/paramables/store';

export default {
    namespaced: true,
    modules: {
        config,
        params,
    },
    state: {
        form: new Form(),
    },
    mutations: {
        form: (state, form) => state.form = form,
    },
    actions: {
        construct: ({dispatch, commit}, options) => {
            dispatch('config/set', {entity_type: 'blocks'});
            dispatch('params/set', {entity_type: 'blocks', entity_id: options.id});
        },
        load: ({commit, dispatch, state}, blockID) => {
            return new Promise((resolve, reject) => {
                state.form.show(blockID)
                    .then(response => {
                        dispatch('config/set', {configKey: response.subtype});
                        dispatch('config/load');
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    })
            });
        },
        form: (context, form) => context.commit('form', form),
    },
    getters: {
        form: state => state.form,
    }
};