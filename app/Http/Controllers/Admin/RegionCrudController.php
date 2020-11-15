<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RegionRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CloneOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;

/**
 * Class RegionCrudController.
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RegionCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use CloneOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Region');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/region');
        $this->crud->setEntityNameStrings('region', 'regions');
    }

    protected function setupListOperation()
    {
        $this->crud->setColumns(['id', 'name', 'slug']);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(RegionRequest::class);

        $this->crud->addFields([
            [
                'name' => 'name',
                'type' => 'text',
                'label' => 'Name',
            ],
            [
                'name' => 'slug',
                'type' => 'text',
                'label' => 'Slug',
            ],
            [
                'name' => 'info_title',
                'type' => 'text',
                'label' => 'Info card title',
            ],
            [
                'name' => 'info_body',
                'type' => 'wysiwyg',
                'label' => 'Info card body',
            ],
            [
                'name' => 'map_zoom',
                'type' => 'text',
                'label' => 'Map zoom',

            ],
            [
                'name' => 'description',
                'type' => 'textarea',
                'label' => 'Description',
            ],
            [
                'name' => 'credits',
                'type' => 'wysiwyg',
                'label' => 'Credits card body',
            ],
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
