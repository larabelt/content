<?php

namespace Belt\Content\Jobs;

use Belt;
use Belt\Content\Attachment;
use Belt\Content\Services\MoveService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class MoveAttachment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    /**
     * @var Attachment
     */
    public $attachment;

    /**
     * @var string
     */
    public $target;

    /**
     * @var array
     */
    public $options = [];

    /**
     * @var MoveService
     */
    public $service;

    /**
     * @return MoveService
     */
    public function service()
    {
        return $this->service = $this->service ?: new MoveService();
    }

    /**
     * MoveAttachment constructor.
     * @param $attachment
     * @param $target
     * @param array $options
     */
    public function __construct($attachment, $target, $options = [])
    {
        $this->attachment = $attachment;
        $this->target = $target;
        $this->options = $options;
    }

    /**
     * Execute the job
     *
     * @throws \Exception
     */
    public function handle()
    {
        $this->service()->move($this->attachment, $this->target, $this->options);
    }

}
