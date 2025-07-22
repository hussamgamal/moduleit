<?php

namespace MshMsh\Actions;

trait ListItems
{
    public function index()
    {
        if (isset($this->canSort) && $this->canSort) {
            $this->routeSortList = route('admin.changeSortable', ['model' => $this->name]);
        }
        if (isset($this->canChangeStatus) &&  $this->canChangeStatus) {
            $this->switches['status'] = route('admin.changeStatus', ['model' => $this->name]);
        }
        if (!isset($this->rows)) {
            $this->rows = $this->model;
        }
        $this->listBuilder();

        $this->search();



        $this->treeViewBuilder();

        $this->rows = $this->rows;
        if (request('action') == 'export') {
            $this->exportList();
            $this->rows = $this->rows->latest()->paginate(99999999999);
        } else {
            if (isset($this->canSort) && $this->canSort) {
                $this->rows = $this->rows->sort()->paginate(25);
            } else {
                $this->rows = $this->rows->latest()->paginate(25);
            }
        }
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

    function exportList() {}

    public function listBuilder() {}

    public function queryParams()
    {
        $rows = $this->queryParams;
        $params = [];
        foreach ($rows as $row) {
            $params[$row] = request($row);
        }
        return $params;
    }

    public function treeViewBuilder() {}
}
