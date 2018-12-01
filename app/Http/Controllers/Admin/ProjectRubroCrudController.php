<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\Project_rubroRequest as StoreRequest;
use App\Http\Requests\Project_rubroRequest as UpdateRequest;

/**
 * Class Project_rubroCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ProjectRubroCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\ProjectRubro');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/proyrubro');
        
        $this->crud->addFilter([ // select2 filter
            'name' => 'project_id',
            'type' => 'select2',
            'label'=> 'Proyecto'
          ], function() {
              return \App\Project::all()->pluck('name', 'id')->toArray();
          }, function($value) { // if the filter is active
                  $this->crud->addClause('where', 'project_id', $value);
          });
          //$this->crud->groupBy();
          $this->crud->enableDetailsRow('project_id');
          $this->crud->allowAccess('details_row');
            //$this->crud->limit();

            //$this->crud->orderBy('project_id');
        //$this->crud->setEntityNameStrings('proyrubro', 'proyrubro');
        $this->crud->addColumn([
            //'name' => 'category_id', // The db column name
            'label' => "Proyecto", // Table column heading
            'type' => 'select',
            'name' => 'project_id', // the db column for the foreign key
            'entity' => 'project', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            ]);

            
        $this->crud->addColumn([
            //'name' => 'category_id', // The db column name
            'label' => "Categoria", // Table column heading
            'type' => 'select',
            'name' => 'item_id', // the db column for the foreign key
            //'name' => 'category_id', // the db column for the foreign key
            'entity' => 'state.categoria', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
        ]);
            


        $this->crud->addColumn([
            //'name' => 'category_id', // The db column name
            'label' => "Rubro", // Table column heading
            'type' => 'select',
            'name' => 'item_id2', // the db column for the foreign key
            'entity' => 'state', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            ]);
        
        

        $this->crud->addField(
            [  // Select
                'label' => "Proyecto",
                'type' => 'select',
                'name' => 'project_id', // the db column for the foreign key
                'entity' => 'project', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                //'model' => "App\Models\QuestionCategory" // foreign key model
                ]
        );

        $this->crud->addField(
            [  // Select
                'label' => "Rubro",
                'type' => 'select',
                'name' => 'item_id', // the db column for the foreign key
                'entity' => 'state', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                //'model' => "App\Models\QuestionCategory" // foreign key model
                ]
        );

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        //$this->crud->setFromDb();

        // add asterisk for fields that are required in Project_rubroRequest
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
