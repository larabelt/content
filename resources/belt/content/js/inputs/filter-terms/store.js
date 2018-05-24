import Table from 'belt/content/js/terms/table';

export default {
    namespaced: true,
    state: {
        attached: {},
        detached: new Table(),
        terms: new Table(),
        needle: '',
        morphable_type: '',
        morphable_id: '',
    },
    mutations: {
        emptyDetached: (state) => {
            state.needle = '';
            state.detached.empty();
        },
        morphableType: (state, morphable_type) => {
            state.morphable_type = morphable_type;
            state.detached.morphable_type = morphable_type;
        },
        morphableId: (state, morphable_id) => {
            state.morphable_id = morphable_id;
            state.detached.morphable_id = morphable_id;
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
        morphableType: (context, morphable_type) => context.commit('morphableType', morphable_type),
        morphableId: (context, morphable_id) => context.commit('morphableId', morphable_id),
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