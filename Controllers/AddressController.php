<?php

class AddressController extends BaseController
{
    private $province;
    private $district;
    private $ward;

    public function getDistricts()
    {
        var_dump($_POST['id']);
        $this->loadModel('District');
        $this->district = new District();
        $districts = $this->district->find($_POST['id']);
        $json = [];
        while($row = $districts->fetch_assoc()){
             $json[$row['id']] = $row['name'];
        }     
        echo json_encode($json);
        // $this->view('admin.pages.motels.addMotel', ['districts' => $districts]);
    }

    public function getWards()
    {
        $this->loadModel('Ward');
        $wards = $this->ward->show();
        // $this->view('admin.pages.motels.addMotel', ['wards' => $wards]);
    }

}