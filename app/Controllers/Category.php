<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

class Category extends BaseController
{
    public function __construct()
    {
        $this->category_model = new CategoryModel();
    }

    public function index()
    {
        $data['categories'] = $this->category_model->findAll();

        return view('category/list', $data);
    }

    public function create()
    {
        return view('category/create');
    }

    public function store()
    {
        $required = [
            'category_name' => 'required',
        ];

        if (! $this->validate($required)) {
            return redirect()->to(site_url('kategori/create'))->withInput()->with('error', 'Isi semua data terlebih dahulu');
        }

        $data['category_name'] = $this->request->getVar('category_name');

        try {
            $query = $this->category_model->insert($data);
            
            return redirect()->to(site_url('kategori/list-kategori'))->with('success', 'Data kategori berhasil ditambah');
        } catch(DatabaseException $e) {
            return redirect()->to(site_url())->with('error', $e->getMessage());
        }
    }

    public function edit()
    {
        $id = $this->request->getVar('id');

        if(empty($id)) {
            return redirect()->to(site_url('kategori/kelola-kategori'))->with('error', 'Terjadi Kesalahan');
        }

        $data['category'] = $this->category_model->find($id);

        return view('category/edit', $data);
    }

    public function update()
    {
        $data = [
            'category_id' => $this->request->getVar('id'),
            'category_name' => $this->request->getVar('category_name'),
        ];
        
        // query databse
        try {
            $query = $this->category_model->save($data);
            
            return redirect()->to(site_url('kategori/list-kategori'))->with('success', 'Data kategori berhasil diupdate');
        } catch(DatabaseException $e) {
            return redirect()->to(site_url())->with('error', $e->getMessage());
        }
    }

    public function delete()
    {
        $id = $this->request->getVar('id');

        try{
            $query = $this->category_model->delete($id);
            
            return redirect()->to(site_url('kategori/list-kategori'))->with('success', 'Data berhasil dihapus');
        } catch(DatabaseException $e) {
            return redirect()->to(site_url())->with('error', $e->getMessage());
        }
    }
}
