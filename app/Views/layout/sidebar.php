<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=site_url('index')?>">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item <?=(current_url(true)->getSegment(1) == 'index') ? 'active' : ''?>">
    <a class="nav-link" href="<?=site_url('index')?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Buku
</div>

<!-- Nav Item - Book -->
<li class="nav-item <?=(current_url(true)->getSegment(1) == 'list-buku') ? 'active' : ''?>">
    <a class="nav-link" href="<?=site_url('list-buku')?>">
        <i class="fas fa-fw fa-book-open"></i>
        <span>List Buku</span></a>
</li>

<li class="nav-item <?=(current_url(true)->getSegment(1) == 'kelola-buku') ? 'active' : ''?>">
    <a class="nav-link" href="<?=site_url('kelola-buku')?>">
        <i class="fas fa-fw fa-book"></i>
        <span>Kelola Buku</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>