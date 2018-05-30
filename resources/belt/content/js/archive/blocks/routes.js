import index from 'belt/content/js/blocks/ctlr/index';
import create from 'belt/content/js/blocks/ctlr/create';
import edit  from 'belt/content/js/blocks/ctlr/edit';
import terms  from 'belt/content/js/blocks/ctlr/terms';

export default [
    {path: '/blocks', component: index, canReuse: false, name: 'blocks'},
    {path: '/blocks/create', component: create, name: 'blocks.create'},
    {path: '/blocks/edit/:id', component: edit, name: 'blocks.edit'},
    {path: '/blocks/edit/:id/terms', component: terms, name: 'blocks.terms'},
]