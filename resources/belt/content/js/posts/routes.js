import index from 'belt/content/js/posts/ctlr/index';
import create from 'belt/content/js/posts/ctlr/create';
import edit  from 'belt/content/js/posts/ctlr/edit';
import attachments  from 'belt/content/js/posts/ctlr/attachments';
import terms  from 'belt/content/js/posts/ctlr/terms';
import handles  from 'belt/content/js/posts/ctlr/handles';
import sections  from 'belt/content/js/posts/ctlr/sections';

export default [
    {path: '/posts', component: index, canReuse: false, name: 'posts'},
    {path: '/posts/create', component: create, name: 'posts.create'},
    {path: '/posts/edit/:id', component: edit, name: 'posts.edit'},
    {path: '/posts/edit/:id/attachments', component: attachments, name: 'posts.attachments'},
    {path: '/posts/edit/:id/handles', component: handles, name: 'posts.handles'},
    {path: '/posts/edit/:id/terms', component: terms, name: 'posts.terms'},
    {path: '/posts/edit/:id/sections/:section_mode?/:section_id?', component: sections, name: 'posts.sections'},
]