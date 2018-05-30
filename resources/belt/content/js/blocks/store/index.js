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
            dispatch('config/set', {morphType: 'blocks'});
            dispatch('params/set', {morphType: 'blocks', morphID: options.id});
        },
        load: ({commit, dispatch, state}, blockID) => {
            return new Promise((resolve, reject) => {
                state.form.show(blockID)
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