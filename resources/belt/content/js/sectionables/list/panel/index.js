import shared from 'belt/content/js/sectionables/shared';

import Form from 'belt/content/js/sectionables/form';
import TreeForm from 'belt/content/js/sectionables/tree';


import self from 'belt/content/js/sectionables/list/panel';
import html from 'belt/content/js/sectionables/list/panel/template.html';

export default {
    mixins: [shared],
    props: {
        section: {},
        table: {
            default: function () {
                return this.$parent.table;
            }
        }
    },
    beforeCreate: function () {
        this.$options.components.panel = self
    },
    data() {
        return {
            active: this.$parent.active,

            form: new Form({
                morphable_type: this.$parent.morphable_type,
                morphable_id: this.$parent.morphable_id,
            }),
            paramable: this.$parent.active,
            sections: this.$parent.sections,
            scroll: this.$parent.scroll,
        }
    },
    computed: {

        first() {
            return this.$parent.first;
        },
        isBox() {
            return this.section.template_subgroup == 'containers';
        },
        isFirst() {
            return this.section.id == this.first.id;
        },
        mode() {
            if (this.moving.id) {
                if (this.section.id == this.moving.id) {
                    return 'is-moving';
                }
                if (this.section._lft >= this.moving._lft && this.section._rgt <= this.moving._rgt) {
                    return 'is-along-for-the-ride';
                }
                return 'is-watching';
            }
            return 'default';
        },
        moving() {
            return this.$parent.moving;
        },
        preview() {
            return _.get(this.section, 'preview');
        },

    },
    methods: {
        cancel() {
            this.reset();
        },
        destroy(id) {
            this.form.destroy(id)
                .then(() => {
                    this.table.index();
                });
        },
        insert(id, position) {

        },
        move(id, position) {
            return new Promise((resolve, reject) => {
                let tree = new TreeForm({
                    section_id: this.moving.id,
                    neighbor_id: id,
                    move: position
                });
                tree.submit()
                    .then(() => {
                        this.reset();
                        resolve();
                    })
                    .catch(() => {
                        reject();
                    });
            });
        },
        reset() {
            return new Promise((resolve, reject) => {
                this.setMoving(null);
                this.table.index()
                    .then(function () {
                        resolve();
                    })
                    .catch(function () {
                        reject();
                    });
            });

        },
        setMoving(section) {
            this.$emit('set-moving', section);
        },
    },
    template: html
}