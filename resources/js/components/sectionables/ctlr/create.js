import shared from './shared';

// helpers
import Form from '../form';

// templates
import create_html from '../templates/create.html';

export default {
    mixins: [shared],
    data() {
        return {
            show: false,
            form: new Form({
                morphable_id: this.$parent.morphable_id,
                morphable_type: this.$parent.morphable_type,
            }),
        }
    },
    mounted() {
      this.reset();
    },
    methods: {
        toggleShow(){
            this.show = this.show ? false : true;
        },
        reset() {
            let form = this.form;
            form.reset();
            if (this.section) {
                form.parent_id = this.section.id;
                form.owner_id = this.section.owner_id;
                form.owner_type = this.section.owner_type;
            } else {
                form.owner_id = this.morphable_id;
                form.owner_type = this.morphable_type;
            }

            form.template = 'default';
        },
        create(type)
        {
            let self = this;
            let form = this.form;
            let table = this.table;

            self.reset();

            form.sectionable_type = type;
            form.submit()
                .then(function () {
                    self.reset();
                    table.index();
                });
        }
    },
    template: create_html
}