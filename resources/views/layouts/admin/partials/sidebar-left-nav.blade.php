@php
    $can['blocks'] = Auth::user()->can('edit', Belt\Content\Block::class);
    $can['handles'] = Auth::user()->can('edit', Belt\Content\Handle::class);
    $can['pages'] = Auth::user()->can('edit', Belt\Content\Page::class);
    $can['posts'] = Auth::user()->can('edit', Belt\Content\Post::class);
    $can['touts'] = Auth::user()->can('edit', Belt\Content\Tout::class);
@endphp

@if($can['blocks'] || $can['handles'] || $can['pages'] || $can['posts'] || $can['touts'])
    <li class="treeview">
        <a href="#">
            <i class="fa fa-file-o"></i> <span>Content Admin</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            @if($can['blocks'])
                <li><a href="/admin/belt/content/blocks"><i class="fa fa-code"></i> <span>Blocks</span></a></li>
            @endif
            @if($can['handles'])
                <li><a href="/admin/belt/content/handles?orderBy=-handles.hits&is_active=0"><i class="fa fa-signing"></i> <span>Handles</span></a></li>
            @endif
            @if($can['pages'])
                <li><a href="/admin/belt/content/pages"><i class="fa fa-files-o"></i> <span>Pages</span></a></li>
            @endif
            @if($can['posts'])
                <li><a href="/admin/belt/content/posts"><i class="fa fa-clone"></i> <span>Posts</span></a></li>
            @endif
            @if($can['touts'])
                <li><a href="/admin/belt/content/touts"><i class="fa fa-sticky-note"></i> <span>Touts</span></a></li>
            @endif
        </ul>
    </li>
@endif