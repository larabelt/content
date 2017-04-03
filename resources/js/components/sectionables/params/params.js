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
        for(let key in this.$parent.config.params) {
            params[key] = new Form({section: this.section});
        }
        return {
            table: new Table({section: this.section}),
            params: params,
        }
    },
    created() {
        let self = this;
        self.table.index()
            .then(function () {
                for(let key in self.table.items) {
                    let item = self.table.items[key];
                    self.params[item.key].show(item.id);
                }
            });
    },
    template: params_html,
}