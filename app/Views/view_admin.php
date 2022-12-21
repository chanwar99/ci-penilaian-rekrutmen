<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $title; ?></title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->

    <!-- iziToast -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/iziToast/iziToast.min.css'); ?>">
    <!-- datatables -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap4.min.css'); ?>">
    <!-- select2 -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/select2/select2.min.css'); ?>">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components.css') ?>">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <ul class="navbar-nav mr-auto">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                </ul>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <figure class="avatar avatar-sm bg-light text-primary" data-initial="<?= preg_replace('/\b(\w)|./', '$1', strtoupper($user['nama_lengkap'])); ?>"></figure>
                            <div class="d-sm-none d-lg-inline-block ml-2">Hi, <?= $user['nama_lengkap']; ?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="<?= site_url('login/keluar'); ?>" class="dropdown-item has-icon">
                                <i class="fas fa-sign-out-alt"></i> Keluar
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.html">SAPR</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">SAPR</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Menu</li>
                        <li class="<?= current_url(true)->getSegment(1) == '' ? 'active' : ''; ?>"><a class="nav-link" href="<?= site_url(); ?>"><i class="fas fa-tachometer-alt"></i> <span>Dasbor</span></a></li>
                        <li class="<?= current_url(true)->getSegment(1) == 'kelola-pelamar' ? 'active' : ''; ?>"><a class="nav-link" href="<?= site_url('kelola-pelamar'); ?>"><i class="fas fa-users"></i> <span>Kelola Pelamar</span></a></li>
                        <li class="<?= current_url(true)->getSegment(1) == 'kelola-topik' ? 'active' : ''; ?>"><a class="nav-link" href="<?= site_url('kelola-topik'); ?>"><i class="fas fa-file"></i> <span>Kelola Topik</span></a></li>
                        <li class="<?= current_url(true)->getSegment(1) == 'kelola-soal' ? 'active' : ''; ?>"><a class="nav-link" href="<?= site_url('kelola-soal'); ?>"><i class="fas fa-copy"></i> <span>Kelola Soal</span></a></li>
                        <li class="<?= current_url(true)->getSegment(1) == 'kelola-tes' ? 'active' : ''; ?>"><a class="nav-link" href="<?= site_url('kelola-tes'); ?>"><i class="fas fa-clipboard"></i> <span>Kelola Tes</span></a></li>
                        <li class="<?= current_url(true)->getSegment(1) == 'hasil' ? 'active' : ''; ?>"><a class="nav-link" href="<?= site_url('hasil'); ?>"><i class="fas fa-poll-h"></i> <span>Hasil</span></a></li>
                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            <?= $this->renderSection('view_content'); ?>

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
                </div>
                <div class="footer-right">
                    2.3.0
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="<?= base_url('assets/js/stisla.js'); ?>"></script>

    <!-- JS Libraies -->

    <!-- jquery-validation -->
    <script src="<?= base_url('assets/plugins/jquery-validation/jquery.validate.min.js'); ?>"></script>
    <!-- iziToast -->
    <script src="<?= base_url('assets/plugins/iziToast/iziToast.min.js'); ?>"></script>
    <!-- datatables -->
    <script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap4.min.js'); ?>"></script>
    <!-- select2 -->
    <script src="<?= base_url('assets/plugins/select2/select2.full.min.js'); ?>"></script>

    <!-- Template JS File -->
    <script>
        // semua halaman di admin
        var site_url = "<?= site_url(); ?>";
        var sess_msg = "<?= session()->getFlashdata('sess_msg'); ?>";
        if (sess_msg) {
            iziToast.success({
                title: sess_msg,
                position: "topRight",
                progressBar: true,
                timeout: 4000,
            });
        }
    </script>
    <script src="<?= base_url('assets/js/scripts.js'); ?>"></script>
    <?php if ($js) : ?>
        <script src="<?= base_url('assets/js/' . $js . '.js'); ?>"></script>
    <?php endif; ?>

    <!-- Page Specific JS File -->
    <style>
        .table-links {
            opacity: 1 !important;
        }
    </style>
</body>

</html>