import list from 'belt/content/js/lists/list';
import create from 'belt/content/js/lists/create';
import edit from 'belt/content/js/lists/edit';
import attachments from 'belt/content/js/lists/edit/attachments';
import related from 'belt/content/js/lists/edit/related';
import sections from 'belt/content/js/lists/edit/sections';
import terms from 'belt/content/js/lists/edit/terms';

export default [
    {path: '/lists', component: list, canReuse: false, name: 'lists'},
    {path: '/lists/create', component: create, name: 'lists.create'},
    {path: '/lists/edit/:id', component: edit, name: 'lists.edit'},
    {path: '/lists/edit/:id/attachments', component: attachments, name: 'lists.attachments'},
    {path: '/lists/edit/:id/sections/:section?', component: sections, name: 'lists.sections'},
    {path: '/lists/edit/:id/related', component: related, name: 'lists.related'},
    {path: '/lists/edit/:id/terms', component: terms, name: 'lists.terms'},
]