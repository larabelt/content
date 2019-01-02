<?php

use Mockery as m;
use Belt\Core\Translation;
use Belt\Core\Testing\BeltTestCase;
use Belt\Core\Facades\TranslateFacade as Translate;
use Belt\Core\Facades\MorphFacade as Morph;
use Belt\Content\TranslatableString;
use Belt\Content\Services\TranslateStringService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\FilesystemAdapter;

class TranslateStringServiceTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Services\TranslateStringService::__construct
     * @covers \Belt\Content\Services\TranslateStringService::buildStorageFile
     */
    public function test()
    {
        Translation::unguard();
        TranslatableString::unguard();

        $this->enableI18n();

        # buildStorageFile (invalid)
        Translate::shouldReceive('isAvailableLocale')->with('foo')->andReturn(false);
        Translate::shouldReceive('isAvailableLocale')->with('es_ES')->andReturn(true);
        $service = new TranslateStringService();
        $service->buildStorageFile('foo');

        # buildStorageFile
        $translations = new Collection();
        $translatableString = factory(TranslatableString::class)->make(['id' => 999]);
        $translation = factory(Translation::class)->make([
            'translatable_type' => 'translatable_strings',
            'translatable_id' => 999,
            'translatable_column' => 'value',
            'locale' => 'es_ES',
        ]);
        $translation->translatable = $translatableString;
        $translations->add($translation);

        $qb = m::mock(Builder::class);
        $qb->shouldReceive('where')->with('locale', 'es_ES')->andReturnSelf();
        $qb->shouldReceive('where')->with('translatable_type', 'translatable_strings')->andReturnSelf();
        $qb->shouldReceive('get')->andReturn($translations);
        Morph::shouldReceive('type2QB')->with('translations')->andReturn($qb);

        $disk = m::mock(FilesystemAdapter::class);
        $disk->shouldReceive('put')->with("lang/es_ES.json", json_encode([$translatableString->value => $translation->value]));
        Storage::shouldReceive('disk')->andReturn($disk);


        $service = new TranslateStringService();
        $service->buildStorageFile('es_ES');
    }


}