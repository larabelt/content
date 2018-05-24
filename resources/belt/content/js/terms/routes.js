import index from 'belt/content/js/terms/ctlr/index';
import create from 'belt/content/js/terms/ctlr/create';
import edit  from 'belt/content/js/terms/ctlr/edit';
import attachments  from 'belt/content/js/terms/ctlr/attachments';
import sections  from 'belt/content/js/terms/ctlr/sections';

export default [
    {path: '/terms', component: index, canReuse: false, name: 'terms'},
    {path: '/terms/create', component: create, name: 'terms.create'},
    {path: '/terms/edit/:id', component: edit, name: 'terms.edit'},
    {path: '/terms/edit/:id/attachments', component: attachments, name: 'terms.attachments'},
    {path: '/terms/edit/:id/sections/:section?', component: sections, name: 'terms.sections'},
]