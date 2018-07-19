import filter from 'belt/core/js/inputs/filter-base';
import Table from 'belt/content/js/lists/edit/items/table';
import html from 'belt/content/js/lists/edit/items/filters/type/template.html';

export default {
    mixins: [filter],
    props: {},
    data() {
        return {
            groupedItems: new Table({
                entity_type: this.entity_type,
                entity_id: this.entity_id,
            }),
            listable_type: null,
        }
    },
    computed: {
        options() {
            let options = {
                '': '',
            };
            let items = _.uniqBy(this.groupedItems.items, 'listable_type');
            items = _.sortBy(items, [function (o) {
                return o.listable_type ? o.listable_type : 1;
            }]);
            _.forEach(items, (item) => {
                options[item.listable_type] = item.listable_type;
            });
            return options;
        },
        show() {
            return _.size(this.options) > 2;
        }
    },
    mounted() {
        this.groupedItems.updateQuery({
            groupBy: 'listable_type',
        });
        this.groupedItems.index();
    },
    watch: {
        'table.query.listable_type': function (listable_type) {
            if (listable_type) {
                this.listable_type = listable_type;
            }
        }
    },
    methods: {
        change() {
            delete this.table.query.listable_type;
            if (this.listable_type) {
                this.table.updateQuery({listable_type: this.listable_type});
            }
            this.$emit('filter-listable_type-update');
        },
    },
    template: html
}