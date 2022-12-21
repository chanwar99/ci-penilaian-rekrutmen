<?= $this->extend('view_auth'); ?>

<?= $this->section('view_content'); ?>
<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 col-lg-4 m-auto">
                <div class="card card-primary">
                    <div class="card-header justify-content-center">
                        <h4>Login Tes</h4>
                    </div>

                    <div class="card-body">
                        <form id="formTestLogin" method="POST" action="<?= site_url('tes/login/proses'); ?>">
                            <div class="form-group">
                                <label for="testCode">Kode Tes</label>
                                <input id="test_code" type="text" class="form-control" name="test_code" tabindex="1" required autofocus title="">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="3">
                                    Login Tes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="simple-footer">
                    Copyright &copy; Stisla 2018
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>