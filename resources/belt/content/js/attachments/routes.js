import index from 'belt/content/js/attachments/ctlr/index';
import edit  from 'belt/content/js/attachments/ctlr/edit';
import resizes  from 'belt/content/js/attachments/ctlr/resizes';
import terms  from 'belt/content/js/attachments/ctlr/terms';

export default [
    {path: '/attachments', component: index, canReuse: false, name: 'attachments'},
    {path: '/attachments/edit/:id', component: edit, name: 'attachments.edit'},
    {path: '/attachments/edit/:id/terms', component: terms, name: 'attachments.terms'},
    {path: '/attachments/edit/:id/resizes', component: resizes, name: 'attachments.resizes'},
]