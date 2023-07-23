<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookModel;
use App\Models\CategoryModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Book extends BaseController
{
    public function __construct()
    {
        $this->book_model = new BookModel();
        $this->category_model = new CategoryModel();
    }

    public function index()
    {
        $builder = $this->book_model->builder();
        $builder->join('categories', 'categories.category_id = books.category_id');

        $data['books'] = $builder->get()->getResult();

        return view('book/list', $data);
    }

    public function getListByRole()
    {
        $role_id = $this->session->get('role_id');
        $id = $this->session->get('id');

        if($id == 1) {
            $builder = $this->book_model->builder();
            $builder->join('categories', 'categories.category_id = books.category_id');
            $builder->join('users', 'users.user_id = books.user_id');
            $builder->orderBy('books.book_id', 'asc');
            return $builder->get()->getResult();
        } else {
            $builder = $this->book_model->builder();
            $builder->join('categories', 'categories.category_id = books.category_id');
            $builder->join('users', 'users.user_id = books.user_id');
            $builder->where('books.user_id', $id);
            return $builder->get()->getResult();
        }
    }

    public function master()
    {
        $data['books'] = $this->getListByRole();

        return view('book/master', $data);
    }

    public function create()
    {
        $data['categories'] = $this->category_model->findAll();

        return view('book/create', $data);
    }

    public function store()
    {
        $required = [
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
        ];

        if (! $this->validate($required)) {
            return redirect()->to(site_url('buku/create'))->withInput()->with('error', 'Isi semua data terlebih dahulu');
        }

        $data = [
            'title' => $this->request->getVar('title'),
            'category_id' => $this->request->getVar('category'),
            'description' => $this->request->getVar('description'),
            'cover_file' => null,
            'book_file' => null,
            'user_id' => $this->session->get('id'),
        ];

        $cover_file = $this->request->getFile('cover_file');
        $book_file = $this->request->getFile('book_file');

        // ngatur buat file cover
        if($cover_file->getSize() > 0) {
            if (!$cover_file->hasMoved()) {
                $file_name = $cover_file->getRandomName();
                $cover_file->move(FCPATH . 'uploads/cover/' . date('d-m-Y'), $file_name);
                
                $data['cover_file'] = $file_name;
            } else {
                return redirect()->to(site_url('buku/create'))->with('error', 'File Gagal Diupload');
            }
        }

        // ngatur buat file buku
        if($book_file->getSize() > 0) {
            if (!$book_file->hasMoved()) {
                $file_name = $book_file->getRandomName();
                $book_file->move(FCPATH . 'uploads/book/' . date('d-m-Y'), $file_name);
                
                $data['book_file'] = $file_name;
            } else {
                return redirect()->to(site_url('buku/create'))->with('error', 'File Gagal Diupload');
            }
        }

        try {
            $query = $this->book_model->insert($data);
            
            return redirect()->to(site_url('buku/kelola-buku'))->with('success', 'Data buku berhasil ditambah');
        } catch(DatabaseException $e) {
            return redirect()->to(site_url())->with('error', $e->getMessage());
        }
    }

    public function edit()
    {
        $id = $this->request->getVar('id');

        if(empty($id)) {
            return redirect()->to(site_url('buku/kelola-buku'))->with('error', 'ID tidak ditemukan');
        }

        $data['book'] = $this->book_model->where('book_id', $id)->get()->getResult();

        $data['categories'] = $this->category_model->findAll();

        return view('book/edit', $data);
    }

    public function update()
    {
        $required = [
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
        ];

        if (! $this->validate($required)) {
            return redirect()->to(site_url('buku/edit?id='. $this->request->getVar('id')))->withInput()->with('error', 'Isi semua data terlebih dahulu');
        }

        $data = [
            'book_id' => $this->request->getVar('id'),
            'title' => $this->request->getVar('title'),
            'category_id' => $this->request->getVar('category'),
            'description' => $this->request->getVar('description'),
            'quantity' => $this->request->getVar('quantity'),
        ];

        // buat cover file dan book file yg lama
        $book = $this->book_model->find($data['book_id']);
        $old_cover_file = $book->cover_file;
        $old_book_file = $book->book_file;
        $tanggal_file = strtotime($book->created_at);
        $tanggal_file = date('d-m-Y', $tanggal_file);

        // ambil dari inputan edit
        $cover_file = $this->request->getFile('cover_file');
        $book_file = $this->request->getFile('book_file');

        // ngatur buat file cover
        if($cover_file->getSize() > 0) {
            if (!$cover_file->hasMoved()) {

                // buat ngapus yg ada di sv buat diganti yang baru
                $file = FCPATH . 'uploads/cover/' . $tanggal_file . '/' . $old_cover_file;

                if(!empty($old_cover_file)) {
                    unlink($file);
                }

                $file_name = $cover_file->getRandomName();
                $cover_file->move(FCPATH . 'uploads/cover/' . date('d-m-Y'), $file_name);
                
                $data['cover_file'] = $file_name;
            } else {
                return redirect()->to(site_url('buku/edit'))->with('error', 'File Gagal Diupload');
            }
        }

        // ngatur buat file buku
        if($book_file->getSize() > 0) {
            if (!$book_file->hasMoved()) {

                // buat ngapus yg ada di sv buat diganti yang baru
                $file = FCPATH . 'uploads/book/' . $tanggal_file . '/' . $old_book_file;

                if(!empty($old_book_file)) {
                    unlink($file);
                }

                $file_name = $book_file->getRandomName();

                $book_file->move(FCPATH . 'uploads/book/' . date('d-m-Y'), $file_name);
                
                $data['book_file'] = $file_name;
            } else {
                return redirect()->to(site_url('buku/edit'))->with('error', 'File Gagal Diupload');
            }
        }
        
        // query databse
        try {
            $query = $this->book_model->save($data);
            
            return redirect()->to(site_url('buku/kelola-buku'))->with('success', 'Data buku berhasil diupdate');
        } catch(DatabaseException $e) {
            return redirect()->to(site_url())->with('error', $e->getMessage());
        }
    }

    public function delete()
    {
        $id = $this->request->getVar('id');

        // buat hapus cover file dan book file yg lama
        $book = $this->book_model->find($id);

        $cover_filename = $book->cover_file;
        $book_filename = $book->book_file;

        $tanggal_file = strtotime($book->created_at);
        $tanggal_file = date('d-m-Y', $tanggal_file);

        $cover_file = FCPATH . 'uploads/cover/' . $tanggal_file . '/' . $cover_filename;
        $book_file = FCPATH . 'uploads/book/' . $tanggal_file . '/' . $book_filename;
        

        try{
            $query = $this->book_model->delete($id);

            if(!empty($cover_filename)) {
                unlink($cover_file);
            }

            if(!empty($book_filename)) {
                unlink($book_file);
            }
            
            return redirect()->to(site_url('buku/kelola-buku'))->with('success', 'Data berhasil dihapus');
        } catch(DatabaseException $e) {
            return redirect()->to(site_url())->with('error', $e->getMessage());
        }
    }

    public function download()
    {
        $id = $this->request->getVar('id');

        if (empty($id)) {
            return redirect()->to(site_url('buku/kelola-buku'))->with('error', 'Terjadi Kesalahan');
        }

        $file = $this->book_model->find($id);

        $file_name = $file->book_file;
        $tanggal = strtotime($file->created_at);
        $tanggal = date('d-m-Y', $tanggal);

        // Get the local file path
        $file_path = FCPATH . 'uploads/book/' . $tanggal . '/' . $file_name;

        // Check if the file exists
        if (!file_exists($file_path)) {
            return redirect()->to(site_url('buku/kelola-buku'))->with('error', 'File not found');
        }

        return $this->response->download($file_path, null);
    }

    public function exportExcel()
    {
        $data['books'] = $this->getListByRole();

        // Instansiasi Spreadsheet
        $spreadsheet = new Spreadsheet();
        // styling
        $style = [
            'font'      => ['bold' => true],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];
        $spreadsheet->getActiveSheet()->getStyle('A1:G1')->applyFromArray($style); // tambahkan style
        $spreadsheet->getActiveSheet()->getRowDimension(1)->setRowHeight(30); // setting tinggi baris
        // setting lebar kolom otomatis
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        // set kolom head
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Book ID')
            ->setCellValue('B1', 'Title')
            ->setCellValue('C1', 'Description')
            ->setCellValue('D1', 'Category')
            ->setCellValue('E1', 'Cover Filename')
            ->setCellValue('F1', 'Book Filename')
            ->setCellValue('G1', 'User')
            ->setCellValue('H1', 'Quantity')
            ->setCellValue('I1', 'Created at');
        
        $row = 2;
        $data['books'] = $this->getListByRole();
        
        foreach ($data['books'] as $book) {
            $formatted_date = date('d-m-Y', strtotime($book->created_at));
            $spreadsheet->getActiveSheet()
                ->setCellValue('A' . $row, $book->book_id)
                ->setCellValue('B' . $row, $book->title)
                ->setCellValue('C' . $row, $book->description)
                ->setCellValue('D' . $row, $book->category_name)
                ->setCellValue('E' . $row, $book->cover_file)
                ->setCellValue('F' . $row, $book->book_file)
                ->setCellValue('G' . $row, $book->user_id)
                ->setCellValue('H' . $row, $book->quantity)
                ->setCellValue('I' . $row, $formatted_date);
            $row++;
        }
            

        // tulis dalam format .xlsx
        $writer   = new Xlsx($spreadsheet);
        $namaFile = 'Daftar_Buku_' . date('d-m-Y');
        // Redirect hasil generate xlsx ke web browser
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $namaFile . '.xlsx');
        $writer->save('php://output');
        exit;
    }
}