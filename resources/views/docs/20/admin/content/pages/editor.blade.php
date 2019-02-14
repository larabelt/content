<a name="pages-editor"></a>

## How to Edit a Page

@include('belt-docs::partials.table', [
    'rows' => [
        ['Slug', '​​auto-populates from title'],
        ['Hero Image', 'Link an image you wish to use for the main page image. You will need to add the image to the attachments tab or section prior to uploading it in the Main Tab.'],
        ['Heading', 'Leave Blank'],
        ['Hero Heading', 'This is the main page heading.'],
        ['Body', 'Body copy shows up over background image.'],
        ['Background Image', 'Image that shows up under background image section of page.'],
    ],
])

@include('belt-docs::partials.image', [
    'src' => '20/admin/content/assets/param-background-image.png',
    'caption' => '',
])

@include('belt-docs::partials.table', [
    'rows' => [
        ['Search List Items General', 'This section will add a List of POIs to your page. You can "show" or "hide" this list.'],
    ],
])

@include('belt-docs::partials.image', [
    'src' => '20/admin/content/assets/param-search-list-items.png',
    'caption' => '',
])

* There are 11 criteria to choose from.

@include('belt-docs::partials.image', [
    'src' => '20/admin/content/assets/param-search-list-criteria.png',
    'caption' => '',
])

@include('belt-docs::partials.table', [
    'rows' => [
        ['General Content 1', '​​Area shows up under Search list items.'],
        ['Company List', 'You can include a list of companies. For example, the airline list.'],
        ['Gallery', ' To include a gallery of 4 images, first upload images under the attachments tab. Then fill in "Gallery Heading" Your three images will automatically appear as a gallery on your page.'],
    ],
])

@include('belt-docs::partials.image', [
    'src' => '20/admin/content/assets/param-gallery.png',
    'caption' => '',
])

@include('belt-docs::partials.table', [
    'rows' => [
        ['General Content 2', '​​Additional content text shows up under the gallery'],
        ['Child Links', '​​Include touts or "child links" to direct user to other pages of the site.'],
    ],
])

@include('belt-docs::partials.image', [
    'src' => '20/admin/content/assets/param-group-child-links.png',
    'caption' => '',
])

@include('belt-docs::partials.image', [
    'src' => '20/admin/content/assets/child-links.png',
    'caption' => '',
])

@include('belt-docs::partials.table', [
    'rows' => [
        ['Candid Tag', 'Choose theme for Instagram photos that show up on your Place page.'],
        ['Big Image Link', 'Add a link to other sections of the site. Shows up at bottom of page.'],
    ],
])

@include('belt-docs::partials.image', [
    'src' => '20/admin/content/assets/param-big-image-link.png',
    'caption' => '',
])

#### Terms tab:

@include('belt-docs::partials.table', [
    'rows' => [
        ['Cruise', "Items that are using the term Cruise, appear on the $url/cruise-guests​ page."],
        ['Landmark​​', 'Unique feature if a POI is a place like a waterfall. You want to reference the Term _Landmark - Waterfall_ under the POI terms section. This applies to waterfalls, beaches, hiking trails, must see, dive sites, gorge.'],
    ],
])

#### Handles tab:

Customize a handle for your page.

#### Attachments tab:

Upload images you want to use for your hero image and gallery here.