import Form from 'belt/content/js/terms/form';
import Table from 'belt/content/js/terms/table';
import TreeForm from 'belt/content/js/terms/tree';
import index_html from 'belt/content/js/terms/templates/index.html';

export default {
    props: {
        confirm_btn: {default: false},
        full_admin: {default: true},
        filter: {default: true},
    },
    data() {
        return {
            loading: false,
            moving: new Form(),
            table: new Table({router: this.$router}),
        }
    },
    computed: {
        isMoving() {
            return this.moving.id;
        },
    },
    methods: {
        cancelMove() {
            this.moving.reset();
        },
        move(id, position) {
            return new Promise((resolve, reject) => {

                let tree = new TreeForm({term: this.moving});

                tree.setData({
                    neighbor_id: id,
                    move: position,
                });

                tree.submit()
                    .then(() => {
                        this.moving.reset();
                        this.table.index();
                        resolve();
                    })
                    .catch(() => {
                        reject();
                    });
            });
        },
        parentCheck(term) {
            let output = `<b>${term.name}</b>`;

            if (term.hierarchy.length > 1) {
                output = '';
                term.hierarchy.forEach((item, index) => {
                    let name = `(${item.id}) ${item.name} > `;

                    if (index == term.hierarchy.length - 1) {
                        name = `<b>${item.name}</b>`;
                    }
                    output = output + name;
                });
            }

            return output;
        },
        setMoving(id) {
            if (!this.moving.id) {
                this.moving.show(id);
            } else {
                this.moving.reset();
            }
        },
    },
    mounted() {
        this.table.updateQueryFromRouter();
        this.loading = true;
        this.table.index()
            .then(() => {
                this.loading = false;
            });
    },
    template: index_html,
}