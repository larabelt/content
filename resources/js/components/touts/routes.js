import attachments  from './ctlr/attachments';
import index from './ctlr/index';
import create from './ctlr/create';
import edit  from './ctlr/edit';
import tags  from './ctlr/tags';

export default [
    {path: '/touts', component: index, canReuse: false, name: 'touts'},
    {path: '/touts/create', component: create, name: 'touts.create'},
    //{path: '/touts/edit/:id/attachments', component: attachments, name: 'touts.attachments'},
    {path: '/touts/edit/:id', component: edit, name: 'touts.edit'},
    {path: '/touts/edit/:id/tags', component: tags, name: 'touts.tags'},
]