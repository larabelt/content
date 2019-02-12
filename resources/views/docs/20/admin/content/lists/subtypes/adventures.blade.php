<a name="adventures"></a>

## How to Create an Adventure

Creating an Adventure is very similar to creating an Itinerary.

Before starting your Adventure, add the places you want to include in your Adventure, under "Places." For instructions on how to add a place, see page X.

To create the Adventure, "X," start by going to Content → Lists and click on the "Add a List" button

#### Main tab:

@include('belt-docs::partials.table', [
    'rows' => [
        ['Type', 'Set to _Adventure_'],
        ['Is Active', 'Check this box to make the Adventure page publicly available.'],
        ['Name', 'Fill in name of your Adventure.'],
    ],
])

@include('belt-docs::partials.image', [
    'src' => '20/admin/content/assets/list-creator-adventure.png',
    'caption' => '',
])

At this point, save. Additional tabs and fields will become available

@include('belt-docs::partials.table', [
    'rows' => [
        ['Main Image', 'Set main image.'],
        ['Heading', '_Leave blank_'],
        ['Hero Heading', 'Fill in hero heading, shows up at top of page.'],
    ],
])

@include('belt-docs::partials.image', [
    'src' => '20/admin/content/assets/param-group-main-image.png',
    'caption' => '',
])

@include('belt-docs::partials.table', [
    'rows' => [
        ['Body Text', 'Enter body text that shows after the hero or main image'],
        ['Background Image', 'Shows up under overlay, can be same as hero image.'],
    ],
])

@include('belt-docs::partials.image', [
    'src' => '20/admin/content/assets/param-group-body-background-image.png',
    'caption' => '',
])

@include('belt-docs::partials.table', [
    'rows' => [
        ['Search List Items', 'For most Adventures leave this section blank but this heading and text would appear above your list of adventure POIs'],
        ['Big Image Link', 'Shows up near bottom of page, points users to additional content. Used for most adventures'],
    ],
])

@include('belt-docs::partials.image', [
    'src' => '20/admin/content/assets/param-big-image-link-adventure.png',
    'caption' => '',
])

@include('belt-docs::partials.table', [
    'rows' => [
        ['Candid Tag', 'Set theme of Instagram photos.'],
        ['Metadata', 'Recommended for all pages, helps with SEO.'],
    ],
])

#### Items tab:

@include('belt-docs::partials.table', [
    'rows' => [
        ['Type', 'Set as _Place_, then click add list item'],
    ],
])

**Adding new list item:**

@include('belt-docs::partials.table', [
    'rows' => [
        ['Heading', '_Leave Blank_'],
        ['Body', '_Leave Blank_'],
        ['Place', 'Link existing place to this item. Start searching by existing place name and link. Repeat this step for all items you wish to link this adventure.'],
    ],
])

@include('belt-docs::partials.image', [
    'src' => '20/admin/content/assets/list-item-child-link.png',
    'caption' => '',
])

#### Attachments tab:

To include a carousel of images in your adventure page, upload images here.

@include('belt-docs::partials.image', [
    'src' => '20/admin/content/assets/tab-attachments-adventure.png',
    'caption' => '',
])

#### Terms tab:

Leave terms blank

Note: Once your itinerary is complete, you will automatically see a tout for it under the main "Itineraries" page.