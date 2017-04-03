import index from './ctlr/index';
import create from './ctlr/create';
import edit  from './ctlr/edit';
import categories  from './ctlr/categories';
import handles  from './ctlr/handles';
import tags  from './ctlr/tags';
import sections  from './ctlr/sections';

export default [
    {path: '/pages', component: index, canReuse: false, name: 'pages'},
    {path: '/pages/create', component: create, name: 'pages.create'},
    {path: '/pages/edit/:id', component: edit, name: 'pages.edit'},
    {path: '/pages/edit/:id/categories', component: categories, name: 'pages.categories'},
    {path: '/pages/edit/:id/handles', component: handles, name: 'pages.handles'},
    {path: '/pages/edit/:id/sections/:section?', component: sections, name: 'pages.sections'},
    {path: '/pages/edit/:id/tags', component: tags, name: 'pages.tags'},
]