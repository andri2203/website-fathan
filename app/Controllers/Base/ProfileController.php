<?php

namespace App\Controllers\Base;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\RequestInterface;
use Psr\Log\LoggerInterface;

class ProfileController extends Controller
{
    protected $helpers = [];

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->request = $request;

        $this->session = \Config\Services::session();
        $this->userModel = new \App\Models\UsersModel();
        $this->user = $this->userModel->asObject()->find($this->session->id);
    }
}
