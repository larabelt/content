<a name="pages-creator"></a>

## How to Create a Page

To create a Page, start by going to Content → Page and click on the "Add Page" button.

#### Main tab:

@include('belt-docs::partials.table', [
    'rows' => [
        ['Type', 'You can choose from the drop-down list of page types. For this example, we will use "default".'],
    ],
])

@include('belt-docs::partials.image', ['src' => '20/admin/content/assets/page-subtype-dropdown.png'])

@include('belt-docs::partials.table', [
    'rows' => [
        ['Is active', 'Check to make page active.'],
        ['Name', 'Fill in name of your Page.'],
        ['Meta Title', 'This will be page title and will show up on tab in browser.'],
        ['Meta Description', 'This is for SEO purposes and shows up in the site\'s search results.'],
        ['Meta Keywords', 'Add keywords for SEO purposes, if you desire.'],
    ],
])

Click on Save. Additional fields and tabs will become available.