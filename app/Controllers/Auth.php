<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->user_model = new UserModel;
    }

    public function index()
    {
        return view('auth/login');
    }

    public function proses() 
    {
        try{
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');
    
            $user = $this->user_model->where('email', $email)->get()->getRow();

            if(empty($user)) {
                return redirect()->to(site_url())->with('error', 'Email Tidak Terdaftar');
            } else if (!password_verify($password, $user->password)) {
                return redirect()->to(site_url())->with('error', 'Password Salah');
            } else {
                $data = [
                    'id' => $user->user_id,
                    'nama' => $user->user_name,
                    'email' => $user->email,
                    'role_id' => $user->role_id,
                    'login' => true,
                ];

                $this->session->set($data);
                $this->session->markAsTempdata('login', 3600);

                return redirect()->to('buku/list-buku');
            }
        } catch (DatabaseException $e) {
            return redirect()->to(site_url())->with('error', $e->getMessage());
        }
    }

    public function logout()
    {
        session_destroy();
        return redirect()->to(site_url());
    }
}
