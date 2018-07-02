import list from 'belt/content/js/lists/edit/shared';
import Form from 'belt/content/js/lists/edit/items/form';
import html from 'belt/content/js/lists/edit/items/create/template.html';

export default {
    data() {
        return {
            list_id: this.$route.params.id,
            morphable_type: 'list_items',
            morphable_id: this.$route.params.item_id,
            form: new Form({list_id: this.$route.params.id}),
        }
    },
    mounted() {

    },
    methods: {
        submit() {
            Events.$emit('list_items:' + this.morphable_id + ':saving', this.form);
            this.form.submit()
                .then((response) => {
                    this.$router.push({name: 'lists.items.edit', params: {id: this.list_id, item_id: response.id}})
                });
        },
    },
    template: html,
}