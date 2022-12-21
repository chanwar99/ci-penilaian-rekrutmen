<?= $this->extend('view_admin'); ?>

<?= $this->section('view_content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Hasil</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= site_url(); ?>">Dasbor</a></div>
                <div class="breadcrumb-item">Hasil</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <select class="form-control select2" id="filterTest">
                                        <option value="">Semua Tes</option>
                                        <?php foreach ($tests as $test) : ?>
                                            <option value="<?= $test['id_tes']; ?>"><?= $test['judul_tes']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped display" id="tableResult" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tes</th>
                                                <th>Pelamar</th>
                                                <th>Nilai</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- modal form -->
<div class="modal fade" tabindex="-1" role="dialog" id="ResultModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>