import block from 'belt/content/js/blocks/block';
import Form from 'belt/content/js/blocks/form';
import Table from 'belt/content/js/blocks/table';
import html from 'belt/content/js/blocks/input/template.html';

export default {
    props: ['form'],
    data() {
        return {
            block: new Form(),
            search: false,
            table: new Table(),
        }
    },
    watch: {
        'form.block_id': function (new_block_id) {
            if (new_block_id) {
                this.block.show(new_block_id);
            }
        }
    },
    methods: {
        filter: _.debounce(function (query) {
            this.table.index();
        }, 500),
        toggle() {
            if (!this.search) {
                this.table.index();
            }
            this.search = !this.search;
        },
        clear() {
            this.form.block_id = null;
            this.block.reset();
            this.search = false;
        },
        setBlock(block) {
            this.form.block_id = block.id;
            this.block.setData(block);
            this.search = false;
        }
    },
    components: {
        block
    },
    template: html
}