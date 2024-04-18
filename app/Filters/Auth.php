<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface {

    public function before(RequestInterface $request, $arguments = null) {
        if(!session()->get('logged_in')) {
            $url = base_url() . "/user/show_login";
            header( "refresh: 0.01; url=$url" );
            exit(0);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
        // Do something here
    }
}

