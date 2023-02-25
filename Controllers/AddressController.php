<?php

class AddressController extends BaseController
{
    private $district;
    private $ward;

    public function districts()
    {
        $this->loadModel('District');
        $this->district = new District();
        $districts = $this->district->getDistricts($_POST['province']);
        foreach ($districts as $district) {
            echo "<option value='" . $district['id'] . "'>" . $district['name'] . "</option>";
        }
    }

    public function wards()
    {
        $this->loadModel('Ward');
        $this->ward = new Ward();
        $wards = $this->ward->getWard($_POST['district']);
        foreach ($wards as $ward) {
            echo "<option value='" . $ward['id'] . "'>" . $ward['name'] . "</option>";
        }
    }

}