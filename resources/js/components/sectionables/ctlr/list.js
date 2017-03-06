import shared from './shared';
import TreeForm from '../tree';

// templates
import self from './list';

import list_html from '../templates/list.html';

export default {
    mixins: [shared],
    data() {
        return {
            tree: new TreeForm({section: this.section}),
        }
    },
    beforeCreate: function () {
        this.$options.components.list = self
    },
    mounted() {
        if (!this.shared.panel.active) {
            this.shared.panel.active = this.section.id;
        }
    },
    computed: {
        isActivePanel() {
            return this.shared.panel.active == this.section.id;
        },
        dropClasses() {
            let classes = ['item-' + this.section.sectionable_type];
            if (this.shared.panel.active == this.section.id) {
                classes.push('active');
            }
            if (this.shared.dragAndDrop.dropping.id == this.section.id) {
                classes.push('dropping');
                classes.push('dropping-' + this.shared.dragAndDrop.dropping.position);
            }
            return classes.join(' ');
        }
    },
    methods: {
        setActivePanel() {
            this.shared.panel.active = this.section.id;
        },
        drag(e) {
            this.shared.dragAndDrop.active = e.target.getAttribute('data-id');
            this.shared.dragAndDrop.dragging.id = e.target.getAttribute('data-id');
            this.shared.dragAndDrop.dragging.type = e.target.getAttribute('data-type');
        },
        drop(e) {

            let table = this.shared.table;
            let tree = this.tree;
            let dragAndDrop = this.shared.dragAndDrop;

            if (dragAndDrop.dropping.id == this.section.id) {
                tree.service.baseUrl = `/api/v1/sections/${dragAndDrop.dragging.id}/tree/`;
                tree.setData({
                    neighbor_id: dragAndDrop.dropping.id,
                    move: dragAndDrop.dropping.position,
                });
                tree.submit()
                    .then(function () {
                        table.index();
                    });
            }
        },
        dragover(e) {

            let dropping_id = e.target.getAttribute('data-id');

            if (dropping_id == this.shared.dragAndDrop.active) {
                return;
            }

            this.shared.dragAndDrop.dropping.id = dropping_id;

            let dropping_type = e.target.getAttribute('data-type');

            if (dropping_type == 'after') {
                this.shared.dragAndDrop.dropping.position = 'after';
            } else if ((e.offsetY / e.target.clientHeight) < .5) {
                this.shared.dragAndDrop.dropping.position = 'before';
            } else if (dropping_type == 'sections') {
                this.shared.dragAndDrop.dropping.position = 'in';
            } else {
                this.shared.dragAndDrop.dropping.position = 'after';
            }
        },
        dragleave(e) {
            this.shared.dragAndDrop.dropping.id = '';
            this.shared.dragAndDrop.dropping.position = '';
            this.shared.dragAndDrop.dragging.type = '';
        },
    },
    template: list_html
}