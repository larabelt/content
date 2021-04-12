import shared from 'belt/core/js/inputs/shared';
import PostTable from 'belt/content/js/posts/table';
import PostForm from 'belt/content/js/posts/form';
import html from 'belt/content/js/inputs/posts/template.html';

export default {
    mixins: [shared],
    data() {
        return {
            post: new PostForm(),
            posts: new PostTable({query: {perPage: 20}}),
        };
    },
    created() {
        this.config.label = _.get(this.config, 'label', 'Post');
        this.config.description = _.get(this.config, 'description', 'Use the search field to find posts that can be linked to this item.');
        this.$watch('form.' + this.column, function (newValue) {
            this.post.show(newValue);
        });
    },
    mounted() {
        if (this.value) {
            this.post.show(this.value);
        }
    },
    computed: {
        attachment() {
            return _.get(this.post, 'attachments.0', {});
        }
    },
    methods: {
        clear() {
            this.posts.query.q = '';
        },
        unlink() {
            this.form[this.column] = null;
            this.post.reset();
        },
        update(id) {
            this.form[this.column] = id;
            this.clear();
            this.emitEvent();
        },
    },
    components: {},
    template: html
}