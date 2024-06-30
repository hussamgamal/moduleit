<?php

namespace Modules\Common\Controllers\Admin\Actions;

use Illuminate\Http\Request;

trait ListItems
{
    public function index()
    {

        if (!isset($this->rows)) {
            $this->rows = $this->model;
        }
        $this->listBuilder();

        $this->search();

        $this->check_user_roles();


        $this->treeViewBuilder();

        $this->rows = $this->rows->latest()->paginate(25);

        $this->locale = app()->getLocale();

        $this->requestQueries = request()->query();
        foreach (request()->query() as $key => $value) {
            unset($this->requestQueries[$key]);
        }

        return view('Common::admin.list', get_object_vars($this));
    }

    private function search()
    {
        if (method_exists($this->model, 'model_search')) {
            $rows = $this->model->model_search($this->model, $this->rows, $this->searchable ?? null);
            $this->rows = $rows['rows'];
            $this->model = $rows['model'];
        }
    }

    public function listBuilder()
    {
    }

    public function queryParams()
    {
        $params = $this->queryParams;
        return $params;
    }

    public function treeViewBuilder()
    {
    }
}
