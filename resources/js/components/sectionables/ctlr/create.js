// helpers
import Form from '../form';

// templates
import create_html from '../templates/create.html';

export default {
    props: {
        section: {}
    },
    data() {
        return {
            config: this.$parent.config,
            form: new Form(),
            show: false,
            table: this.$parent.table,
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
                form.page_id = this.section.page_id;
            } else {
                form.page_id = this.$parent.morphable_id;
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