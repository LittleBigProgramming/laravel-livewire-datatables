<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Schema;
use Livewire\Component;

class Datatable extends Component
{
    public $model;
    public $columns;
    protected $exclude;

    /**
     * @return mixed
     */
    public function builder()
    {
        return $this->model::query();
    }

    /**
     * @return mixed
     */
    public function columns()
    {
        return collect(Schema::getColumnListing($this->builder()->getQuery()->from))
            ->reject(function ($column) {
                return in_array($column, $this->exclude);
            })->toArray();
    }

    /**
     * @param $model
     * @param string $exclude
     */
    public function mount($model, string $exclude = '')
    {
        $this->model = $model;
        $this->exclude = explode(',', $exclude);
        $this->columns = $this->columns();
    }

    /**
     * @return mixed
     */
    public function records()
    {
        return $this->builder()->get();
    }

    /**
     * @return
     * \Illuminate\Contracts\Foundation\Application|
     * \Illuminate\Contracts\View\Factory|
     * \Illuminate\Contracts\View\View|
     * \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.datatable');
    }
}
