<?php

namespace App\Http\Livewire\components;

use App\Models\backend\Entidad;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Responsive;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class EntidadTable extends PowerGridComponent
{
    use ActionButton;

    //Custom per page
    public int $perPage = 5;

    //Custom per page values
    public array $perPageValues = [0, 5, 10, 30, 50];
    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('exportar_archivo')
                ->striped('#111111')
                ->csvSeparator(';')
                ->csvDelimiter("'")
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()
                ->showSearchInput()
                ->showToggleColumns(),
            // ->withoutLoading(),
            Footer::make()
                ->showPerPage($this->perPage, $this->perPageValues)
                // ->includeViewOnBottom('components.datatable.footer-bottom')
                ->showRecordCount(mode: 'short'), // full, short, min
            Responsive::make()
                ->fixedColumns('id', 'nombres', 'apellidos', Responsive::ACTIONS_COLUMN_NAME)
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\backend\Entidad>
     */
    public function datasource(): Builder
    {
        return Entidad::query();
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('razonSocial')
            ->addColumn('nombres', fn (Entidad $model) => ucfirst(e($model->nombres)))
            ->addColumn('apellidos', fn (Entidad $model) => strtoupper(e($model->apellidos)))
            ->addColumn('eMail')
            ->addColumn('is_active') //, fn (Entidad $model) => $model->is_active ? 'si' : 'no'
            ->addColumn('created_at')
            ->addColumn('created_at_formatted', fn (Entidad $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->searchable()
                ->sortable(),

            Column::make('Razon Social', 'razonSocial')
                ->searchable()
                ->sortable(),

            Column::make('Nombre', 'nombres')
                ->searchable()
                ->sortable(),

            Column::make('Apellidos', 'apellidos')
                ->searchable()
                ->sortable(),

            Column::make('eMail', 'eMail')
                ->searchable()
                ->sortable(),

            Column::make('Activo', 'is_active')
                ->searchable()
                ->sortable()
                ->toggleable('yes', 'no'),
            // Column::make('Created at', 'created_at')
            //     ->hidden(),

            // Column::make('Created at', 'created_at_formatted', 'created_at')
            //     ->searchable()
        ];
    }

    /**
     * PowerGrid Filters.
     *
     * @return array<int, Filter>
     */
    public function filters(): array
    {
        return [
            // Filter::inputText('nombres'),
            // Filter::datepicker('created_at_formatted', 'created_at'),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid Entidad Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [
            Button::make('edit', 'Edit')
                ->class('flex justify-between bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
                ->route('admin.entidad.edit', ['entidad' => 'id']),

            Button::make('destroy', 'Delete')
                ->class('flex justify-between  bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
                ->route('admin.entidad.destroy', ['entidad' => 'id'])
                ->method('delete')
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Entidad Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($entidad) => $entidad->id === 1)
                ->hide(),
        ];
    }
    */

    public function header(): array
    {
        return [
            Button::add('bulk-sold-out')
                ->caption(__('Nuevo'))
                ->class('cursor-pointer block bg-indigo-500 text-white rounded-lg px-2 py-2')
                ->emit('newEdit', [])
        ];
    }
}
