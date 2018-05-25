import edit from 'belt/content/js/lists/edit/shared';
import filterSearch from 'belt/content/js/inputs/filter-search';
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
                    table: new Table({
                        morphable_type: 'lists',
                        morphable_id: this.morphable_id,
                    }),
                }
            },
            mounted() {
                this.table.index();
            },
            methods: {
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