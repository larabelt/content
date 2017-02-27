import index from './ctlr/index';
import create from './ctlr/create';
import edit  from './ctlr/edit';

export default [
    {path: '/touts', component: index, canReuse: false, name: 'touts'},
    {path: '/touts/create', component: create, name: 'touts.create'},
    {path: '/touts/edit/:id', component: edit, name: 'touts.edit'},
]