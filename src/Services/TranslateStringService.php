<?php

namespace Belt\Content\Services;

use Belt, Morph, Storage, Translate;
use Belt\Core\Behaviors\TmpFile;
use Belt\Core\Behaviors\HasDisk;
use Belt\Core\Behaviors\HasConsole;
use Belt\Core\Translation;

/**
 * Class TranslateStringService
 * @package Belt\Content\Services
 */
class TranslateStringService
{
    use HasConsole, HasDisk, TmpFile;

    /**
     * @var resource|bool a file handle
     */
    public $tmpFile;

    /**
     * MoveService constructor.
     * @param array $options
     */
    public function __construct($options = [])
    {
        $this->console = array_get($options, 'console');
    }

    /**
     * @param $locale
     */
    public function buildStorageFile($locale)
    {
        if (!Translate::isAvailableLocale($locale)) {
            return;
        }

        $pairs = [];

        $qb = Morph::type2QB('translations');

        $translations = $qb->where('locale', $locale)
            ->where('translatable_type', 'translatable_strings')
            ->get();

        foreach ($translations as $translation) {
            $string = $translation->translatable;
            $string->untranslate();
            $pairs[$string->value] = $translation->value;
        }

        $disk = Storage::disk('public');
        $disk->put("lang/$locale.json", json_encode($pairs));
    }

}