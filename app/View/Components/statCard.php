<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StatCard extends Component
{
    public $title;
    public $value;
    public $icon;
    public $color;
    public $model;
    public $route;
    public $typeFilter;
    public $sumColumn;

    public function __construct(
        $title,
        $model = null,
        $icon = null,
        $color = 'blue',
        $route = null,
        $typeFilter = null,
        $sumColumn = null
    ) {
        $this->title = $title;
        $this->icon = $icon;
        $this->color = $color;
        $this->route = $route;
        $this->model = $model;
        $this->typeFilter = $typeFilter;
        $this->sumColumn = $sumColumn;

        $this->value = 0;

        if ($this->model && class_exists($this->model)) {
            $query = $this->model::query();

            if ($this->typeFilter) {
                $query->where('type', $this->typeFilter);
            }

            if ($this->sumColumn) {
                $this->value = $query->sum($this->sumColumn);
            } else {
                $this->value = $query->count();
            }
        }
    }

    public function render()
    {
        return view('components.stat-card');
    }
}