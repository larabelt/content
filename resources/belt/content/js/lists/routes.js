import index from 'belt/spot/js/itineraries/ctlr/index';
import create from 'belt/spot/js/itineraries/ctlr/create';
import edit  from 'belt/spot/js/itineraries/ctlr/edit';
import attachments  from 'belt/spot/js/itineraries/ctlr/attachments';
import places  from 'belt/spot/js/itineraries/ctlr/places';
import sections  from 'belt/spot/js/itineraries/ctlr/sections';
import terms  from 'belt/spot/js/itineraries/ctlr/terms';

export default [
    {path: '/itineraries', component: index, canReuse: false, name: 'itineraries'},
    {path: '/itineraries/create', component: create, name: 'itineraries.create'},
    {path: '/itineraries/edit/:id', component: edit, name: 'itineraries.edit'},
    {path: '/itineraries/edit/:id/attachments', component: attachments, name: 'itineraries.attachments'},
    {path: '/itineraries/edit/:id/places/:place?', component: places, name: 'itineraries.places'},
    {path: '/itineraries/edit/:id/sections/:section?', component: sections, name: 'itineraries.sections'},
    {path: '/itineraries/edit/:id/terms', component: terms, name: 'itineraries.terms'},
]