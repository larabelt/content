export default {
    namespaced: true,
    state() {
        return {
            handles: [],
        }
    },
    mutations: {
        handles: (state, handles) => state.handles = handles,
        //pushHandle: (state, handle) => state.handles.push(handle),
        pushHandle: (state, handle) => {
            if (!_.find(state.handles, {id: handle.id})) {
                state.handles.push(handle)
            }
        },
    },
    actions: {
        setHandles: (context, handles) => context.commit('handles', handles),
        pushHandle: (context, handle) => context.commit('pushHandle', handle),
    },
    getters: {
        handles: state => state.handles,
    },
}