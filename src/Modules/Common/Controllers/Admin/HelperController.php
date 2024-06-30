<?php

namespace Modules\Common\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Common\Controllers\Admin\Actions\CheckRoles;
use Modules\Common\Controllers\Admin\Actions\Crud;
use Modules\Common\Controllers\Admin\Actions\Form;
use Modules\Common\Controllers\Admin\Actions\ListItems;

class HelperController extends Controller
{
    use Crud,
        Form,
        ListItems,
        CheckRoles;

    protected $model;
    protected string $name;
    protected string $myname;
    protected array $list;
    protected array $inputs;
    protected array $langInputs;
    protected string $method = 'post';
    protected string $action;
    protected bool $canDelete = true;
    protected bool $canAdd = true;
    protected bool $canEdit = true;
    protected bool $canShow = false;
    protected bool $paginate = true;
    protected array $includes = [];
    protected array $queryParams = [];
    protected array $moreActions = [];
    public array $treeView = [];
    public array $speed_links = [];
    protected $roleName = null;
    protected $routeSortList = null;
    protected string $searchable;
    protected $formRequest;
    protected $requestQueries = [];
}
