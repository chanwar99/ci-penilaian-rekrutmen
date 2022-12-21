<!-- HOME -->
<?= $this->extend('view_auth'); ?>

<?= $this->section('view_content'); ?>
<!-- HOME -->
<?= $this->extend('view_auth'); ?>

<?= $this->section('view_content'); ?>
<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="card card-primary">
                    <div class="card-header justify-content-center">
                        <h4>Info Login</h4>
                    </div>

                    <div class="card-body">
                        <p class="text-center m-b-30"><?= $message; ?></p>
                        <p class="text-center">
                            <a href="<?= $urlLogout; ?>" class="btn btn-primary m-2">Keluar</a>
                            <a href="<?= $urlBack ?>" class="btn btn-secondary m-2">Kembali</a>
                        </p>
                    </div>
                </div>
                <div class="simple-footer">
                    Copyright &copy; Stisla 2018
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END HOME -->
<?= $this->endSection(); ?>