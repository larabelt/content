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
    methods: {
        create(type)
        {
            let self = this;

            self.form.sectionable_type = type;
            if (self.creating.position == 'in') {
                self.form.parent_id = self.creating.neighbor_id;
            }

            self.form.submit()
                .then(function () {
                    if (self.creating.position == 'before' || self.creating.position == 'after') {
                        self.moving.show(self.form.id)
                            .then(function () {
                                self.move(self.creating.neighbor_id, self.creating.position)
                                    .then(function () {
                                        self.postCreate(self.form.id);
                                    });

                            })
                    } else {
                        self.postCreate(self.form.id);
                    }
                });
        },
        postCreate(id) {
            let self = this;
            self.reset()
                .then(function () {
                    self.setActive(id);
                    self.form.reset();
                });
        }
    },
    template: create_html
}