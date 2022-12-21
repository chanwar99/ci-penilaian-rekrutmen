<div class="table-responsive">
    <table class="table table-bordered" style="width: 100%;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelamar</th>
                <th>Nilai</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 0;
            foreach ($testApplicant as $testApplicant) : ?>
                <tr>
                    <td><?= ++$no ?></td>
                    <td><?= $testApplicant['nama_pelamar']; ?></td>
                    <td><?= $testApplicant['kode_tes']; ?></td>
                    <td><?= $testClass->badge($testApplicant['status']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>