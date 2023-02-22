<?php

class AdminController extends BaseController {
    public function dashboard() {
        $this->view('admin.pages.dashboard');
    }

    public function billing() {
        $this->view('admin.pages.billing');
    }

    public function profile() {
        $this->view('admin.pages.profile');
    }

    public function tables() {
        $this->view('admin.pages.tables');
    }

    public function signin() {
        $this->view('admin.pages.sign-in');
    }

    public function signup() {
        $this->view('admin.pages.sign-up');
    }
}