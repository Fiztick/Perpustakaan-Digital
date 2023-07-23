<?=$this->extend('layout/default')?>

<?=$this->section('title')?>
List Buku
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
<h1 class="h3 mb-2 text-gray-800">Buku</h1>

<!-- Datatables -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List Buku</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Cover</th>
                        <th>File</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody id="book-list">
                    <?php $i = 1; foreach($books as $val) : ?>
                    <tr>
                        <td><?=$i?></td>
                        <td><?=$val->title?></td>
                        <td><?=$val->category_name?></td>
                        <td><?=$val->description?></td>
                        <td>
                            <img src="<?= base_url('uploads/cover/'.(new DateTime($val->created_at))->format('d-m-Y').'/'.$val->cover_file)?>"
                                alt="<?=$val->title?>" width="100" height="150">
                        </td>
                        <td>
                            <form action="<?=site_url('buku/download')?>">
                                <input type="hidden" name="id" value="<?=$val->book_id?>" />
                                <?=empty($val->book_file) ? '-' : 
                                '<button class="btn btn-primary"
                                    type="submit"><i class="fa fa-download"></i>
                                </button>'
                                ?>
                            </form>
                        </td>
                        <td><?=$val->quantity?></td>
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