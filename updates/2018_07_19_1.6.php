<?php

use Illuminate\Support\Facades\DB;
use Belt\Core\Behaviors\HasDisk;
use Belt\Core\Helpers\DebugHelper;
use Belt\Core\Services\Update\BaseUpdate;
use Belt\Content\Section;

/**
 * Class UpdateService
 * @package Belt\Core\Services
 */
class BeltUpdateContent16 extends BaseUpdate
{
    use HasDisk;

    /**
     * @var array
     */
    public $argumentMap = [
        'methods',
    ];

    public function up()
    {
        /**
         * create
         * update
         * move
         * db
         * views
         */
        $methods = $this->argument('methods');
        foreach (explode(',', $methods) as $method) {
            $method = camel_case($method);
            if (method_exists($this, $method)) {
                $this->$method();
            }
        }

    }

    /**
     * @param $morphClass
     * @return string
     */
    public function getSubtypeType($morphClass)
    {
        $type = in_array($morphClass, ['pages', 'categories', 'places', 'posts', 'events']) ? $morphClass : 'sections';

        return $type;
    }

    /**
     * @param $morphClass
     * @param $subtypeKey
     * @param $oldConfig
     * @return array
     */
    public function getNewConfig($morphClass, $subtypeKey, $oldConfig)
    {
        $type = $this->getSubtypeType($morphClass);

        $previews = [
            'albums' => 'belt-content::albums.previews.default',
            'attachments' => 'belt-content::attachments.previews.default',
            'menus' => 'belt-menu::menus.previews.default',
            'touts' => 'belt-content::attachments.previews.default',
        ];

        $newConfig = [
            'builder' => array_get($oldConfig, 'builder', null),
            'extends' => array_get($oldConfig, 'extends', ''),
            'path' => array_get($oldConfig, 'path', ''),
            'label' => array_get($oldConfig, 'label', ''),
            'description' => array_get($oldConfig, 'description', ''),
            'preview' => array_get($previews, $morphClass, ''),
            'params' => [],
        ];

        if ($morphClass == 'custom') {
            if ($subtypeKey == 'breadcrumbs') {
                $newConfig['preview'] = 'belt-menu::menus.previews.breadcrumbs';
            }
        }

        $mainParam = null;
        if (!in_array($morphClass, ['sections', 'custom', 'menus'])) {
            $mainParam = [
                'type' => $morphClass,
                'label' => title_case(str_singular(str_replace('_', ' ', $morphClass))),
                'description' => '',
            ];
        }

        $newParams = [];
        $oldParams = array_get($oldConfig, 'params', []);
        foreach ($oldParams as $key => $values) {
            $newParams[$key] = [
                'type' => is_array($values) ? 'select' : 'text',
                'label' => title_case(str_replace('_', ' ', $key)),
                'description' => '',
                'options' => is_array($values) ? $values : null,
            ];
        }

        if ($type == 'sections') {
            $qb = Section::where('sectionable_type', $morphClass)->where('subtype', $subtypeKey);
            foreach (['heading', 'before', 'after'] as $column) {
                $clone = clone $qb;
                $clone->where(function ($qb) use ($column) {
                    $qb->whereNotNull($column);
                    $qb->orWhere($column, '!=', '');
                });
                if ($clone->first()) {
                    $newParams[$column] = [
                        'type' => $column == 'heading' ? 'text' : 'editor',
                        'label' => title_case(str_replace('_', ' ', $column)),
                        'description' => '',
                    ];
                }
            }
        }

        //asort($newParams);


        if ($mainParam && $type == 'sections') {
            $newConfig['params'][$mainParam['type']] = $mainParam;
        }

        $newConfig['params'] = array_merge($newConfig['params'], $newParams);

        return $newConfig;
    }

    public function create()
    {
        $configKey = $this->option('configKey', 'belt.subtypes');

        foreach (config($configKey) as $morphClass => $subtypes) {
            foreach ($subtypes as $subtypeKey => $config) {
                $this->__create($morphClass, $subtypeKey);
            }
        }
    }

    public function __create($morphClass, $subtypeKey)
    {
        $this->info(sprintf('re-organize %s:%s', $morphClass, $subtypeKey));

        $path = sprintf('config/belt/subtypes/%s/%s.php', $morphClass, $subtypeKey);
        $tmpPath = sprintf('config/belt/subtypes-tmp/%s/%s.php', $morphClass, $subtypeKey);

        $type = $this->getSubtypeType($morphClass);
        if ($type == 'sections') {
            $morphClass = $morphClass == 'sections' ? 'containers' : $morphClass;
            $tmpPath = sprintf('config/belt/subtypes-tmp/%s/%s/%s.php', $type, $morphClass, $subtypeKey);
        }

        $this->disk()->copy($path, $tmpPath);

    }

    public function update()
    {
        $configKey = $this->option('configKey', 'belt.subtypes');

        foreach (config($configKey) as $morphClass => $subtypes) {
            foreach ($subtypes as $subtypeKey => $config) {
                if ($morphClass == 'attachments' && $subtypeKey == 'default') {
                }
                $this->__update($morphClass, $subtypeKey, $config);
            }
        }
    }

    public function __update($morphClass, $subtypeKey, $oldConfig)
    {
        $this->info(sprintf('re-organize %s:%s', $morphClass, $subtypeKey));

        $newConfig = $this->getNewConfig($morphClass, $subtypeKey, $oldConfig);

        $tmpPath = sprintf('config/belt/subtypes-tmp/%s/%s.php', $morphClass, $subtypeKey);

        $type = $this->getSubtypeType($morphClass);
        if ($type == 'sections') {
            $morphClass = $morphClass == 'sections' ? 'containers' : $morphClass;
            $tmpPath = sprintf('config/belt/subtypes-tmp/%s/%s/%s.php', $type, $morphClass, $subtypeKey);
        }

        $contents = sprintf("<?php\r\n\r\nreturn %s;", DebugHelper::varExportShort($newConfig));

        $this->disk()->put($tmpPath, $contents);
    }

    public function move()
    {
        $tmpPath = $this->option('new-path', 'subtypes-tmp');
        $tmpPath = config_path('belt/' . $tmpPath);
        if ($tmpPath && file_exists($tmpPath)) {
            $targetPath = $this->option('target-path', 'subtypes');
            $targetPath = config_path('belt/' . $targetPath);
            if ($targetPath) {
                if (file_exists($targetPath)) {
                    $archivedPath = "$targetPath-archived";
                    rename($targetPath, $archivedPath);
                    $this->info("moved existing path to: $archivedPath");
                }
                rename($tmpPath, $targetPath);
                $this->info("moved new path to: $targetPath");
            }
        }
    }

    public function db()
    {
        Section::unguard();

        Section::where('subtype', '')->update(['subtype' => null]);
        Section::where('heading', '')->update(['heading' => null]);
        Section::where('before', '')->update(['before' => null]);
        Section::where('after', '')->update(['after' => null]);
        Section::where('sectionable_type', '')->update(['sectionable_type' => null]);

        Section::whereNull('subtype')->update([
            'subtype' => 'default'
        ]);

        Section::where('subtype', 'NOT LIKE', '%.%')
            ->update([
                'subtype' => DB::raw("CONCAT(sections.sectionable_type, '.', sections.subtype)")
            ]);

        Section::whereIn('sectionable_type', ['sections', 'custom', 'menus'])
            ->update([
                'sectionable_type' => null
            ]);

        Section::where('subtype', 'LIKE', 'sections.%')
            ->update([
                'subtype' => DB::raw("REPLACE(`subtype`, 'sections.', 'containers.')")
            ]);

        foreach (Section::whereNotNull('heading')->get() as $section) {
            $section->saveParam('heading', $section->heading);
        }

        foreach (Section::whereNotNull('before')->get() as $section) {
            $section->saveParam('before', $section->before);
        }

        foreach (Section::whereNotNull('after')->get() as $section) {
            $section->saveParam('after', $section->after);
        }

        foreach (Section::whereNotNull('sectionable_type')->get() as $section) {
            $section->saveParam($section->sectionable_type, $section->sectionable_id);
        }

        Section::query()->update([
            'sectionable_id' => null,
            'sectionable_type' => null,
            'heading' => null,
            'before' => null,
            'after' => null,
        ]);

    }

    public function views()
    {

        $disk = \Belt\Core\Helpers\BeltHelper::baseDisk();

        $paths = $disk->files('resources/views', true);

        foreach ($paths as $path) {

            $contents = $new_contents = $disk->get($path);

            $configKey = $this->option('configKey', 'belt.subtypes');

            foreach (config($configKey) as $morphClass => $subtypes) {
                $new_contents = $this->__view($morphClass, $new_contents);
            }

            foreach (config($configKey . '.sections') as $morphClass => $subtypes) {
                $new_contents = $this->__view($morphClass, $new_contents);
            }

            if ($new_contents != $contents) {
                $this->info("updated view: $path");
                $disk->put($path, $new_contents);
            }
        }

    }

    public function __view($morphClass, $content)
    {
        $search = sprintf('%s = $section->sectionable', str_singular($morphClass));
        $replace = sprintf('%s = $section->morphParam(\'%s\')', str_singular($morphClass), $morphClass);
        $content = str_replace($search, $replace, $content);

        $content = str_replace('section->heading or ', 'section->heading ?: ', $content);
        $content = str_replace('section->before or ', 'section->heading ?: ', $content);
        $content = str_replace('section->after or ', 'section->heading ?: ', $content);

        $content = str_replace('section->heading', 'section->param(\'heading\')', $content);
        $content = str_replace('section->before', 'section->param(\'before\')', $content);
        $content = str_replace('section->after', 'section->param(\'after\')', $content);

        return $content;
    }

}