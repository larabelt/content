import index from 'belt/content/js/handles/ctlr/index';
import create from 'belt/content/js/handles/ctlr/create';
import edit  from 'belt/content/js/handles/ctlr/edit';

export default [
    {path: '/handles', component: index, canReuse: false, name: 'handles'},
    {path: '/handles/create', component: create, name: 'handles.create'},
    {path: '/handles/edit/:id', component: edit, name: 'handles.edit'},
]