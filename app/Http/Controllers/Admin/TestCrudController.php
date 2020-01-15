<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\TestRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TestCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TestCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Test');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/test');
        $this->crud->setEntityNameStrings('test', 'tests');

        $this->data['widgets']['before_content'] = [
            [
                'type' => 'card',
                'wrapperClass' => 'col-sm-12',
                'class' => 'card bg-info',
                'content' => [
                    'header' => 'Example to test inline editing on DataTables',
                    'body' => '<p>In the table below, items with a blue dotted line underneath are editable without reloading the page. Click on a value to edit it. After editing, press "enter" or click the "tick" button and the new value will be sent to the database.</p><p>Ticking or un-ticking the checkbox will also update the database directly</p>'
                ]
            ]
        ];
    }

    protected function setupListOperation()
    {
        $this->crud->setColumns([
            [
                'name' => 'ngo',
                'type' => 'editable_text',
                'label' => 'NGO',
            ],
            [
                'name' => 'district',
                'type' => 'editable_text',
                'label' => 'District',
            ],
            [
                'name' => 'served_bens',
                'type' => 'number',
                'label' => '# of Served Beneficiaries',
            ],
            [
                'name' => 'served_bens_confirm',
                'type' => 'editable_number',
                'label' => 'Confirm # of Served Beneficiaries',
            ],
            // [
            //     'name' => 'comments',
            //     'type' => 'editable_text',
            //     'label' => 'Explanation of non-matching numbers',
            // ],
            [
                'name' => 'confirmed',
                'type' => 'editable_checkbox',
                'label' => 'Confirmed',
            ],
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(TestRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function editable (Request $request)
    {

        $id = $request->pk;
        $propertyName = $request->name;
        $value = $request->value;

        $item = $this->crud->model->find($id);

        if( !$item) {
            return response('cannot find the correct item to update', 500);
        }

        $item->$propertyName = $value;

        if(! $item->save()) {
            return response("Cannot save the item with the property $propertyName = $value", 500);
        }

        return $item;
    }

}
