import index from 'belt/content/js/blocks/ctlr/index';
import create from 'belt/content/js/blocks/ctlr/create';
import edit  from 'belt/content/js/blocks/ctlr/edit';
import categories  from 'belt/content/js/blocks/ctlr/categories';
import tags  from 'belt/content/js/blocks/ctlr/tags';

export default [
    {path: '/blocks', component: index, canReuse: false, name: 'blocks'},
    {path: '/blocks/create', component: create, name: 'blocks.create'},
    {path: '/blocks/edit/:id', component: edit, name: 'blocks.edit'},
    {path: '/blocks/edit/:id/categories', component: categories, name: 'blocks.categories'},
    {path: '/blocks/edit/:id/tags', component: tags, name: 'blocks.tags'},
]