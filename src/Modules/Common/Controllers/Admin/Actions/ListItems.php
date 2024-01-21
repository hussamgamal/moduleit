<?php

namespace MshMsh\Modules\Common\Controllers\Admin\Actions;

trait ListItems
{
    protected function index()
    {
        if (!isset($this->rows)) {
            $this->rows = $this->model;
        }

        $this->search();

        $this->check_user_roles();

        $this->list_builder();

        $this->rows = $this->rows->latest()->paginate(25);

        $this->locale = app()->getLocale();

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

    public function list_builder()
    {
    }

    public function queryParams()
    {
        $params = $this->queryParams;
        $rows = [];
        foreach ($params as $row) {
            $rows[$row] = request($row);
        }
        return $rows;
    }
}
