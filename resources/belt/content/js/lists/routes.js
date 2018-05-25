import index from 'belt/content/js/lists/ctlr/index';
import create from 'belt/content/js/lists/ctlr/create';
import edit  from 'belt/content/js/lists/ctlr/edit';
import attachments  from 'belt/content/js/lists/ctlr/attachments';
import places  from 'belt/content/js/lists/ctlr/places';
import sections  from 'belt/content/js/lists/ctlr/sections';
import terms  from 'belt/content/js/lists/ctlr/terms';

export default [
    {path: '/lists', component: index, canReuse: false, name: 'lists'},
    {path: '/lists/create', component: create, name: 'lists.create'},
    {path: '/lists/edit/:id', component: edit, name: 'lists.edit'},
    {path: '/lists/edit/:id/attachments', component: attachments, name: 'lists.attachments'},
    {path: '/lists/edit/:id/places/:place?', component: places, name: 'lists.places'},
    {path: '/lists/edit/:id/sections/:section?', component: sections, name: 'lists.sections'},
    {path: '/lists/edit/:id/terms', component: terms, name: 'lists.terms'},
]