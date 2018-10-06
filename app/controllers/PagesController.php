<?php

namespace App\Controllers;

use Core\Base\Controller;

class PagesController extends Controller
{
    public function home()
    {
        $this->view('home');
    }

    public function about()
    {
        $this->view('about');
    }

    public function contact()
    {
        $this->view('contact');
    }

}
