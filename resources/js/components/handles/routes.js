import index from './ctlr/index';
import create from './ctlr/create';
import edit  from './ctlr/edit';

export default [
    {path: '/handles', component: index, canReuse: false, name: 'handles'},
    {path: '/handles/create', component: create, name: 'handles.create'},
    {path: '/handles/edit/:id', component: edit, name: 'handles.edit'},
]