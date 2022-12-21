<div class="table-responsive">
    <table class="table table-bordered" style="width: 100%;">
        <thead>
            <?php if ($details == 'applicant') : ?>
                <tr>
                    <th>No</th>
                    <th>Nama Pelamar</th>
                    <th>Kode Tes</th>
                    <th>Status</th>
                </tr>
            <?php else : ?>
                <tr>
                    <th>No</th>
                    <th>Judul Topik</th>
                    <th>Jumlah Topik Soal</th>
                </tr>
            <?php endif; ?>
        </thead>
        <tbody>
            <?php
            $no = 0;
            if ($details == 'applicant') : ?>
                <?php foreach ($testApplicant as $testApplicant) : ?>
                    <tr>
                        <td><?= ++$no ?></td>
                        <td><?= $testApplicant['nama_pelamar']; ?></td>
                        <td><?= $testApplicant['kode_tes']; ?></td>
                        <td><?= $testClass->badge($testApplicant['status']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <?php foreach ($testTopic as $testTopic) : ?>
                    <tr>
                        <td><?= ++$no; ?></td>
                        <td><?= $testTopic['judul_topik']; ?></td>
                        <td><?= $testTopic['jmlh_topik_soal']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php if ($details == 'topic') : ?>
    <p class="text-center">Jumlah Soal Tes : <?= $questionCount; ?></p>
<?php endif; ?>