import Form from 'belt/content/js/clippables/form';
import Table from 'belt/content/js/clippables/table';

export default {
    namespaced: true,
    state: {
        active: new Form(),
        attached: [],
        mode: 'list',
        entity_id: '',
        entity_type: '',
        table: new Table(),
    },
    mutations: {
        active: (state, active) => state.active = active,
        attached: (state, attached) => state.attached = attached,
        mode: (state, mode) => state.mode = mode,
        entity_id: (state, entity_id) => state.entity_id = entity_id,
        entity_type: (state, entity_type) => state.entity_type = entity_type,
        table: (state, table) => state.table = table,
    },
    actions: {
        active: ({commit, state}, attachment) => {
            let form = new Form({entity_type: state.entity_type, entity_id: state.entity_id});
            form.setData(attachment);
            commit('active', form);
        },
        attach: ({commit, state}, attachment) => {

            let form = new Form({entity_type: state.entity_type, entity_id: state.entity_id});
            form.setData({id: attachment.id});

            return new Promise((resolve, reject) => {
                form.store()
                    .then(response => {
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    })
            });

        },
        attached: (context, attached) => context.commit('attached', attached),
        construct: ({commit, state}, attachment) => {
            let table = new Table({entity_type: state.entity_type, entity_id: state.entity_id});
            commit('table', table);
        },
        detach: ({commit, state}, id) => {

            let form = new Form({entity_type: state.entity_type, entity_id: state.entity_id});

            return new Promise((resolve, reject) => {
                form.destroy(id)
                    .then(response => {
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    })
            });
        },
        load: ({commit, state}) => {

            /**
             * Just get attachment ids for convenience
             */
            commit('attached', []);
            let table = new Table({entity_type: state.entity_type, entity_id: state.entity_id});
            table.query.fields = 'attachment_id';
            table.index()
                .then((response) => {
                    commit('attached', response);
                });

            return new Promise((resolve, reject) => {
                state.table.index()
                    .then(response => {
                        //commit('data', response.data);
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    })
            });
        },
        move: ({commit, state}, params) => {

            let form = new Form({entity_type: state.entity_type, entity_id: state.entity_id});

            form.setData({
                id: state.active.id,
                move: params.type,
                position_entity_id: params.target.id
            });

            return new Promise((resolve, reject) => {
                form.submit()
                    .then(response => {
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    })
            });
        },
        set: (context, options) => {
            if (options.mode) {
                context.commit('mode', options.mode);
            }
            if (options.entity_type) {
                context.commit('entity_type', options.entity_type);
            }
            if (options.entity_id) {
                context.commit('entity_id', options.entity_id);
            }
        },
    },
    getters: {
        active: state => state.active,
        attached: state => state.attached,
        mode: state => state.mode,
        entity_id: state => state.entity_id,
        entity_type: state => state.entity_type,
        table: state => state.table,
    }
};