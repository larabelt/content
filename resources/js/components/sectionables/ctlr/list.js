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
        if (!this.panels.active) {
            this.panels.active = this.section.id;
        }
    },
    computed: {
        isActivePanel() {
            return this.panels.active == this.section.id;
        },
        dropClasses() {
            let classes = ['item-' + this.section.sectionable_type];
            if (this.panels.active == this.section.id) {
                classes.push('active');
            }
            if (this.dragAndDrop.dropping.id == this.section.id) {
                classes.push('dropping');
                classes.push('dropping-' + this.dragAndDrop.dropping.position);
            }
            return classes.join(' ');
        }
    },
    methods: {
        setActivePanel() {
            this.panels.active = this.section.id;
        },
        drag(e) {
            this.dragAndDrop.active = e.target.getAttribute('data-id');
            this.dragAndDrop.dragging.id = e.target.getAttribute('data-id');
            this.dragAndDrop.dragging.type = e.target.getAttribute('data-type');
        },
        drop(e) {

            let table = this.table;
            let tree = this.tree;
            let dragAndDrop = this.dragAndDrop;

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

            if (dropping_id == this.dragAndDrop.active) {
                return;
            }

            this.dragAndDrop.dropping.id = dropping_id;

            let dropping_type = e.target.getAttribute('data-type');

            if (dropping_type == 'after') {
                this.dragAndDrop.dropping.position = 'after';
            } else if ((e.offsetY / e.target.clientHeight) < .5) {
                this.dragAndDrop.dropping.position = 'before';
            } else if (dropping_type == 'sections') {
                this.dragAndDrop.dropping.position = 'in';
            } else {
                this.dragAndDrop.dropping.position = 'after';
            }
        },
        dragleave(e) {
            this.dragAndDrop.dropping.id = '';
            this.dragAndDrop.dropping.position = '';
            this.dragAndDrop.dragging.type = '';
        },
    },
    template: list_html
}