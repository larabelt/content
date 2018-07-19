import shared from 'belt/content/js/sectionables/ctlr/shared';

// helpers
import Form from 'belt/content/js/sectionables/form';

// templates
import create_html from 'belt/content/js/sectionables/templates/create.html';

export default {
    mixins: [shared],
    data() {
        return {
            show: false,
            activeGroup: false,
            form: new Form({
                entity_id: this.$parent.entity_id,
                entity_type: this.$parent.entity_type,
            }),
        }
    },
    computed: {
        templateGroups() {

            let options = [];
            let templates = _.get(this.configs, 'sections', {});

            _.forOwn(templates, function (template, key) {
                options.push({
                    value: key,
                    label: template.label ? template.label : key,
                });
            });

            options = _.orderBy(options, ['label']);

            return options;
        },
        templates() {

            let options = [];
            let templates = _.get(this.configs, 'sections.' + this.activeGroup, {});

            _.forOwn(templates, (template, key) => {
                template.name = this.activeGroup + '.' + key;
                template.label = template.label ? template.label : key;
                options.push(template);
            });

            options = _.orderBy(options, ['label']);

            return options;
        },
    },
    mounted() {
    },
    methods: {
        create(template) {

            //this.form.sectionable_type = type;
            this.form.template = template;

            if (this.creating.position == 'in') {
                this.form.parent_id = this.creating.neighbor_id;
            }

            this.form.submit()
                .then(() => {
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