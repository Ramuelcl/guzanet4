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

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class LiveRoletable extends Component
{
    use WithPagination;

    public $display = [
        'title' => 'Roles',
        'caption1' => 'Roles',
        'caption2' => 'Permisos',
        'clear' => 'Clear',
        'no records' => 'No records to show',
        'created' => 'creado...',
        'edited' => 'editado...',
        'deleted' => 'borrado...',
        'new' => 'Crear',
        'show' => 'Ver',
        'save' => 'Guardar',
        'actions' => 'Acciones',
        'delete' => 'Borrar',
        'edit' => 'Editar',
        'search' => 'Buscar...',
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
    public $item = null;
    protected $items1 = null;
    protected $items2 = null;

    // orden y filtro
    public $sortField1 = 'name', $sortDir1 = 'asc';
    public $sortField2 = 'name', $sortDir2 = 'asc';
    // campos por los cuales ordenar
    public $fieldsOrden = array('name');

    public $nameOrden = array('Nombre');

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
        'render',
        'fncStoreRole'
        // 'roleUpdating' => 'render',
    ];

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField1' => ['except' => 'id'],
        'sortDir1' => ['except' => 'desc'],
    ];

    public function __construct()
    {
        $this->bActive = false;
        $this->bSearch = false;
        $this->bChk = false;
        if ($this->bSearch)
            $this->emitTo('live-search', 'fncSearchFields', $this->nameOrden);
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
        $collection = Role::where('id', '>', '0')->get();

        $collection = $collection->when($this->search, function ($query) {
            $srch = "%$this->search%";
            return $query->Where('name', 'like', $srch);
        });
        $collection = $collection->when($this->sortField1 || $this->sortDir1, function ($query) {
            // return $query->orderBy($this->sortField1, $this->sortDir1);
        });
        // dd($collection);

        $collection = $collection->each(function ($role) {
            $role->count_user = User::role($role->id)->count();
        });
        $this->items1 = $collection;

        $this->items2 = Permission::where('id', '>', 0)
            ->when($this->search, function ($query) {
                $srch = "%$this->search%";
                // dd($srch);
                return $query->where('name', 'like', $srch);
            })

            ->when($this->sortField2 || $this->sortDir2, function ($query) {
                return $query->orderBy($this->sortField2, $this->sortDir2);
            });

        // if ($this->readyToLoad) {
        // $this->items1 = $this->items1->paginate($this->wmViews);

        // $this->items1 = $this->items1->paginate($this->wmViews);
        $this->items2 = $this->items2->paginate($this->wmViews);
        return;
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
    public function wc_Orden($sortField = 'name', $tabla)
    {
        if ($sortField == null || !in_array($sortField, $this->fieldsOrden))
            return;
        // dd($sortField, $tabla);
        if ($tabla == 'roles') {
            if ($this->sortField1 == $sortField) {
                $this->sortDir1 = $this->sortDir1 == 'desc' ? 'asc' : 'desc';
            } else {
                $this->sortField1 = $sortField;
                $this->sortDir1 = $sortField == 'id' ? 'desc' : 'asc';
            }
        } else {
            if ($this->sortField2 == $sortField) {
                $this->sortDir2 = $this->sortDir2 == 'desc' ? 'asc' : 'desc';
            } else {
                $this->sortField2 = $sortField;
                $this->sortDir2 = $sortField == 'id' ? 'desc' : 'asc';
            }
        }
        // $this->updatedQuery();
    }

    public function wc_ItemAddEdit($item)
    {
        $this->wc_Clear();
        // dd($item);
        if ($item === 0) //crear
        {
            $this->modalAction = ['model' => 'role', 'id' => 0, 'item' => ['name' => ''], 'action' => 'new', 'call' => 'fncStoreRole'];
            $this->fncLimpiarCampos();
        } else { // editar

            $this->modalAction = ['model' => 'role', 'id' => $item['id'], 'item' => $item, 'action' => 'edit', 'call' => 'fncStoreRole'];
            $this->fncLlenarCampos($item);
        }
        //
        $this->emitTo('live-modal', 'fncCargaModal', $item, $this->modalTitle, $this->modalButton, $this->modalAction);
        // $this->fncToggleModal();
        // dd($this->name, $this->email, $this->is_active, $this->profile_photo_path, $this->role);
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
        $this->reset();
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

        Session::flash('success', 'Registro borrado satisfactoriamente');
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
            $message = 'Role edited successfully';
        } else {
            Role::create(['name' => $item['name'], 'guard_name' => "web"]);
            $message = 'Role created successfully';
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
    public function fncLimpiarCampos()
    {
        $this->modalTitle = __("New Register");
        $this->modalButton = __("Save");

        // $this->reset(
        //     'name',
        // );
    }
    public function fncLlenarCampos($i)
    {
        // dd($i);
        // $this->items1 = Role::findById($i); //->pluck("name");
        // dd($this->items1);
        $this->modalTitle = __("Edit Register : ") . $i['id'];
        $this->modalButton = __("Update");

        // $this->name = $this->items1->name;
        // return $this->items1;
        // dd($this->name, $this->email, $this->is_active, $this->profile_photo_path, $this->role);
    }
    // public function fncModal($modal)
    // {
    //     if ($modal == 1) {
    //         if ($this->hidden1 === 'hidden')
    //             $this->hidden1 = '';
    //         else
    //             $this->hidden1 = 'hidden';
    //     } elseif ($modal == 2) {
    //         if ($this->hidden2 === 'hidden')
    //             $this->hidden2 = '';
    //         else
    //             $this->hidden2 = 'hidden';
    //     }
    // }

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
    // public function fncToggleModal($option = null)
    // {
    //     $this->emitTo('live-modal', 'fncToggleModal');

    //     // $this->showModal = $this->showModal ? false : true;

    //     // if ($option == 'permisos') {
    //     //     $this->hidden = $this->hidden ? '' : 'hidden';
    //     // } elseif ($option == 'edit' || $option == 'new') {
    //     //     $this->hidden1 = $this->hidden1 ? '' : 'hidden';
    //     // } elseif ($option == 'delete') {
    //     //     $this->hidden2 = $this->hidden2 ? '' : 'hidden';
    //     // } else {
    //     //     $this->hidden =  'hidden';
    //     //     $this->hidden1 = 'hidden';
    //     //     $this->hidden2 = 'hidden';
    //     // }
    // }
}
