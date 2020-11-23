<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Schema;
use Livewire\Component;
use Livewire\WithPagination;

class Datatable extends Component
{
    use WithPagination;

    public $model;
    public $columns;
    public $pagination;
    public $checked = [];
    public $query;

    protected $exclude;
    protected $paginationTheme = 'tailwind';

    /**
     * @return mixed
     */
    public function builder()
    {
        return new $this->model;
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

    public function deleteChecked()
    {
        $this->checkedRecords()->delete();
    }

    public function isChecked($record)
    {
        return in_array($record->id, $this->checked);
    }

    /**
     * @param $model
     * @param string $exclude
     * @param int $pagination
     */
    public function mount($model, string $exclude = '', int $pagination = 25)
    {
        $this->model = $model;
        $this->exclude = explode(',', $exclude);
        $this->pagination = $pagination;
        $this->columns = $this->columns();
    }

    /**
     * @return mixed
     */
    public function records()
    {
        $builder = $this->builder();

        if ($this->query) {
            $builder = $builder->search($this->query);
        }

        return $builder->paginate($this->pagination);
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


    /**
     * @return mixed
     */
    protected function checkedRecords()
    {
        return $this->builder()->whereIn('id', $this->checked);
    }
}
