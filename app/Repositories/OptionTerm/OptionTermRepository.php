<?php

namespace App\Repositories\OptionTerm;

use Illuminate\Contracts\Container\Container;
use App\OptionTerm;

class OptionTermRepository implements OptionTermInterface
{
    protected $model;

    /**
     * Constructor.
     *
     * @param  \Illuminate\Contracts\Container\Container $app
     * @return void
     */
    public function __construct(Container $app)
    {
        $this->model = $app[OptionTerm::class];
    }

    public function getTerms() {
        $terms = $this->model->all();
        return $terms;
    }
}