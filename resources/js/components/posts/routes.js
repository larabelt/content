import index from './ctlr/index';
import create from './ctlr/create';
import edit  from './ctlr/edit';
import attachments  from './ctlr/attachments';
import categories  from './ctlr/categories';
import handles  from './ctlr/handles';
import tags  from './ctlr/tags';
import sections  from './ctlr/sections';

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