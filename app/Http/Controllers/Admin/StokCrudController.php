<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\StokRequest as StoreRequest;
use App\Http\Requests\StokRequest as UpdateRequest;

class StokCrudController extends CrudController
{
    public function setup()
    {
        parent::__construct();

        $this->middleware('jumlah');
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Stok');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/stok');
        $this->crud->setEntityNameStrings('stok', 'stoks');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        // $this->crud->setFromDb();
        
        
        $this->crud->setColumns(['namabarang', 'harga', 'jumlah', 'keterangan', 'created_at', 'updated_at']);
        
        $this->crud->addColumn([
           // 1-n relationship
           'label' => "gudang", // Table column heading
           'type' => "Select",
           'name' => 'gudang_id', // the column that contains the ID of that connected entity;
           'entity' => 'gudang', // the method that defines the relationship in your Model
           'attribute' => 'lokasi', // foreign key attribute that is shown to user
           'model' => "App\Models\Gudang", // foreign key model
        ]);
        
        

        $this->crud->addField([
            'name' => 'namabarang',
            'label' => "Nama Barang"
        ], 'update/create/both');
        
        $this->crud->addField([
            'name' => 'harga',
            'label' => "Harga Barang"
        ], 'update/create/both');


        $this->crud->addField([
            'name' => 'jumlah',
            'label' => "Jumlah Barang"
        ], 'update/create/both');

        $this->crud->addField([
            'name' => 'keterangan',
            'label' => "Keterangan Barang",
            'type' => 'tinymce'
        ], 'update/create/both');

        $this->crud->addField([  // Select2
           'label' => "gudang",
           'type' => 'select',
           'name' => 'gudang_id', // the db column for the foreign key
           'entity' => 'gudang', // the method that defines the relationship in your Model

           'attribute' => 'lokasi', // foreign key attribute that is shown to user
           'model' => "App\Models\Gudang" // foreign key model
        ], 'update/create/both');

        $this->crud->addField([
            'name' => "created_at",
            'label' => "Dibuat tgl",
            'type' => 'date'
            ]);

        $this->crud->addField([
            'name' => "updated_at",
            'label' => "Diupdate tgl",
            'type' => 'date'
            ]);


        // $this->crud->addField([
        //     'name' => 'slug',
        //     'label' => "URL Segment (slug)"
        // ], 'update/create/both');
        $this->crud->addField('jumlah', 'update/create/both'); // a lazy way to add fields: let the CRUD decide what field type it is and set it automatically, along with the field label
        $this->crud->addField('harga', 'update/create/both');
        $this->crud->addField('namabarang', 'update/create/both');
        // $this->crud->addFields($array_of_fields_definition_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // $this->crud->addField([       // Select2Multiple = n-n relationship (with pivot table)
        //     'label' => "Articles",
        //     'type' => 'select2_multiple',
        //     'name' => 'articles', // the method that defines the relationship in your Model
        //     'entity' => 'articles', // the method that defines the relationship in your Model
        //     'attribute' => 'title', // foreign key attribute that is shown to user
        //     'model' => "App\Models\Article", // foreign key model
        //     'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
        // ], 'update');

        // $this->crud->addField([       // Select2Multiple = n-n relationship (with pivot table)
        //     'label' => "Tags",
        //     'type' => 'select2_multiple',
        //     'name' => 'tags', // the method that defines the relationship in your Model
        //     'entity' => 'tags', // the method that defines the relationship in your Model
        //     'attribute' => 'namabarang', // foreign key attribute that is shown to user
        //     'model' => "App\Models\Stok", // foreign key model
        //     'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
        // ]);

        // $this->crud->addColumn($column_definition_array); // add a single column, at the end of the stack
        // $this->crud->addColumns($array_of_column_definition_arrays); // add multiple columns, at the end of the stack
        $this->crud->removeColumn('column_name'); // remove a column from the stack
        $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']);
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

        // $this->crud->setColumns($array_of_column_definition_arrays);

        // $this->crud->addColumn('text'); // add a text column, at the end of the stack
        // $this->crud->addColumn([
        //             'name' => 'integer',
        //             'type' => 'integer',
        //             'label' => 'integer',
        //  ]);


        // $this->crud->addFilter($options, $values, $filter_logic);
        // $this->crud->removeFilter($name);
        $this->crud->removeAllFilters();

        // $this->crud->addFields($array_of_fields_definition_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // $this->crud->addField([       // Select2Multiple = n-n relationship (with pivot table)
        //     'label' => "Gudangs",
        //     'type' => 'select2_multiple',
        //     'name' => 'gudangs', // the method that defines the relationship in your Model
        //     'entity' => 'gudangs', // the method that defines the relationship in your Model
        //     'attribute' => 'typegudang', // foreign key attribute that is shown to user
        //     'model' => "App\Models\Gudang", // foreign key model
        //     'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
        // ], ‘update’);

        // $this->crud->addField([       // Select2Multiple = n-n relationship (with pivot table)
        //     'label' => "Stoks",
        //     'type' => 'select2_multiple',
        //     'name' => 'stoks', // the method that defines the relationship in your Model
        //     'entity' => 'stoks', // the method that defines the relationship in your Model
        //     'attribute' => 'namabarang', // foreign key attribute that is shown to user
        //     'model' => "App\Models\Stok", // foreign key model
        //     'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
        // ]);

        // $this->crud->addColumn($column_definition_array); // add a single column, at the end of the stack
        // $this->crud->addColumns($array_of_column_definition_arrays); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']);
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

        // $this->crud->setColumns($array_of_column_definition_arrays);

        // $this->crud->addColumn('text'); // add a text column, at the end of the stack
        // $this->crud->addColumn([
        //             'name' => 'date',
        //             'type' => 'date',
        //             'label' => 'Date',
        //  ]);
        // ------ CRUD FIELDS
        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD COLUMNS
        // $this->crud->addColumn(); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

        // ------ CRUD BUTTONS
        $this->crud->addButtonFromModelFunction('top', 'kirim', 'checkitem', 'end');
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);
        // $this->crud->removeAllButtons();
        // $this->crud->removeAllButtonsFromStack('line');

        // ------ CRUD ACCESS
        // $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
        // $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);

        // ------ CRUD REORDER
        // $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');

        // ------ CRUD DETAILS ROW
        // $this->crud->enableDetailsRow();
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('details_row');
        // NOTE: you also need to do overwrite the showDetailsRow($id) method in your EntityCrudController to show whatever you'd like in the details row OR overwrite the views/backpack/crud/details_row.blade.php

        // ------ REVISIONS
        // You also need to use \Venturecraft\Revisionable\RevisionableTrait;
        // Please check out: https://laravel-backpack.readme.io/docs/crud#revisions
        // $this->crud->allowAccess('revisions');

        // ------ AJAX TABLE VIEW
        // Please note the drawbacks of this though:
        // - 1-n and n-n columns are not searchable
        // - date and datetime columns won't be sortable anymore
        // $this->crud->enableAjaxTable();

        // ------ DATATABLE EXPORT BUTTONS
        // Show export to PDF, CSV, XLS and Print buttons on the table view.
        // Does not work well with AJAX datatables.
        // $this->crud->enableExportButtons();

        // ------ ADVANCED QUERIES
        // $this->crud->addClause('active');
        // $this->crud->addClause('type', 'car');
        // $this->crud->addClause('where', 'name', '==', 'car');
        // $this->crud->addClause('whereName', 'car');
        // $this->crud->addClause('whereHas', 'posts', function($query) {
        //     $query->activePosts();
        // });
        // $this->crud->addClause('withoutGlobalScopes');
        // $this->crud->addClause('withoutGlobalScope', VisibleScope::class);
        // $this->crud->with(); // eager load relationships
        // $this->crud->orderBy();
        // $this->crud->groupBy();
        // $this->crud->limit();
    }



    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);

        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
