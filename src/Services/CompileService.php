<?php
namespace Ohio\Content\Services;

use Ohio, View;
use Ohio\Content\Page;
use Ohio\Content\Section;
use Illuminate\Database\Eloquent\Model;

class CompileService
{

    //config for template/view-paths
    //how to share above
    //move template to TemplateTrait
    //sectionable: menu, breadcrumbs

    public function pages()
    {
        $pages = Page::where('id', 1)->get();
        foreach ($pages as $page) {
            $html = view("ohio-content::page.templates.default", compact('page'));
            $page->compiled = $html;
            $page->save();
        }
    }

}