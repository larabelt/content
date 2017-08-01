import attachments  from 'belt/content/js/touts/ctlr/attachments';
import index from 'belt/content/js/touts/ctlr/index';
import create from 'belt/content/js/touts/ctlr/create';
import edit  from 'belt/content/js/touts/ctlr/edit';
import tags  from 'belt/content/js/touts/ctlr/tags';

export default [
    {path: '/touts', component: index, canReuse: false, name: 'touts'},
    {path: '/touts/create', component: create, name: 'touts.create'},
    //{path: '/touts/edit/:id/attachments', component: attachments, name: 'touts.attachments'},
    {path: '/touts/edit/:id', component: edit, name: 'touts.edit'},
    {path: '/touts/edit/:id/tags', component: tags, name: 'touts.tags'},
]