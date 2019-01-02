<?php

use Belt\Core\Testing;
use Belt\Core\Facades\TranslateFacade as Translate;
use Belt\Content\TranslatableString;

class TranslatableStringsFunctionalTest extends Testing\BeltTestCase
{

    public function test()
    {
        $this->refreshDB();
        $this->actAsSuper();
        $this->enableI18n();

        # index
        $response = $this->json('GET', '/api/v1/translatable_strings');
        $response->assertStatus(200);

        # store
        $response = $this->json('POST', '/api/v1/translatable_strings', [
            'value' => 'test',
        ]);
        $response->assertStatus(201);
        $translatable_stringID = array_get($response->json(), 'id');
        $translatableString = TranslatableString::find($translatable_stringID);
        $translatableString->saveTranslation('value', 'translated', 'es_ES');

        # index (flattened)
        $response = $this->json('GET', '/api/v1/translatable_strings', ['flatten' => true, 'locale' => 'es_ES']);
        $response->assertStatus(200);
        $this->assertEquals(json_encode(['test' => 'translated']), $response->content());
        //dump($response->content());

        Translate::setLocale('en_US');

        # show
        $response = $this->json('GET', "/api/v1/translatable_strings/$translatable_stringID");
        $response->assertStatus(200);

        # update
        $this->json('PUT', "/api/v1/translatable_strings/$translatable_stringID", ['value' => 'updated']);
        $response = $this->json('GET', "/api/v1/translatable_strings/$translatable_stringID");
        $response->assertJson(['value' => 'updated']);

        # delete
        $response = $this->json('DELETE', "/api/v1/translatable_strings/$translatable_stringID");
        $response->assertStatus(204);
        $response = $this->json('GET', "/api/v1/translatable_strings/$translatable_stringID");
        $response->assertStatus(404);
    }

}