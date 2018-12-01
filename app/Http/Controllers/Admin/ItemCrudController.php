<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ItemRequest as StoreRequest;
use App\Http\Requests\ItemRequest as UpdateRequest;

/**
 * Class ItemCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ItemCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Item');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/items');
        $this->crud->setEntityNameStrings('item', 'items');
        $this->crud->addColumn([
            //'name' => 'category_id', // The db column name
            'label' => "Categoria", // Table column heading
            'type' => 'select',
            'name' => 'category_id', // the db column for the foreign key
            'entity' => 'categoria', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            ]);

    
        $this->crud->addColumn([
            'name' => 'name', // The db column name
            'label' => "Rubro", // Table column heading
            'type' => 'Text'
            ]);
        
        $this->crud->addField(
            [  // Select
                'label' => "Categoria",
                'type' => 'select',
                'name' => 'category_id', // the db column for the foreign key
                'entity' => 'categoria', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                //'model' => "App\Models\QuestionCategory" // foreign key model
             ]
        );

        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => "Rubro"
          ]);

          $this->crud->addField([
            'name'        => 'status', // the name of the db column
            'label'       => 'Estado', // the input label
            'type'        => 'radio',
            'options'     => [ // the key will be stored in the db, the value will be shown as label; 
                                1 => "Activo",
                                0 => "Inactivo"
                            ],
            // optional
            //'inline'      => false, // show the radios all on the same line?
        ]);

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        //$this->crud->setFromDb();

        // add asterisk for fields that are required in ItemRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
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
