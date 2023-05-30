<?php

/**
 *  resources/views/livewire/backend/users/live-usertable.blade.php
 *  app/Http/Livewire/backend/users/LiveUsertable.php
 */

namespace App\Http\Livewire\Backend\Users;

use Livewire\{Component, TemporaryUploadedFile, WithPagination, WithFileUploads};
use App\Http\Requests\usuarioRequest;
// use App\Models\backend\Perfil;
use App\Models\User as Item;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class LiveUsertable extends Component
{
    use WithPagination, WithFileUploads;
    public $display = [
        'title' => 'Usuarios',
        'caption' => 'Roles',
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
        'actives' => 'Actives?',
    ];
    public $fields = [
        //0
        'id' => [
            'title' => 'id',
            'input' => ['type' => 'text',  'hidden' => false, 'disabled' => true],
            'table' => ['hidden' => false, 'disabled' => true]
        ],
        //1
        'profile_photo_path' => [
            'title' => 'Foto',
            'input' => ['type' => 'text', 'hidden' => true, 'disabled' => false],
            'table' => ['hidden' => false, 'disabled' => false]
        ],
        //2
        'name' => [
            'title' => 'name',
            'input' => ['type' => 'text',  'hidden' => true, 'disabled' => false],
            'table' => ['hidden' => false, 'disabled' => false]
        ],
        //3
        'email' => [
            'title' => 'email',
            'input' => ['type' => 'mail', 'hidden' => true, 'disabled' => false],
            'table' => ['hidden' => false, 'disabled' => false]
        ],
        //4
        'is_active' => [
            'title' => 'Activo ?',
            'input' => ['type' => 'checkit',  'hidden' => true, 'disabled' => false],
            'table' => ['hidden' => false, 'disabled' => false]
        ],
        //5
        'role' => [
            'title' => 'role',
            'input' => ['type' => 'text',  'hidden' => true, 'disabled' => true],
            'table' => ['hidden' => false, 'disabled' => true]
        ],
    ];


    /** campos del formulario */
    public $name = '';
    public $email = '';
    public $is_active = '';
    public $profile_photo_path = '';
    public $role = [];
    public $password = '';
    public $password_confirmation = '';
    public $item = null;

    // orden y filtro
    public $sortField = 'id', $sortDir = 'desc';
    // campos por los cuales ordenar
    public $fieldsOrden = array('id', 'name', 'email', 'is_active', 'role');
    public $nameOrden = array('id', 'Nombre', 'e-Mail', 'activo', 'rol');

    public $wmViews = 5;
    public $collectionViews = array('5', '10', '25', '50',); //'all'

    // elemento de busqueda
    public $fieldsSearch = array('id', 'name', 'email');
    public $bSearch;
    public $search = '';

    // elemento role
    public $bRole = true;
    public $wmUserRoles = null;
    public $userRoles = null;

    // elemento checkit
    public $bChk;
    public $chkAll;

    // elemento activo
    public $bActive;
    public $activeAll;

    // carga de la pantalla
    public $readyToLoad = false;

    // control del modal
    public $hidden1 = 'hidden'; // 'hidden'=cerrado, ''=abierto
    public $hidden2 = 'hidden'; // 'hidden'=cerrado, ''=abierto
    public $modo = null;
    public $modalId = "";
    public $modalTitle = null;
    public $modalButton = null;

    /** escuchas */
    protected $listeners = [
        'search' => 'fncSearch',
        'updatingSearch',
        'closeModal',
        'DeleteUserConfirm' => 'DeleteUser',
        'render',
        // 'roleUpdating' => 'render',
    ];

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'id'],
        'sortDir' => ['except' => 'desc'],
    ];

    public function __construct()
    {
        $this->bActive = true;
        $this->bSearch = true;
        $this->bChk = false;
        $this->emitTo('live-search', 'fncSearchFields', $this->nameOrden);
    }

    public function render()
    {
        // if ($this->search)
        //     dd('tiene algo:', $this->search);
        $items = $this->updatedQuery();
        // $items = Item::orWhere('id', 'like', "%{$this->search}%")
        //     ->orWhere('name', 'like', "%{$this->search}%")
        //     ->orWhere('email', 'like', "%{$this->search}%")
        //     ->orderBy($this->sortField, $this->sortDir)
        //     ->paginate($this->wmViews);
        return view('livewire.backend.users.live-usertable', [
            'items' => $items
        ]);
    }

    public function updatedQuery()
    {
        $this->userRoles = Role::pluck('name', 'name')->toArray();
        // dd($this->userRoles);
        // if ($this->readyToLoad) {
        $collection = Item::where('id', '>', 0)
            // ->Role($this->wmUserRoles) // scope en el modelo User
            ->when($this->search, function ($query) {
                $srch = "%$this->search%";
                return $query->where('id', 'like', $srch)
                    ->orWhere('name', 'like', $srch)
                    ->orWhere('email', 'like', $srch)
                    ->orWhere('role', 'like', $srch);
                // ->orWhereHas('r_filtroenelmodelo', function ($query) use ($srch) {
                //     $query->where('nombredecampo', 'like', $srch);
            })

            ->when($this->wmUserRoles, function ($query) {
                // dump($srch);
                return $query->Role($this->wmUserRoles);
                // return Item::Termino($query, $this->wmUserRoles);
            })

            ->when($this->sortField || $this->sortDir, function ($query) {
                if ($this->sortField === 'otro') {
                    // return $query->orderBy(Perfil::select('edad')->whereColumn('perfiles.user_id', 'users.id'), $this->sortDir);
                } else {
                    return $query->orderBy($this->sortField, $this->sortDir);
                }
            })

            ->when($this->activeAll, function ($query) {
                return $query->active($query);
            });
        // } else {
        //     $collection = [];
        // }

        // if ($this->readyToLoad) {
        if ($this->wmViews == "All") {
            $this->resetPage();
            $TotalRegs = $this->fncTotalRegs();
            $this->wmViews = $TotalRegs;
        }
        $collection = $collection->paginate($this->wmViews);
        // $this->permisos = Permission::all();
        // }
        return $collection;
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
    public function wc_Orden($sortField = 'id')
    {
        if ($sortField == null || !in_array($sortField, $this->fieldsOrden))
            return;
        // dd($sortField);
        if ($this->sortField == $sortField) {
            $this->sortDir = $this->sortDir == 'desc' ? 'asc' : 'desc';
        } else {
            $this->sortField = $sortField;
            $this->sortDir = $sortField == 'id' ? 'desc' : 'asc';
        }

        // $this->updatedQuery();
    }

    public function wc_ItemAddEdit($item)
    {
        $this->wc_Clear();
        // dd($item);
        if ($item === 0) //crear
        {
            $this->modo = 0;
            $this->fncLimpiarCampos();
        } else { // editar
            $this->modo = 1;
            $this->fncLlenarCampos($item);
        }
        //
        $this->fncModal(1);
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
        $this->fncLlenarCampos($item);

        $this->modalTitle = __("Delete Register : ");
        $this->modalId = $item;
        $this->modalButton = __("Yes");

        $this->fncModal(2);
    }

    public function wc_borrarUsuario(Item $item)
    {
        // dd($this->item);
        if ($item->id > 2) {
            $item->r_setting()->delete();
            $item->delete();
        }
        $this->emit('render');
        $this->wc_Clear();
        $this->emit('deleteUser');
    }
    public function wc_Store()
    {
        $usersRequest = new usuarioRequest();
        $values = $this->validate($usersRequest->rules($this->item), $usersRequest->messages());
        // dd($values, $this->item);
        // dd("acá se validaron los campos", $values);

        // esta instruccion agrupa el edit y el create
        // $this->item->updateOrCreate($values);
        //
        if ($this->modo) {
            // editar registro

            // agrega donde se guardó la foto físicamente
            $location = ['profile_photo_path' => $this->fncLoadImage($values['profile_photo_path'])];
            if ($this->item->profile_photo_path != $location['profile_photo_path']) {
                $this->fncDeleteImage($this->item->profile_photo_path);
                $values = array_merge($values, $location);
            }
            $this->item->update($values);
            /**
             * actualizar tablas asociadas
             *
             */
            $this->item->syncRoles([$values['role']]);
        } else {
            // nuevo registro
            $location = $this->fncLoadImage($values['profile_photo_path']);
            // dd($location);

            $item = new Item;
            $item->fill($values);

            // asigna el rol
            $item->assignRole($values['role']);

            // agrega donde se guardó la foto físicamente
            $item->profile_photo_path = $location;

            // encriptar la password, si no se encripta automáticamente en el modelo
            // $item->password = bcrypt($values['password']);

            // campo que corresponde a otra tabla
            $role = $values['role'];
            DB::transaction(function () use ($item, $role) {
                $item->save();
                // $item->r_role()->associate($role)->save();
            });
        }

        //
        $this->emit('render');
        $this->wc_Clear();
    }
    public function role()
    {
        // dd('llegó al problema', $this->role);
    }

    public function updated($field)
    {
        $usersRequest = new usuarioRequest();
        $this->validateOnly($field, $usersRequest->rules([$this->item]), $usersRequest->messages());
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

    public function fncTotalRegs()
    {
        return Item::count();
    }
    public function bSearch(): Attribute
    {
        return new Attribute(
            get: fn () => $this->bSearch,
            set: fn ($value) => $this->bSearch = $value,
        );
    }

    public function bActive(): Attribute
    {
        return new Attribute(
            get: fn () => $this->bActive,
            set: fn ($value) => $this->bActive = $value,
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
        $this->modalId = '';
        $this->modalButton = __("Save");

        $this->reset(
            'name',
            'email',
            'role'
        );
        $this->is_active = true;
        $this->profile_photo_path = '';
    }
    public function fncLlenarCampos($i)
    {
        $this->item = Item::findOrFail($i);
        // dd($this->item);
        $this->modalTitle = __("Edit Register : ") . $this->item->id;
        $this->modalId = $i;
        $this->modalButton = __("Update");

        $this->name = $this->item->name;
        $this->email = $this->item->email;
        $this->is_active = $this->item->is_active;
        $this->profile_photo_path = $this->item->profile_photo_path;
        $this->role = $this->item->Roles()->first()->name;
        // dd($this->name, $this->email, $this->is_active, $this->profile_photo_path, $this->role);
    }
    public function fncModal($modal)
    {
        if ($modal == 1) {
            if ($this->hidden1 === 'hidden')
                $this->hidden1 = '';
            else
                $this->hidden1 = 'hidden';
        } elseif ($modal == 2) {
            if ($this->hidden2 === 'hidden')
                $this->hidden2 = '';
            else
                $this->hidden2 = 'hidden';
        }
    }

    public function fncLoadImage(TemporaryUploadedFile $image)
    {
        $ext = $image->getClientOriginalExtension();
        $location = Storage::disk('public')->put('images/avatars', $image);

        return $location;
    }
    public function fncDeleteImage(string|null $image)
    {
        $existe = Storage::disk('public')->exists($image);
        // dd($existe, $image);
        if ($image && $existe)
            Storage::disk('public')->delete($image);

        return;
    }
}
