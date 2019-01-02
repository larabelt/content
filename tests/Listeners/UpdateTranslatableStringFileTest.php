<?php

use Mockery as m;
use Belt\Core\Testing\BeltTestCase;
use Belt\Core\Events\ItemSaved;
use Belt\Core\Translation;
use Belt\Content\TranslatableString;
use Belt\Content\Services\TranslateStringService;
use Belt\Content\Listeners\UpdateTranslatableStringFile;

class UpdateTranslatableStringFileTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Listeners\UpdateTranslatableStringFile::service
     * @covers \Belt\Content\Listeners\UpdateTranslatableStringFile::handle
     */
    public function testHandle()
    {
        $this->enableI18n();

        $listener = new UpdateTranslatableStringFile();

        # service
        $this->assertInstanceOf(TranslateStringService::class, $listener->service());

        # handle
        $service = m::mock(TranslateStringService::class);
        $service->shouldReceive('buildStorageFile')->with('es_ES')->andReturnSelf();
        $listener->service = $service;

        Translation::unguard();
        TranslatableString::unguard();
        $translatableString = factory(TranslatableString::class)->make(['id' => 999]);
        $translation = factory(Translation::class)->make([
            'translatable_type' => 'translatable_strings',
            'translatable_id' => 999,
            'translatable_column' => 'value',
            'locale' => 'es_ES',
        ]);
        $translation->translatable = $translatableString;
        $event = m::mock(ItemSaved::class);
        $event->shouldReceive('item')->andReturn($translation);

        $listener->handle($event);
    }

}