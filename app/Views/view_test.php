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
    <!-- jquery-time-to -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/jquery-time-to/jquery-time-to.css'); ?>">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components.css') ?>">
</head>

<body class="layout-3 sidebar-gone">
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="card card-primary">
                    <div class="card-body pt-0 pb-0">
                        <h2 class="section-title"><?= $singleTest['judul_tes']; ?></h2>
                        <p class="section-lead"><?= $singleTest['deskripsi_tes']; ?></p>
                    </div>
                </div>
                <?php if (!session()->get('test_start')) : ?>
                    <div class="card">
                        <div class="card-body d-flex justify-content-between">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link <?= current_url(true)->getSegment(2) == 'detail' ? 'active' : '';  ?>" href="<?= site_url('tes/detail'); ?>">Detail Tes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= current_url(true)->getSegment(2) == 'hasil' ? 'active' : ''; ?>" href="<?= site_url('tes/hasil'); ?>">Hasil Tes</a>
                                </li>
                            </ul>
                            <div>
                                <a href="<?= site_url('tes/login/keluar'); ?>" class="btn btn-danger">Keluar</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <!-- Main Content -->
                <?= $this->renderSection('view_content'); ?>
            </div>
        </section>
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
    <!-- jquery-time-to -->
    <script src="<?= base_url('assets/plugins/jquery-time-to/jquery-time-to.min.js'); ?>"></script>
    <!-- sweetalert -->
    <script src="<?= base_url('assets/plugins/sweetalert/sweetalert.min.js'); ?>"></script>

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
</body>

</html>