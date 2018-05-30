import list from 'belt/content/js/blocks/list';
import create from 'belt/content/js/blocks/create';
import edit from 'belt/content/js/blocks/edit';
import params from 'belt/content/js/blocks/edit/params';
import terms from 'belt/content/js/blocks/edit/terms';

export default [
    {path: '/blocks', component: list, canReuse: false, name: 'blocks'},
    {path: '/blocks/create', component: create, name: 'blocks.create'},
    {path: '/blocks/edit/:id', component: edit, name: 'blocks.edit'},
    {path: '/blocks/edit/:id/terms', component: terms, name: 'blocks.terms'},
    {path: '/blocks/edit/:id/params', component: params, name: 'blocks.params'},
]