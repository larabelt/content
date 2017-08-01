import Form from 'belt/content/js/sectionables/form';
import TreeForm from 'belt/content/js/sectionables/tree';

export default {
    props: {
        section: {},
    },
    data() {
        return {
            morphable_id: this.$parent.morphable_id,
            morphable_type: this.$parent.morphable_type,
            active: this.$parent.active,
            configurator: this.$parent.configurator,
            configs: this.$parent.configs,
            creating: this.$parent.creating,
            first: this.$parent.first,
            form: new Form({
                morphable_type: this.$parent.morphable_type,
                morphable_id: this.$parent.morphable_id,
            }),
            moving: this.$parent.moving,
            sections: this.$parent.sections,
            scroll: this.$parent.scroll,
        }
    },
    computed: {
        isBox() {
            return this.section.sectionable_type == 'sections';
        },
        isFirst() {
            return this.section.id == this.first.id;
        },
        isMoving() {
            return this.section.id == this.moving.id;
        },
        config() {
            return _.get(this.configs, `${this.section.sectionable_type}.${this.section.template}`);
        },
        dropdown() {
            if (this.section) {
                return this.configurator.dropdown(this.section.sectionable_type);
            }
            return [];
        },

    },
    methods: {
        close() {
            this.reset();
            window.scrollTo(0, this.scroll.y);
            this.scroll.y = 0;
        },
        getConfig(key, _default) {
            let value = _.get(this.config, key);
            return value ? value : _default;
        },
        isType(type) {
            if (this.section) {
                return this.section.sectionable_type == type;
            }
            return false;
        },
        move(id, position) {
            return new Promise((resolve, reject) => {

                let self = this;
                let tree = new TreeForm({section: this.moving});

                tree.setData({
                    neighbor_id: id,
                    move: position,
                });

                tree.submit()
                    .then(function () {
                        self.reset();
                        resolve();
                    })
                    .catch(function () {
                        reject();
                    });
            });
        },
        reset() {
            return new Promise((resolve, reject) => {
                this.$router.push({params: {section: null}});
                this.active.reset();
                this.moving.reset();
                this.creating.show = false;
                this.creating.neighbor_id = null;
                this.creating.position = null;
                this.sections.index()
                    .then(function () {
                        resolve();
                    })
                    .catch(function () {
                        reject();
                    });
            });

        },
        setActive(id) {
            return new Promise((resolve, reject) => {
                this.$router.push({params: {section: id}});
                this.scroll.y = window.pageYOffset;
                window.scrollTo(0, 0);
                this.active.show(id)
                    .then(function () {
                        resolve();
                    })
                    .catch(function () {
                        reject();
                    });
            });
        },
    },
}