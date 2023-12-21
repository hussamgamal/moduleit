<?php

namespace Modules\Common\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MshMsh\Modules\Common\Controllers\Admin\Actions\CheckRoles;
use MshMsh\Modules\Common\Controllers\Admin\Actions\Crud;
use MshMsh\Modules\Common\Controllers\Admin\Actions\Form;
use MshMsh\Modules\Common\Controllers\Admin\Actions\ListItems;

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
    protected array $lang_inputs;
    protected string $method;
    protected string $action;
    protected bool $canDelete = true;
    protected bool $canAdd = true;
    protected bool $canEdit = true;
    protected bool $canShow = false;
    protected bool $paginate = true;
    protected array $includes = [];
    protected array $queryParams = [];
    protected array $moreActions = [];
    protected array $treeView = [];
    protected string $roleName;
    protected string $searchable;
    protected $formRequest;
}
