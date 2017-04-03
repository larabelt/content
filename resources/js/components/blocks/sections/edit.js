// components
import shared from 'belt/content/js/components/sectionables/ctlr/shared';

// helpers
import Form from '../form';
import Table from '../table';

// templates
import edit_html from './edit.html';

export default {
    mixins: [shared],
    data() {
        return {
            table: new Table({query: {perBlock: 5}}),
            block: new Form(),
        }
    },
    mounted() {
        if (this.section.sectionable_id) {
            this.block.show(this.section.sectionable_id);
        }
    },
    methods: {
        update(id)
        {
            let form = this.active;
            let block = this.block;
            let table = this.table;
            let self = this.self;

            form.sectionable_id = id;

            form.submit()
                .then(function () {
                    table.query.q = '';
                    table.items = [];
                    block.show(form.sectionable_id);
                });
        }
    },
    template: edit_html
}