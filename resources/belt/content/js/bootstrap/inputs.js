import attachments from 'belt/content/js/inputs/attachments';
import blocks from 'belt/content/js/inputs/blocks';
import lists from 'belt/content/js/inputs/lists';
import pages from 'belt/content/js/inputs/pages';
import pages from 'belt/content/js/inputs/posts';
import terms from 'belt/content/js/inputs/terms';
import seo from 'belt/content/js/inputs/seo';

Vue.component('input-attachments', attachments);
Vue.component('input-blocks', blocks);
Vue.component('input-lists', lists);
Vue.component('input-pages', pages);
Vue.component('input-posts', pages);
Vue.component('input-terms', terms);
Vue.component('input-seo', seo);