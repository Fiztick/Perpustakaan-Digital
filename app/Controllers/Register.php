<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Register extends BaseController
{
    public function __construct()
    {
        $this->user_model = new UserModel();
    }

    public function index()
    {
        return view('auth/register');
    }

    public function proses()
    {
        $required = [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'cpassword' => 'required',
        ];

        $check_len_password = [
            'password' => 'min_length[8]',
            'cpassword' => 'min_length[8]',
        ];

        if (! $this->validate($required)) {
            return redirect()->to(site_url('register'))->withInput()->with('error', 'Isi semua data terlebih dahulu');
        } else if (! $this->validate($check_len_password)) {
            return redirect()->to(site_url('register'))->withInput()->with('error', 'Panjang password minimal 8 karakter');
        }

        $name = $this->request->getVar('name');
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $cpassword = $this->request->getVar('cpassword');

        $check_email = $this->user_model->where('email', $email)->get()->getRow();

        if ($password !== $cpassword) {
            return redirect()->to(site_url('register'))->with('error', 'Konfirmasi Password Berbeda dengan Password');
        } else if (!empty($check_email)) {
            return redirect()->to(site_url('register'))->with('error', 'Email Sudah Terdaftar');
        } else {
            $data = [
                'user_name' => $name,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'role_id' => 2,
            ];

            $query = $this->user_model->insert($data);

            if($query) {
                return redirect()->to(site_url())->with('success', 'Akun berhasil dibuat');
            } else {
                return redirect()->to(site_url())->with('error', 'Akun gagal dibuat');
            }
        }

        dd($name);
    }
}
