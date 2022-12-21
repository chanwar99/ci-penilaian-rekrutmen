<?= $this->extend('view_test'); ?>

<?= $this->section('view_content'); ?>
<div class="section-body">
    <div class="row">
        <div class="col-md-8">
            <form div class="card" action="<?= site_url('tes/nilai'); ?>" method="POST" id="formTestSubmit">
                <div class="card-header" id="questionNumber">
                    <h4>Soal</h4>
                </div>
                <div class="card-body">
                    <div class="tab-content mb-4" id="questionsTab">
                        <?php $no = 1;
                        foreach ($testTopics as $testQuestions) : ?>
                            <?php foreach ($testQuestions as $testQuestion) : ?>
                                <div class="p-0 tab-pane fade" id="no<?= $no; ?>">
                                    <input type="hidden" name="question_id[]" value="<?= $testQuestion['id_soal']; ?>">
                                    <h6>Topik : <?=  $testQuestion['judul_topik']; ?></h6>
                                    <p style="white-space: pre-wrap;"><?= esc($testQuestion['teks_soal']) . ($testQuestion['poin'] != 1 ? ' <small class="text-muted">(Poin ' . $testQuestion['poin'] . ')</small>' : ''); ?></p>
                                    <div class="list-group">
                                        <input type="hidden" name="user_choice[<?= $no - 1; ?>]" value="">
                                        <?php 
                                        for ($i = 1; $i <= 4; $i++) : 
                                            $pil = 'pil_' . $i; ?>
                                            <a href="#" class="list-group-item list-group-item-action btnChoice"><input type="radio" name="user_choice[<?= $no - 1; ?>]" value="<?= $pil; ?>" hidden><?= esc($testQuestion[$pil]) ?></a>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            <?php $no++;
                            endforeach; ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <button class="btn btn-primary" type="button" id="btnPrev">Sebelumnya</button>
                        </div>
                        <div>
                            <button class="btn btn-primary" type="button" id="btnNext">Selanjutnya</button>
                            <button class="btn btn-primary" type="submit">Selesai</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-body d-flex justify-content-center">
                            <div id="countdown" data-seconds="<?= $testDuration; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Navigasi Soal</h4>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills justify-content-center" id="navigationTab">
                                <?php $no = 1;
                                foreach ($testTopics as $testQuestions) : ?>
                                    <?php foreach ($testQuestions as $testQuestion) : ?>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="pill" href="#no<?= $no; ?>"><?= $no; ?></a>
                                        </li>
                                    <?php $no++;
                                    endforeach; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>