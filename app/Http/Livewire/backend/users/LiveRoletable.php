<?php

/**
 *  resources/views/livewire/backend/users/live-Roletable.blade.php
 *  app/Http/Livewire/backend/users/LiveRoletable.php
 */

namespace App\Http\Livewire\Backend\Users;

use App\Http\Requests\RolePermissionRequest;
use App\Http\Requests\RolPermisoRequest;
use Livewire\{Component, WithPagination};

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Session;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class LiveRoletable extends Component
{
    use WithPagination;

    public $display = [
        'title' => 'Roles & Permissions',
        'caption1' => 'Role',
        'caption2' => 'Permission',
        'clear' => 'Clear',
        'no records' => 'No records to show',
        'created' => 'Role created successfully',
        'edited' => 'Role edited successfully',
        'deleted' => 'Role deleted successfully',
        'actions' => 'actions',
        'new' => 'New',
        'edit' => 'Edit',
        'show' => 'show',
        'delete' => 'delete',
        'options' => 'options',
        'save' => 'save',
        'update' => 'update',
        'search' => 'Search...',
    ];

    public $fields = [
        //0
        'id' => [
            'title' => 'id',
            'input' => ['type' => 'text',  'hidden' => false, 'disabled' => true],
            'table' => ['hidden' => false, 'disabled' => true]
        ],
        //1
        'name' => [
            'title' => 'name',
            'input' => ['type' => 'text',  'hidden' => true, 'disabled' => false],
            'table' => ['hidden' => false, 'disabled' => false]
        ],
        //3
        'count' => [
            'title' => 'usados',
            // 'input' => ['type' => 'mail', 'hidden' => true, 'disabled' => false],
            'table' => ['hidden' => false, 'disabled' => true]
        ],
    ];

    /** campos del formulario */
    public $item;
    protected $items1 = null;
    protected $items2 = null;
    public $name, $checkit;

    // orden y filtro
    public $sortField1 = 'name', $sortDir1 = true;
    public $sortField2 = 'name', $sortDir2 = 'asc';
    // campos por los cuales ordenar
    public $fieldsOrden = array('id', 'name');
    public $orden, $uppercase, $cursorPointer;
    public $nameOrden = array('id', 'Nombre');

    public $wmViews = 5;
    public $collectionViews = array('5', '10', '25', '50',); //'all'

    // elemento de busqueda
    public $fieldsSearch = array('name');
    public $bSearch;
    public $search = '';

    // elemento role & permisos
    public $userRoles = null;
    public $userPermisos = null;

    // elemento checkit
    public $bChk;
    public $chkAll;

    // elemento role
    public $bRole = true;
    public $roleActivo;

    // elemento activo
    public $bActive;
    public $activeAll;

    // carga de la pantalla
    public $readyToLoad = false;

    // control del modal
    public $showModal = false;
    public $hidden = 'hidden'; // 'hidden'=cerrado, ''=abierto
    public $hidden1 = 'hidden'; // 'hidden'=cerrado, ''=abierto
    public $hidden2 = 'hidden'; // 'hidden'=cerrado, ''=abierto
    public $modo = null;
    public $modalAction = "";
    public $modalTitle = null;
    public $modalButton = null;

    /** escuchas */
    protected $listeners = [
        'search' => 'fncSearch',
        'updatingSearch',
        'closeModal',
        'DeleteConfirm' => 'Destroy',
        'render' => '$refresh',
        'fncStoreRole'
        // 'roleUpdating' => 'render',
    ];

    // protected $queryString = [
    //     'search' => ['except' => ''],
    //     'sortField1' => ['except' => 'id'],
    //     'sortDir1' => ['except' => 'desc'],
    // ];

    public function __construct()
    {
        $this->bActive = false;
        $this->bSearch = false;
        $this->bChk = false;
        if ($this->bSearch)
            $this->emitTo('live-search', 'fncSearchFields', $this->nameOrden);
        $this->roleActivo = Role::all()
            ->first();
        // dd($this->roleActivo);
    }

    public function render()
    {
        $this->updatedQuery();
        // dd($this->items1);

        return view('livewire.backend.users.live-roletable', [
            'roles' => $this->items1,
            'permisos' => $this->items2,
        ]);
    }

    public function updatedQuery()
    {
        $this->items1 = Role::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('name', $this->sortDir1 ? 'asc' : 'desc')
            ->get();
        $this->items1 = $this->items1->each(function ($role) {
            $role->count_user = User::role($role->id)->count();
        });
        // $collection = Role::where('id', '>', '0')->get();

        // $collection = $collection->when($this->search, function ($query) {
        //     $srch = "%$this->search%";
        //     return $query->Where('name', 'like', $srch);
        // });
        // $collection = $collection->when($this->sortField1 || $this->sortDir1, function ($query) {
        //     // return $query->orderBy($this->sortField1, $this->sortDir1);
        // });
        // // dd($collection);

        // $collection = $collection->each(function ($role) {
        //     $role->count_user = User::role($role->id)->count();
        // });
        // $this->items1 = $collection;

        $this->items2 = $this->roleActivo->permissions();

        //     ->when($this->sortField2 || $this->sortDir2, function ($query) {
        //         return $query->orderBy($this->sortField2, $this->sortDir2);
        //     });

        // if ($this->readyToLoad) {
        // $this->items1 = $this->items1->paginate($this->wmViews);

        // $this->items1 = $this->items1->paginate($this->wmViews);
        // $this->items2 = $this->items2->paginate($this->wmViews);
        // return;
    }

    public function load()
    {
        $this->wc_Clear();
        $this->readyToLoad = true;
    }

    public function fncSearch($search)
    {
        // dd('llegó a live-table.blade:', $search);
        $this->search = $search;
    }

    public function fncFieldsSearch()
    {
        foreach ($this->fieldsSearch as $key => $field) {
            // Item::orWhere('name', 'like', "%{$this->search}%"
        }
    }
    public function fncOrdenUpp($key, $sortField)
    {
        // dd($key, $field);
        // valida el campo a ordenar; si existe le pone cursor-pointer
        $this->orden = in_array($key, $this->fieldsOrden) ? $key : null;

        $this->cursorPointer = $this->orden ? 'cursor-pointer' : '';
        $this->uppercase = $key == $sortField ? 'uppercase font-bold' : 'capitalize';
    }
    public function wc_Orden($sortField = 'name', $tabla)
    {
        if ($sortField == null || !in_array($sortField, $this->fieldsOrden))
            return;
        // dd($sortField, $tabla);
        if ($tabla == 'roles') {
            $this->sortDir1 ?? false;
        } else {
            $this->sortDir2 ?? false;
        }
        // $this->updatedQuery();
    }
    public function wc_ShowPermissions(Role $role)
    {
        $this->roleActivo = $role;
        $this->render();
    }
    public function wc_Permisos(Role $item)
    {
        // $this->wc_Clear();
        // dd($item, "fncValoresDeModal");
        $this->fncValoresDeModal($item, 'permission');

        $this->emitTo('live-modal', 'fncCargaModal', $item, $this->modalTitle, $this->modalButton, $this->modalAction);

        return;
    }

    public function wc_ItemAddEdit(Role $item)
    {
        // dd($item);
        if (isset($item->id)) { // edicion
            $this->modo = 'edit';
        } else { // nuevo

            $this->modo = 'new';
        }
        $this->wc_Clear();
        $this->fncValoresDeModal($item, 'role');

        $this->emitTo('live-modal', 'fncCargaModal', $item, $this->modalTitle, $this->modalButton, $this->modalAction);

        return;
    }
    public function wc_Show()
    {
        //
    }
    public function wc_Clear()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->resetPage();
        $this->reset('item', 'name', 'checkit');
        // $this->reset(['search', 'activeAll', 'sortField', 'sortDir', 'wmViews', 'wmUserRoles']);
        $this->emit('fncSearchClear');
    }
    public function wc_ConfirmDelete($item)
    {
        dd($this->item);
        $this->fncLlenarCampos($item);

        $this->modalTitle = __("Delete Register : ");
        $this->modalAction = 'Destroy';
        $this->modalButton = __("Yes");

        // $this->fncModal(2);
    }
    public function Destroy($item)
    {
        // dd($item);
        $item = Role::find($item['id']);

        $item->delete();
        // echo "<script> agregarToast('info, 'Eliminando registro', 'Se elimino registro satisfactoriamente', true);</script>";
        // $this->agregarToast("info", "Eliminando registro", "Se elimino registro:" . $item['id'] . " Satisfactoriamente", true);
        Session::flash('success', $this->display['deleted']);
        $this->emit('render');
        $this->wc_Clear();

        $this->emit('delete');
    }

    public function fncStoreRole($item)
    {
        $item = $item["item"];
        // dd($item, "fncStoreRole", $this->modalAction);
        if ($this->modalAction['id']) {
            $this->item = Role::find($this->modalAction['id']);
            $this->item->update(['name' => $item['name']]);
            $message = $this->display['edited'];
        } else {
            Role::create(['name' => $item['name'], 'guard_name' => "web"]);
            $message = $this->display['created'];
        }

        // asigna el rol
        // $item->assignRole($values['role']);

        //
        Session::flash('success', $message);
        $this->emit('render');
        $this->wc_Clear();
    }

    public function fncStorePermission($item)
    {
        $item = $item["item"];
        dd($item, "fncStorePermission", $this->modalAction);
        if ($this->modalAction['id']) {
            $this->item = Role::find($this->modalAction['id']);
            $this->item->update(['name' => $item['name']]);
            $message = $this->display['edited'];
        } else {
            Role::create(['name' => $item['name'], 'guard_name' => "web"]);
            $message = $this->display['created'];
        }

        // asigna el rol
        // $item->assignRole($values['role']);

        //
        Session::flash('success', $message);
        $this->emit('render');
        $this->wc_Clear();
    }

    public function updated($field)
    {
        $Request = new RolePermissionRequest();
        $this->validateOnly($field, $Request->rules([$this->items1]), $Request->messages());
    }

    public function updatingSearch()
    {
        // dd('llegó updating');
        $this->resetPage();
    }
    public function updatedSearch()
    {
        // dd('llegó updated');
        $this->resetPage();
    }

    public function fncTotalRegs($item)
    {
        // return Item::count();
    }
    public function bSearch(): Attribute
    {
        return new Attribute(
            get: fn () => $this->bSearch,
            set: fn ($value) => $this->bSearch = $value,
        );
    }
    public function bChk(): Attribute
    {
        // dd('paso');
        return new Attribute(
            get: fn () => $this->bChk,
            set: fn ($value) => $this->bChk = $value,
        );
    }

    /**
     *
     * control de formularios
     *
     * */
    public function fncValoresDeModal($item, $modelo = null)
    {
        // dd(['modo' => $this->modo, 'item' => $item, 'modelo' => $modelo]);
        switch (\Illuminate\Support\Str::lower($modelo)) {
            case 'role':
                if ($this->modo == 'edit') { // editar
                    $num = $item->id;
                    $this->modalTitle = "Role - " . __($this->display['edit'] . " # ") . $num;
                    $this->modalButton = __($this->display['update']);

                    $this->modalAction = ['model' => $modelo, 'id' => $num, 'item' => $item, 'action' => $this->modo, 'call' => 'fncStoreRole'];
                } else { // nuevo
                    $this->modalTitle = "Role - " . __($this->display['new']);
                    $this->modalButton = __($this->display['save']);

                    $this->modalAction = ['model' => $modelo, 'id' => 0, 'item' => ['name' => ''], 'action' => $this->modo, 'call' => 'fncStoreRole'];
                }
                break;

            case 'permission':
                $AllPermissions = Permission::all();
                $role = Role::findById($item['id'])->Permissions()->get();
                $PermissionsXRole = $role->Permissions();
                dd(['item' => $item, 'rol' => '', 'permxRol' => $PermissionsXRole, 'permisos' => $AllPermissions]);
                if ($item) { // editar
                    $num = $item['id'];
                    $this->modalTitle = "Permission - " . __($this->display['edit'] . " # ") . $num;
                    $this->modalButton = __($this->display['update']);

                    $this->modalAction = ['model' => $modelo, 'id' => $item['id'], 'item' => $item, 'action' => $this->modo, 'call' => 'fncStorePermission'];
                } else { // nuevo
                    $this->modalTitle = "Permission - " . __($this->display['new']);
                    $this->modalButton = __($this->display['save']);

                    $this->modalAction = ['model' => $modelo, 'id' => 0, 'item' => ['name' => ''], 'action' => $this->modo, 'call' => 'fncStorePermission'];
                }
                break;

            default:
                # code...
                break;
        }
    }

    public function fncUppercase($field)
    {
        // dd($field);
        return $field == $this->sortField ? 'uppercase font-bold' : 'capitalize';
    }
    public function fncOrdena($field)
    {
        // dd($field);
        // valida el campo a ordenar; si existe le pone cursor-pointer
        $ordena = in_array($field, $this->fieldsOrden) ? $field : null;
        return $ordena;
    }
}
