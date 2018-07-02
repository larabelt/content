import list from 'belt/content/js/lists/edit/shared';
import Form from 'belt/content/js/lists/edit/items/form';
import html from 'belt/content/js/lists/edit/items/edit/template.html';

export default {
    mixins: [list],
    components: {
        edit: {
            data() {
                return {
                    list_id: this.$route.params.id,
                    reloading: false,
                    morphable_type: 'list_items',
                    morphable_id: this.$route.params.item_id,
                    form: new Form({list_id: this.$route.params.id}),
                }
            },
            mounted() {
                this.form.show(this.morphable_id);
            },
            methods: {
                close() {
                    this.$router.push({name: 'lists.items', params: {id: this.list_id}});
                },
                submit() {
                    Events.$emit('list_items:' + this.morphable_id + ':updating', this.form);
                    this.reloading = true;
                    this.form.submit()
                        .then(() => {
                            this.$store.dispatch('params/list_items' + this.morphable_id + '/load')
                                .then(() => {
                                    this.reloading = false;
                                });
                        });
                },
            },
            template: html,
        }
    },
}