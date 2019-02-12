<a name="itineraries"></a>

## How to Create an Itinerary

Before starting your Itinerary, add the places you want to include in your Itinerary, under "Places." For instructions on how to add a place, see page X.

To create the Itinerary "Advanced Diving Trips," start by going to Content → Lists and click on the "Add a List" button

#### Main tab:

@include('belt-docs::partials.table', [
    'rows' => [
        ['Type', 'Set as _Itinerary_'],
    ],
])

@include('belt-docs::partials.image', [
    'src' => '20/admin/content/assets/list-creator-itinerary-subtype.png',
    'caption' => '',
])

@include('belt-docs::partials.table', [
    'rows' => [
        ['Is Active', 'Check this box to make the Itinerary page publicly available.'],
        ['Name', 'Assign your Itinerary a name, e.g. "Diving Trips".'],
    ],
])

Click "Save" to continue.

@include('belt-docs::partials.image', [
    'src' => '20/admin/content/assets/list-creator-itinerary-name.png',
    'caption' => '',
])

At this point you will have access to other fields and tabs. The slug will automatically populate from your Itinerary Name

@include('belt-docs::partials.table', [
    'rows' => [
        ['Hero Image', 'Upload an image to the Attachment tab in the left navigation or the Attachment tab in the Itinerary interface. It is recommended to name your image something you can easily find later.'],
    ],
])

Return to your itinerary's main tab, search for, and link your image by clicking the link icon.

@include('belt-docs::partials.image', [
    'src' => '20/admin/content/assets/list-editor-itinerary-hero.png',
    'caption' => '',
])

@include('belt-docs::partials.table', [
    'rows' => [
        ['Hero Heading', 'Add a Hero Heading to go over your hero image.'],
        ['Hero Copy', 'Add text to go under your heading.'],
    ],
])

@include('belt-docs::partials.image', [
    'src' => '20/admin/content/assets/param-group-hero.png',
    'caption' => '',
])

Click "Save" to save your work so far.

@include('belt-docs::partials.table', [
    'rows' => [
        ['Intro Copy', '_Leave Blank_'],
        ['Candid Tag', 'Select a theme for the images that will show up in the Instagram feed on your Itinerary page.'],
        ['Metadata', 'Add Meta Description and Meta Keywords'],
    ],
])

#### Items tab:

Add List Items, one for each item you want in your list. Set type as "Place."Add a heading if you
would like text across your item. For example, "Day 1." Leave the Body blank.

@include('belt-docs::partials.image', [
    'src' => '20/admin/content/assets/list-item-place.png',
    'caption' => '',
])

#### Attachment Tab:

Upload hero or main image here.

#### Terms Tab:

Leave Term tab fields blank

Note: Once your itinerary is complete, you will automatically see a tout for it under the main "Itineraries" page.