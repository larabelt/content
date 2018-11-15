import list from 'belt/content/js/translatable-strings/list';
import create from 'belt/content/js/translatable-strings/create';
import edit from 'belt/content/js/translatable-strings/edit';

export default [
    {path: '/translatable-strings', component: list, canReuse: false, name: 'translatableStrings'},
    {path: '/translatable-strings/create', component: create, name: 'translatableStrings.create'},
    {path: '/translatable-strings/edit/:id', component: edit, name: 'translatableStrings.edit'},
]