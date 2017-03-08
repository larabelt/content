import index from './ctlr/index';
import create from './ctlr/create';
import edit  from './ctlr/edit';

export default [
    {path: '/blocks', component: index, canReuse: false, name: 'blocks'},
    {path: '/blocks/create', component: create, name: 'blocks.create'},
    {path: '/blocks/edit/:id', component: edit, name: 'blocks.edit'},
]