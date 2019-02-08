<a name="adventures"></a>

## How to Create an Adventure

Creating an Adventure is very similar to creating an Itinerary.

Before starting your Adventure, add the places you want to include in your Adventure, under "Places." For instructions on how to add a place, see page X.

To create the Adventure, "X," start by going to Content → Lists and click on the "Add a List" button

#### Main tab:

* **Type** Adventure
* **Check** Is Active
* **Name** Fill in name of your Adventure

@include('belt-docs::partials.image', [
    'src' => '20/admin/content/assets/list-creator-adventure.png',
    'caption' => '',
])

At this point, save. Additional tabs and fields will become available

* Set main image
* **Heading** leave blank
* **Hero Heading** fill in hero heading, shows up at top of page

@include('belt-docs::partials.image', [
    'src' => '20/admin/content/assets/param-group-main-image.png',
    'caption' => '',
])

* **Body text** Enter body text that shows after the hero or main image
* **Background image** shows up under overlay, can be same as hero image

@include('belt-docs::partials.image', [
    'src' => '20/admin/content/assets/param-group-body-background-image.png',
    'caption' => '',
])

* **Search List Items** most Adventures leave this section blank but this heading and text would appear above your list of adventure POIs
* **Big Image Link** shows up near bottom of page, points users to additional content. Used for most adventures

@include('belt-docs::partials.image', [
    'src' => '20/admin/content/assets/param-big-image-link-adventure.png',
    'caption' => '',
])

* **Candid Tag** set theme of Instagram photos
* **Metadata** recommended for all pages, helps with SEO

#### Items tab:

* Type should be Place, then add list item
* Under Add List Item, leave Heading and Body blank.
* **Place** Link existing place to this item. Start searching by existing place name and link. Repeat
this step for all items you wish to link this adventure.

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