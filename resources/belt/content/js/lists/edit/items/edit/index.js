import list from 'belt/content/js/lists/edit/shared';
import TranslationStore from 'belt/core/js/translations/store/adapter';
import Form from 'belt/content/js/lists/edit/items/form';
import html from 'belt/content/js/lists/edit/items/edit/template.html';

export default {
    mixins: [list],
    components: {
        edit: {
            mixins: [TranslationStore],
            data() {
                return {
                    reloading: false,
                    entity_type: 'list_items',
                    entity_id: this.$route.params.item_id,
                    form: new Form({list_id: this.$route.params.id}),
                    list_id: this.$route.params.id,
                }
            },
            created() {
                this.bootTranslationStore();
                this.form.show(this.entity_id);
            },
            computed: {
                translatable_type() {
                    return this.entity_type;
                },
                translatable_id() {
                    return this.entity_id;
                },
            },
            methods: {
                close() {
                    this.$router.push({name: 'lists.items', params: {id: this.list_id}});
                },
                submit() {
                    Events.$emit('list_items:' + this.entity_id + ':updating', this.form);
                    this.reloading = true;
                    this.form.submit()
                        .then(() => {
                            this.$store.dispatch('params/list_items' + this.entity_id + '/load')
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