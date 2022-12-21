<?= $this->extend('view_test'); ?>

<?= $this->section('view_content'); ?>
<div class="section-body">
    <div class="card">
        <div class="card-header">
            <h4 class="m-auto">Hasil Tes</h4>
        </div>
        <div class="card-body row">
            <div class="m-auto col-md-6 text-center">
                <?php if ($singleResultApplicant) : ?>
                    <p>Nilai tes anda adalah :</p>
                    <h4 class="font-weight-bold text-dark"><?= $singleResultApplicant['nilai_akhir'] . ' / ' . $singleResultApplicant['nilai_maks']; ?></h4>
                    <p>atau</p>
                    <h4 class="font-weight-bold text-dark"><?= $singleResultApplicant['nilai_persentase']; ?></h4>
                    <p>Dengan ini dinyatakan bahwa anda</p>
                    <h4 class="font-weight-bold text-dark text-uppercase">"<?= $singleResultApplicant['keterangan']; ?>"</h4>
                    <?php $pass = 'Dengan demikian anda berhak mengikuti wawancara kerja';
                    $notPass = 'Maaf anda gagal untuk mengikuti wawancara kerja'; ?>
                    <p><?= $singleResultApplicant['keterangan'] == 'Lulus' ? $pass : $notPass; ?></p>
                <?php else : ?>
                    <h4>Tes belum dikerjakan!</h4>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>