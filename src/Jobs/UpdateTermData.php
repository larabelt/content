<?php

namespace Belt\Content\Jobs;

use Belt;
use Belt\Content\Term;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateTermData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Term
     */
    public $term;

    /**
     * Create a new job instance.
     * @param Term $term
     */
    public function __construct(Term $term)
    {
        $this->term = $term;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->__handle($this->term);
    }

    /**
     * @param Term $term
     */
    public function __handle(Term $term)
    {
        $term->names = $term->getNestedNames();
        $term->slugs = $term->getNestedSlugs();
        $term->save();

        foreach ($term->children as $child) {
            $this->__handle($child);
        }
    }
}
