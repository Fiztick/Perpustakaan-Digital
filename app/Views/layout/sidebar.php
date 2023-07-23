<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=site_url('buku/list-buku')?>">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">E - Perpus</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Buku
</div>

<!-- Nav Item - Book -->

<li class="nav-item <?=(uri_string() == 'buku/list-buku') ? 'active' : ''?>">
    <a class="nav-link" href="<?=site_url('buku/list-buku')?>">
        <i class="fas fa-fw fa-book-open"></i>
        <span>List Buku</span></a>
</li>

<li class="nav-item <?=(uri_string() == 'buku/kelola-buku') ? 'active' : ''?>">
    <a class="nav-link" href="<?=site_url('buku/kelola-buku')?>">
        <i class="fas fa-fw fa-book"></i>
        <span>Kelola Buku</span></a>
</li>

<?php if(session()->get('role_id') == 1) : ?>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Kategori
</div>

<!-- Nav Item - Book -->
<li class="nav-item <?=(uri_string() == 'kategori/list-kategori') ? 'active' : ''?>">
    <a class="nav-link" href="<?=site_url('kategori/list-kategori')?>">
        <i class="fas fa-fw fa-book-open"></i>
        <span>List Kategori</span></a>
</li>

<?php endif; ?>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>