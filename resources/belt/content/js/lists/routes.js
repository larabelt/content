import list from 'belt/content/js/lists/list';
import create from 'belt/content/js/lists/create';
import edit from 'belt/content/js/lists/edit';
import attachments from 'belt/content/js/lists/edit/attachments';
import itemEdit from 'belt/content/js/lists/edit/items/edit';
import items from 'belt/content/js/lists/edit/items';
import sections from 'belt/content/js/lists/edit/sections';
import terms from 'belt/content/js/lists/edit/terms';

export default [
    {path: '/lists', component: list, canReuse: false, name: 'lists'},
    {path: '/lists/create', component: create, name: 'lists.create'},
    {path: '/lists/edit/:id', component: edit, name: 'lists.edit'},
    {path: '/lists/edit/:id/attachments', component: attachments, name: 'lists.attachments'},
    {path: '/lists/edit/:id/sections/:section?', component: sections, name: 'lists.sections'},
    {path: '/lists/edit/:id/items/edit/:item_id', component: itemEdit, name: 'lists.items.edit'},
    {path: '/lists/edit/:id/items', component: items, name: 'lists.items'},
    {path: '/lists/edit/:id/terms', component: terms, name: 'lists.terms'},
]