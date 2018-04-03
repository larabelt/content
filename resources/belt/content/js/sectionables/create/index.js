import shared from 'belt/content/js/sectionables/shared';
import Form from 'belt/content/js/sectionables/form';
import html from 'belt/content/js/sectionables/create/template.html';

export default {
    mixins: [shared],
    data() {
        return {
            activeGroup: false,
            form: new Form({
                morphable_id: this.morphable_id,
                morphable_type: this.morphable_type,
            }),
        }
    },
    mounted() {
        console.log(this.$router.currentRoute);
    },
    computed: {
        templateGroups() {

            let options = [];
            let templates = this.configs ? this.configs : {};

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
            let templates = _.get(this.configs, this.activeGroup, {});

            _.forOwn(templates, (template, key) => {
                template.name = this.activeGroup + '.' + key;
                template.label = template.label ? template.label : key;
                options.push(template);
            });

            options = _.orderBy(options, ['label']);

            return options;
        },
    },
    methods: {
        create(template) {

            this.form.template = template;

            // if (this.creating.position == 'in') {
            //     this.form.parent_id = this.creating.neighbor_id;
            // }

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
    template: html,
}