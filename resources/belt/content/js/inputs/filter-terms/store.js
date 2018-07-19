import Table from 'belt/content/js/terms/table';

export default {
    namespaced: true,
    state: {
        attached: {},
        detached: new Table(),
        terms: new Table(),
        needle: '',
        entity_type: '',
        entity_id: '',
    },
    mutations: {
        emptyDetached: (state) => {
            state.needle = '';
            state.detached.empty();
        },
        morphableType: (state, entity_type) => {
            state.entity_type = entity_type;
            state.detached.entity_type = entity_type;
        },
        morphableId: (state, entity_id) => {
            state.entity_id = entity_id;
            state.detached.entity_id = entity_id;
        },
        needle: (state, needle) => state.needle = needle,
        push: (state, term) => {
            Vue.set(state.attached, term.id, term);
        },
        remove: (state, term) => Vue.delete(state.attached, term.id, term),
        search: (state) => {
            state.detached.query.q = state.needle;
            state.detached.query.not_in = _.map(state.attached, 'id').join(",");
            state.detached.index();
        },
        queryToAttached: (state, query) => {
            state.terms.query.in = query;
            state.terms.index()
                .then(() => {
                    let terms = state.terms.items;
                    for (let i = 0; i < terms.length; i++) {
                        let term = terms[i];
                        Vue.set(state.attached, term.id, term);
                    }
                });
        },
    },
    actions: {
        emptyDetached: (context) => context.commit('emptyDetached'),
        morphableType: (context, entity_type) => context.commit('morphableType', entity_type),
        morphableId: (context, entity_id) => context.commit('morphableId', entity_id),
        needle: (context, needle) => context.commit('needle', needle),
        push: (context, term) => {
            context.commit('push', term);
            context.commit('search');
        },
        remove: (context, term) => context.commit('remove', term),
        search: (context) => context.commit('search'),
        queryToAttached: (context, query) => {
            context.commit('queryToAttached', query);
        }
    },
    getters: {
        attached: state => {
            return state.attached;
        },
        detached: state => {
            return state.detached.items;
        },
        hasAttached: state => {
            return !_.isEmpty(state.attached);
        },
        hasDetached: state => {
            return state.detached.items.length;
        },
        needle: state => {
            return state.needle;
        },
        query: state => {
            return _.map(state.attached, 'id').join(",");
        },
    }
}