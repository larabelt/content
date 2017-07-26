import shared from 'belt/content/js/components/sectionables/ctlr/shared';

// components
import Table from 'belt/content/js/components/sectionables/params/table';
import Form from 'belt/content/js/components/sectionables/params/form';

// templates
import params_html from 'belt/content/js/components/sectionables/params/params.html';

export default {
    mixins: [shared],
    data() {
        let params = {};
        for (let key in this.$parent.config.params) {
            let form = new Form({section: this.section});
            form.setData({
                key: key,
                value: '',
            });
            params[key] = form;
        }
        return {
            saving: false,
            table: new Table({section: this.section}),
            params: params,
        }
    },
    created() {
        this.table.index()
            .then(() => {
                for (let n in this.table.items) {
                    let item = this.table.items[n];
                    if (_.has(this.params, item.key)) {
                        this.params[item.key].show(item.id);
                    }
                }
            });
    },
    methods: {
        update(key) {
            if (!this.saving) {
                this.saving = true;
                this.params[key].submit()
                    .then(() => {
                        this.saving = false;
                    });
            }
        },
    },
    template: params_html,
}