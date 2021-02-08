<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class SuperUser implements FilterInterface {

    public function before(RequestInterface $request, $arguments = null) {
        // Do something here
        if (!session()->get('isLoggedIn')) {
            return redirect()->route('login');
        }
        
        if (session()->get('admin') != 1) {
            return redirect()->route('login');
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
        // Do something here
    }

}
