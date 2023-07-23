<?=$this->extend('layout/default')?>

<?=$this->section('title')?>
Tambah Buku
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
        <a href="kelola-buku" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a>
    </div>
    <div class="col">
        <h1 class="h3 mb-2 text-gray-800">Tambah Buku</h1>
    </div>
</div>

<!-- content -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Data Buku</h6>
    </div>
    <div class="card-body">
        <form action="<?=base_url('buku/store')?>" method="post" autocomplete="off" enctype="multipart/form-data">
            <?= csrf_field()?>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" placeholder="Insert Title" name="title" required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" name="category" required>
                    <option value="">--Select Category--</option>
                    <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category->category_id ?>"><?= $category->category_name ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" rows="3" name="description"></textarea>
            </div>
            <div class="form-group">
                <label>Upload Cover</label>
                <div class="custom-file">
                    <input type="file" name="cover_file" class="custom-file-input" id="cover_file" accept=".jpeg, .jpg, .png">
                    <label class="custom-file-label" for="cover_file">Choose cover</label>
                </div>
            </div>
            <div class="form-group">
                <label>Upload File</label>
                <div class="custom-file">
                    <input type="file" name="book_file" class="custom-file-input" id="book_file"
                        accept=".pdf">
                    <label class="custom-file-label" for="book_file">Choose file</label>
                </div>
            </div>
            <input type="hidden" name="user_id" value="<?=session()->get('id')?>">
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
</div>

<script src="<?=base_url()?>/template/vendor/jquery/jquery.min.js"></script>

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