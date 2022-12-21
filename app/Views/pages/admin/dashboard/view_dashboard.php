<?= $this->extend('view_admin'); ?>

<?= $this->section('view_content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dasbor</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-statistic-2" id="testCard">
                        <div class="card-stats">
                            <div class="card-stats-title">Status Tes :
                                <div class="dropdown d-inline">
                                    <a class="font-weight-bold dropdown-toggle" data-toggle="dropdown" href="#" id="testDropdown"></a>
                                    <ul class="dropdown-menu dropdown-menu-sm">
                                        <li class="dropdown-title">Pilih Tes</li>
                                        <?php if ($tests) : ?>
                                            <?php foreach ($tests as $key => $test) : ?>
                                                <li><a style="white-space: pre-wrap;" href="#" data-id="<?= $test['id_tes']; ?>" class="test-item dropdown-item <?= $key == 0 ? 'active' : ''; ?>"><?= $test['judul_tes']; ?></a></li>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <li><a style="white-space: pre-wrap;" href="#" class="test-item dropdown-item active">Belum ada tes</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-stats-items">
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count" id="inActive">0</div>
                                    <div class="card-stats-item-label" data-toggle="tooltip" data-placement="bottom" data-original-title="pelamar belum login tes">Tidak Aktif</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count" id="active">0</div>
                                    <div class="card-stats-item-label" data-toggle="tooltip" data-placement="bottom" data-original-title="pelamar sudah login tes">Aktif</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count" id="start">0</div>
                                    <div class="card-stats-item-label" data-toggle="tooltip" data-placement="bottom" data-original-title="pelamar sedang mengerjakan tes">Mulai</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count" id="finish">0</div>
                                    <div class="card-stats-item-label" data-toggle="tooltip" data-placement="bottom" data-original-title="pelamar selesai mengerjakan tes">Selesai</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-id-badge"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Pelamar Dalam Tes</h4>
                            </div>
                            <div class="card-body">
                            0
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card" id="passTestCard">
                        <div class="card-header">
                            <h4>Pelamar Lulus Tes</h4>
                            <div class="card-header-action dropdown">
                                <a href="#" data-toggle="dropdown" class="btn btn-danger dropdown-toggle" aria-expanded="true" id="passTestDropdown"></a>
                                <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                    <li class="dropdown-title">Pilih Tes</li>
                                    <?php if ($tests) : ?>
                                        <?php foreach ($tests as $key => $test) : ?>
                                            <li><a style="white-space: pre-wrap;" href="#" data-id="<?= $test['id_tes']; ?>" class="pass-test-item dropdown-item <?= $key == 0 ? 'active' : ''; ?>"><?= $test['judul_tes']; ?></a></li>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <li><a style="white-space: pre-wrap;" href="#" class="pass-test-item dropdown-item active">Belum ada tes</a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body" id="top-5-scroll">
                            <div id="list">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection(); ?>