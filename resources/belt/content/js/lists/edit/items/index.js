import edit from 'belt/content/js/lists/edit/shared';
import create from 'belt/content/js/lists/edit/items/create';
import filterType from 'belt/content/js/lists/edit/items/filters/type';
import search from 'belt/core/js/search';
import Form from 'belt/content/js/lists/edit/items/form';
import Table from 'belt/content/js/lists/edit/items/table';
import gridItem from 'belt/content/js/lists/edit/items/grid-item';
import rowItem from 'belt/content/js/lists/edit/items/row-item';
import html from 'belt/content/js/lists/edit/items/template.html';

export default {
    mixins: [edit],
    components: {
        edit: {
            props: {
                entity_type: {
                    default: function () {
                        return this.$parent.entity_type;
                    }
                },
                entity_id: {
                    default: function () {
                        return this.$parent.entity_id;
                    }
                },
            },
            data() {
                return {
                    highlighted: {},
                    mode: 'grid',
                    moving_id: null,
                    table: new Table({
                        entity_type: 'lists',
                        entity_id: this.entity_id,
                    }),
                }
            },
            computed: {
                config() {
                    return this.$parent.config;
                },
                hasHighlighted() {
                    return !_.isEmpty(this.highlighted);
                },
                maxListItems() {
                    return _.get(this.config, 'list_items.max', null);
                },
                showCreate() {
                    return this.maxListItems == null || this.table.items.length < this.maxListItems;
                }
            },
            mounted() {
                this.table.index();
                this.mode = History.get('list.list_items', 'mode', 'grid');
            },
            methods: {
                attach(index) {
                    let form = new Form({list_id: this.entity_id});
                    //form.listable_type = index.indexable_type;
                    //form.listable_id = index.indexable_id;

                    form.submit()
                        .then(() => {
                            this.table.index();
                        });
                },
                cancelMove() {
                    this.moving_id = null;
                },
                completeMove() {
                    this.moving_id = null;
                    //this.table.items = [];
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
                setMode(mode) {
                    this.mode = mode;
                    History.set('list.list_items', 'mode', mode);
                },
                startMove(id) {
                    this.moving_id = id;
                },
            },
            components: {
                create,
                search,
                filterType,
                gridItem,
                rowItem,
            },
            template: html
        },
    },
}