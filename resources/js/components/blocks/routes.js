import index from './ctlr/index';
import create from './ctlr/create';
import edit  from './ctlr/edit';
import categories  from './ctlr/categories';
import tags  from './ctlr/tags';

export default [
    {path: '/blocks', component: index, canReuse: false, name: 'blocks'},
    {path: '/blocks/create', component: create, name: 'blocks.create'},
    {path: '/blocks/edit/:id', component: edit, name: 'blocks.edit'},
    {path: '/blocks/edit/:id/categories', component: categories, name: 'blocks.categories'},
    {path: '/blocks/edit/:id/tags', component: tags, name: 'blocks.tags'},
]