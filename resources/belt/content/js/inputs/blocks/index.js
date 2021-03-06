import shared from 'belt/core/js/inputs/shared';
import BlockTable from 'belt/content/js/blocks/table';
import BlockForm from 'belt/content/js/blocks/form';
import html from 'belt/content/js/inputs/blocks/template.html';

export default {
    mixins: [shared],
    data() {
        return {
            block: new BlockForm(),
            blocks: new BlockTable({query: {perPage: 20}}),
        };
    },
    created() {
        this.config.label = _.get(this.config, 'label', 'Block');
        this.config.description = _.get(this.config, 'description', 'Use the search field to find blocks that can be linked to this item.');
        this.$watch('form.' + this.column, function (newValue) {
            if (newValue) {
                this.block.show(newValue);
            }
        });
    },
    mounted() {
        if (this.value) {
            this.block.show(this.value);
        }
    },
    methods: {
        clear() {
            this.blocks.query.q = '';
        },
        unlink() {
            this.form[this.column] = null;
            this.block.reset();
        },
        update(id) {
            this.form[this.column] = id;
            this.clear();
            this.emitEvent();
        },
    },
    components: {},
    template: html
}