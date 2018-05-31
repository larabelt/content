import edit from 'belt/content/js/lists/edit/shared';
import filterSearch from 'belt/core/js/inputs/filter-search';
import filterType from 'belt/content/js/lists/edit/related/filters/type';
import Table from 'belt/content/js/lists/edit/related/table';
import rowItem from 'belt/content/js/lists/edit/related/row-item';
import html from 'belt/content/js/lists/edit/related/template.html';

export default {
    mixins: [edit],
    components: {
        edit: {
            props: {
                morphable_type: {
                    default: function () {
                        return this.$parent.morphable_type;
                    }
                },
                morphable_id: {
                    default: function () {
                        return this.$parent.morphable_id;
                    }
                },
            },
            data() {
                return {
                    highlighted: {},
                    moving_id: null,
                    table: new Table({
                        morphable_type: 'lists',
                        morphable_id: this.morphable_id,
                    }),
                }
            },
            computed: {
                hasHighlighted() {
                    return !_.isEmpty(this.highlighted);
                },
            },
            mounted() {
                this.table.index();
            },
            methods: {
                cancelMove() {
                    this.moving_id = null;
                },
                completeMove() {
                    this.moving_id = null;
                    this.table.index();
                },
                detach() {
                    for (let id in this.highlighted) {
                        this.table.destroy(id).then(() => {
                            this.table.index();
                        });
                    }
                },
                filter: _.debounce(function (query) {
                    if (query) {
                        query.page = 1;
                        this.table.updateQuery(query);
                    }
                    this.table.index()
                        .then(() => {
                            this.table.pushQueryToHistory();
                            this.table.pushQueryToRouter();
                        });
                }, 300),
                highlight(id) {
                    if (_.has(this.highlighted, id)) {
                        Vue.delete(this.highlighted, id);
                    } else {
                        Vue.set(this.highlighted, id, true);
                    }
                },
                startMove(id) {
                    this.moving_id = id;
                },
            },
            components: {
                filterSearch,
                filterType,
                rowItem,
            },
            template: html
        },
    },
}