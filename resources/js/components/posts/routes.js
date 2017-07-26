import index from 'belt/content/js/components/posts/ctlr/index';
import create from 'belt/content/js/components/posts/ctlr/create';
import edit  from 'belt/content/js/components/posts/ctlr/edit';
import attachments  from 'belt/content/js/components/posts/ctlr/attachments';
import categories  from 'belt/content/js/components/posts/ctlr/categories';
import handles  from 'belt/content/js/components/posts/ctlr/handles';
import tags  from 'belt/content/js/components/posts/ctlr/tags';
import sections  from 'belt/content/js/components/posts/ctlr/sections';

export default [
    {path: '/posts', component: index, canReuse: false, name: 'posts'},
    {path: '/posts/create', component: create, name: 'posts.create'},
    {path: '/posts/edit/:id', component: edit, name: 'posts.edit'},
    {path: '/posts/edit/:id/attachments', component: attachments, name: 'posts.attachments'},
    {path: '/posts/edit/:id/categories', component: categories, name: 'posts.categories'},
    {path: '/posts/edit/:id/handles', component: handles, name: 'posts.handles'},
    {path: '/posts/edit/:id/sections/:section?', component: sections, name: 'posts.sections'},
    {path: '/posts/edit/:id/tags', component: tags, name: 'posts.tags'},
]