<!-- HOME -->
<?= $this->extend('view_auth'); ?>

<?= $this->section('view_content'); ?>
<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 col-lg-4 m-auto">
                <div class="card card-primary">
                    <div class="card-header justify-content-center">
                        <h4>Login Admin </h4>
                    </div>

                    <div class="card-body">
                        <form id="formLogin" method="POST" action="<?= site_url('login/proses'); ?>">
                            <div class="form-group">
                                <label for="email_or_username">Email atau Nama User</label>
                                <input id="email_or_username" type="text" class="form-control" name="email_or_username" tabindex="1" required autofocus title="">
                            </div>
                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Kata Sandi</label>
                                </div>
                                <input id="password" type="password" class="form-control" name="password" tabindex="2" required title="">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="3">
                                    Login
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
<!-- END HOME -->
<?= $this->endSection(); ?>