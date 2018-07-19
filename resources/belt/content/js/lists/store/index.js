import Form from 'belt/content/js/lists/form';
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
            dispatch('config/set', {entity_type: 'lists'});
            dispatch('params/set', {entity_type: 'lists', entity_id: options.id});
        },
        load: ({commit, dispatch, state}, listID) => {
            return new Promise((resolve, reject) => {
                state.form.show(listID)
                    .then(response => {
                        dispatch('config/set', {configKey: response.template});
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