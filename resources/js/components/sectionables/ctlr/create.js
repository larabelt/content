import shared from 'belt/content/js/components/sectionables/ctlr/shared';

// helpers
import Form from 'belt/content/js/components/sectionables/form';

// templates
import create_html from 'belt/content/js/components/sectionables/templates/create.html';

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
    methods: {
        create(type)
        {
            this.form.sectionable_type = type;
            if (this.creating.position == 'in') {
                this.form.parent_id = this.creating.neighbor_id;
            }

            console.log(111);
            this.form.submit()
                .then(() => {
                    console.log(this.form.id);
                    console.log(999);
                    if (this.creating.position == 'before' || this.creating.position == 'after') {
                        this.moving.show(this.form.id)
                            .then(() => {
                                this.move(this.creating.neighbor_id, this.creating.position)
                                    .then(() => {
                                        this.postCreate(this.form.id);
                                    });

                            })
                    } else {
                        this.postCreate(this.form.id);
                    }
                });
        },
        postCreate(id) {
            this.reset()
                .then(() => {
                    this.setActive(id);
                    this.form.reset();
                });
        }
    },
    template: create_html
}