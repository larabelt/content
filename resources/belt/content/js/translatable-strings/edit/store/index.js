import Form from 'belt/content/js/translatable-strings/form';
import permissions from 'belt/core/js/permissions/store';

export default {
    namespaced: true,
    modules: {
        permissions,
    },
    state: {
        form: new Form(),
    },
    mutations: {
        form: (state, form) => state.form = form,
    },
    actions: {
        load: ({commit, dispatch, state}, translatableStringID) => {
            dispatch('permissions/construct', {entityType: 'translatableStrings', entityID: translatableStringID});
            return new Promise((resolve, reject) => {
                state.form.show(translatableStringID)
                    .then(response => {
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