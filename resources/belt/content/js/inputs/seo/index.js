import html from 'belt/content/js/inputs/seo/template.html';

export default {
    props: {
        form: {
            default: function () {
                return this.$parent.form;
            }
        },
    },
    data() {
        return {
            expanded: true,
        }
    },
    computed: {
        description() {
            return Vue.prototype.trans('belt-content::seo.editor.overall');
        },
    },
    mounted() {
        this.expanded = History.get('param.collapsed', 'seo-meta') ? History.get('param.collapsed', 'seo-meta') : false;
    },
    methods: {
        toggle() {
            this.expanded = !this.expanded;
            History.set('param.collapsed', 'seo-meta', this.expanded);
        },
    },
    template: html
}