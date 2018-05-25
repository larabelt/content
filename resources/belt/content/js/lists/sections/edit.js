// components
import shared from 'belt/content/js/sectionables/ctlr/shared';

// helpers
import Form from 'belt/content/js/lists/form';
import Table from 'belt/content/js/lists/table';

// templates
import edit_html from 'belt/content/js/lists/sections/edit.html';

export default {
    mixins: [shared],
    data() {
        return {
            table: new Table({query: {perPage: 20}}),
            list: new Form(),
        }
    },
    mounted() {
        if (this.section.sectionable_id) {
            console.log(111);
            this.list.show(this.section.sectionable_id)
                .then(() => {
                    console.log(222);
                    console.log(this.list);
                });
        }
    },
    methods: {
        update(id)
        {
            let form = this.active;
            let list = this.list;
            let table = this.table;

            form.sectionable_id = id;

            form.submit()
                .then(function () {
                    table.query.q = '';
                    table.items = [];
                    list.show(form.sectionable_id);
                });
        }
    },
    template: edit_html
}