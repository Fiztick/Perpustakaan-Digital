<?=$this->extend('layout/default')?>

<?=$this->section('title')?>
List Kategori
<?=$this->endSection()?>

<?=$this->section('content')?>

<?php if(session()->getFlashdata('success')) : ?>
<div class="alert alert-success alert-dismissible show fade">
    <div class="alert-body">
        <button class="close" data-dismiss="alert">x</button>
        <b>Success !</b>
        <?=session()->getFlashData('success'); ?>
    </div>
</div>
<?php endif ?>

<?php if(session()->getFlashdata('error')) : ?>
<div class="alert alert-danger alert-dismissible show fade">
    <div class="alert-body">
        <button class="close" data-dismiss="alert">x</button>
        <b>Error !</b>
        <?=session()->getFlashData('error'); ?>
    </div>
</div>
<?php endif ?>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Kategori</h1>
<a href="<?=site_url('kategori/create')?>" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Data Kategori</a>

<!-- Datatables -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Kelola Kategori</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="book-list">
                    <?php $i = 1; foreach($categories as $val) : ?>
                    <tr>
                        <td><?=$i?></td>
                        <td><?=$val->category_name?></td>
                        <td>
                            <!-- edit -->
                            <form action="<?=site_url('kategori/edit')?>" class="d-inline">
                                <input type="hidden" name="id" value="<?=$val->category_id?>">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></button>
                            </form>

                            <!-- delete -->
                            <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></button>

                            <!-- Delete Modal-->
                            <form action="<?=site_url('kategori/delete')?>" class="d-inline" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="id" value="<?=$val->category_id?>">
                                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
                                                <button class="close" type="button" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Data <b>kategori</b> dan <b>buku</b> yang memiliki kategori ini akan terhapus secara permanen!</div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button"
                                                    data-dismiss="modal">Cancel</button>
                                                <button class="btn btn-danger">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                    <?php $i++; endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="<?=base_url()?>/template/library/jquery/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

<script>
let table = new DataTable('#dataTable');
</script>

<?=$this->endSection()?>