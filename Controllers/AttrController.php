<?php

class AttrController extends BaseController
{
    private $attribute;
    public function __construct()
    {
        $this->loadModel('Attr');
        $this->attribute = new Attr();
    }
    public function attributes()
    {
        // echo "attributes";

        $attributes = $this->attribute->show();
        // var_dump($attributes);
        $this->view('admin.pages.attributes.listAttribute',
            ['attributes' => $attributes]
        );
    }

    public function create()
    {
        $attr = [
            'attribute_name' => $_POST['attribute_name']
        ];
        $this->attribute->create($attr);
        header('Location: index.php?controller=attr&action=attributes');
    }

    public function edit()
    {
        $attribute = $this->attribute->find($_GET['id']);
        $this->view('admin.pages.attributes.editAttribute',
            ['attribute' => $attribute]
        );
    }

    public function update()
    {
        $attr = [
            'attribute_name' => $_POST['attribute_name']
        ];
        $id = $_GET['id'];
        $this->attribute->update($id, $attr);
        header('Location: index.php?controller=attr&action=attributes');
    }

    public function delete()
    {
        $this->attribute->delete($_GET['id']);
        header('Location: index.php?controller=attr&action=attributes');
    }
}