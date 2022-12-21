<?= $this->extend('view_test'); ?>

<?= $this->section('view_content'); ?>
<div class="section-body">
    <div class="row">
        <div class="col-md-6">
            <div class="card author-box">
                <div class="card-header">
                    <h4>Info Pelamar</h4>
                </div>
                <div class="card-body">
                    <div class="author-box-left">
                        <img alt="image" src="<?= base_url('assets/img/avatar/avatar-1.png'); ?>" class="rounded-circle author-box-picture">
                        <div class="clearfix"></div>
                    </div>
                    <div class="author-box-details">
                        <div class="author-box-name">
                            <a href="#"><?= $userApplicant['nama_pelamar']; ?></a>
                        </div>
                        <div class="author-box-job"><?= $userApplicant['alamat_email']; ?></div>
                        <div class="author-box-description p-0">
                            <div class="row">
                                <div class="col-md-6 font-weight-bold">Nama Lengkap</div>
                                <div class="col-md-6"><?= $userApplicant['nama_pelamar']; ?></div>
                                <div class="col-md-6 font-weight-bold">Jenis Kelamin</div>
                                <div class="col-md-6"><?= $userApplicant['jenis_kelamin']; ?></div>
                                <div class="col-md-6 font-weight-bold">Tempat / Tanggal Lahir</div>
                                <div class="col-md-6"><?= $userApplicant['tempat_lahir'] . ' / ' . date('d-m-Y', strtotime($userApplicant['tanggal_lahir'])); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card author-box">
                <div class="card-header">
                    <h4>Info Tes</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>Topik</th>
                                    <th>Jumlah Soal Tes</th>
                                    <th>Durasi Tes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($topics as $key => $topic) : ?>
                                    <tr>
                                        <td><?= $topic['judul_topik'] ?> <small class="text-muted">(<?= $topic['jmlh_topik_soal'] ?> Soal)</small></td>
                                        <?php if ($key == 0) : ?>
                                            <td rowspan="<?= count($topics); ?>"><?= $questionCount; ?></td>
                                            <td rowspan="<?= count($topics); ?>"><?= $singleTest['durasi_tes']; ?></td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if ($userApplicant['status'] == 'Aktif') : ?>
                        <div class="mt-5 text-center">
                            <form method="POST" action="<?= site_url('tes/detail/mulai'); ?>" id="formTestStart">
                                <button type="submit" class="btn btn-lg btn-primary" name="start" value="true">Mulai Tes</button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>