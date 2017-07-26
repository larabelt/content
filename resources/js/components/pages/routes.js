import index from 'belt/content/js/components/pages/ctlr/index';
import create from 'belt/content/js/components/pages/ctlr/create';
import edit  from 'belt/content/js/components/pages/ctlr/edit';
import attachments  from 'belt/content/js/components/pages/ctlr/attachments';
import categories  from 'belt/content/js/components/pages/ctlr/categories';
import handles  from 'belt/content/js/components/pages/ctlr/handles';
import tags  from 'belt/content/js/components/pages/ctlr/tags';
import sections  from 'belt/content/js/components/pages/ctlr/sections';

export default [
    {path: '/pages', component: index, canReuse: false, name: 'pages'},
    {path: '/pages/create', component: create, name: 'pages.create'},
    {path: '/pages/edit/:id', component: edit, name: 'pages.edit'},
    {path: '/pages/edit/:id/attachments', component: attachments, name: 'pages.attachments'},
    {path: '/pages/edit/:id/categories', component: categories, name: 'pages.categories'},
    {path: '/pages/edit/:id/handles', component: handles, name: 'pages.handles'},
    {path: '/pages/edit/:id/sections/:section?', component: sections, name: 'pages.sections'},
    {path: '/pages/edit/:id/tags', component: tags, name: 'pages.tags'},
]