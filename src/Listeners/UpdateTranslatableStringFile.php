<?php

namespace Belt\Content\Listeners;

use Belt;
use Belt\Core\Events\ItemSaved;
use Belt\Content\Services\TranslateStringService;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class UserWelcomeEmail
 * @package Belt\Core\Listeners
 */
class UpdateTranslatableStringFile implements ShouldQueue
{
    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    public $service;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    public function service()
    {
        return $this->service ?: $this->service = new TranslateStringService();
    }

    /**
     * Handle the event.
     *
     * @param  ItemSaved $event
     * @return void
     */
    public function handle(ItemSaved $event)
    {
        $translation = $event->item();

        if ($translation->translatable instanceof Belt\Content\TranslatableString) {
            $this->service()->buildStorageFile($translation->locale);
        }
    }

}