import shared from 'belt/spot/js/itineraries/ctlr/shared';

// components
import places from 'belt/spot/js/itinerary-places/ctlr/index';

export default {
    mixins: [shared],
    components: {
        tab: places,
    },
}