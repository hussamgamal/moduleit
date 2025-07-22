<?php

namespace Modules\Common\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use MshMsh\Actions\Crud;
use MshMsh\Actions\Form;
use MshMsh\Actions\ListItems;
use MshMsh\Actions\MiddlewareList;

class HelperController extends Controller implements HasMiddleware
{
    use Crud,
        Form,
        ListItems,
        MiddlewareList;

    protected $model;
    protected string $name;
    protected string $myname;
    protected array $list;
    protected array $inputs;
    protected array $langInputs;
    protected string $method = 'post';
    protected string $action;
    protected bool $paginate = true;
    protected array $includes = [];
    protected array $queryParams = [];
    protected array $moreActions = [];
    public array $treeView = [];
    public array $speed_links = [];
    protected $routeSortList = null;
    protected string $searchable;
    protected $formRequest;
    protected $requestQueries = [];
    protected bool $canSort = false;
    protected bool $canChangeStatus = false;
}
