<?php 

class PageController extends BaseController
{
    public function index()
    {
        $this->view('index');
    }

    public function about()
    {
        $this->view('about');
    }

    public function contact()
    {
        $this->view('contact');
    }

    public function services()
    {
        $this->view('services');
    }

    public function elements()
    {
        $this->view('elements');
    }

    public function login()
    {
        $this->view('admin.pages.sign-in');
    }

    public function signup()
    {
        $this->view('admin.pages.sign-up');
    }
    
}