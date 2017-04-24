import shared from '../ctlr/shared';

// components
import Table from './table';
import Form from './form';

// templates
import params_html from './params.html';

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
    template: params_html,
}