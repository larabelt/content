import index from 'belt/content/js/pages/ctlr/index';
import create from 'belt/content/js/pages/ctlr/create';
import edit  from 'belt/content/js/pages/ctlr/edit';
import attachments  from 'belt/content/js/pages/ctlr/attachments';
import categories  from 'belt/content/js/pages/ctlr/categories';
import handles  from 'belt/content/js/pages/ctlr/handles';
import params  from 'belt/content/js/pages/ctlr/params';
import tags  from 'belt/content/js/pages/ctlr/tags';
import sections  from 'belt/content/js/pages/ctlr/sections';

export default [
    {path: '/pages', component: index, canReuse: false, name: 'pages'},
    {path: '/pages/create', component: create, name: 'pages.create'},
    {path: '/pages/edit/:id', component: edit, name: 'pages.edit'},
    {path: '/pages/edit/:id/attachments', component: attachments, name: 'pages.attachments'},
    {path: '/pages/edit/:id/categories', component: categories, name: 'pages.categories'},
    {path: '/pages/edit/:id/handles', component: handles, name: 'pages.handles'},
    {path: '/pages/edit/:id/params', component: params, name: 'pages.params'},
    {path: '/pages/edit/:id/sections/:section_mode?/:section_id?', component: sections, name: 'pages.sections'},
    {path: '/pages/edit/:id/tags', component: tags, name: 'pages.tags'},
]