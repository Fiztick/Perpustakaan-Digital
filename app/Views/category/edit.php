<?=$this->extend('layout/default')?>

<?=$this->section('kategori')?>
Edit Kategori
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
<div class="row align-items-start mb-3">
    <div class="col-sm-1">
        <a href="<?=base_url('kategori/list-kategori')?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a>
    </div>
    <div class="col">
        <h1 class="h3 mb-2 text-gray-800">Edit Kategori</h1>
    </div>
</div>

<!-- content -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Data Kategori</h6>
    </div>
    <div class="card-body">
        <form action="<?=base_url('kategori/update')?>" method="post" autocomplete="off" enctype="multipart/form-data">
            <?= csrf_field()?>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id" value="<?=$category->category_id?>">
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <input type="text" class="form-control" placeholder="Insert Kategori Name" name="category_name" value="<?=$category->category_name?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<script src="<?=base_url()?>/template/library/jquery/jquery.min.js"></script>
<script>
// Handle change event for the cover file input
$('#cover_file').on('input', function() {
    updateCustomFileLabel('cover_file');
});

// Handle change event for the book file input
$('#book_file').on('input', function() {
    updateCustomFileLabel('book_file');
});
</script>

<?=$this->endSection()?>