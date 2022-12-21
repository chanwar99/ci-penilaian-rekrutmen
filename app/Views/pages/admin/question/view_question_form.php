<form action="<?= site_url('kelola-soal/simpan'); ?>" method="POST" id="formQuestion">
    <input type="hidden" id="questionId" name="question_id">
    <input type="hidden" id="topicOld" name="topic_old">
    <div class="form-group">
        <label for="topics">Topik</label>
        <select class="form-control select2" id="topic" name="topic" required tabindex="1" title="">
            <option value=""></option>
            <?php foreach ($topics as $topic) : ?>
                <option value="<?= $topic['id_topik']; ?>"><?= $topic['judul_topik']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="questionText">Teks Soal</label>
        <textarea name="question_text" id="questionText" class="form-control" required tabindex="2" title="" style="height: auto;" rows="4"></textarea>
    </div>
    <div class="form-group">
        <label for="choice1">Pilihan Jawaban</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    Pilihan 1
                </div>
            </div>
            <input type="text" class="form-control" id="choice1" name="choice_1" required tabindex="3" title="">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    Pilihan 2
                </div>
            </div>
            <input type="text" class="form-control" id="choice2" name="choice_2" required tabindex="4" title="">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    Pilihan 3
                </div>
            </div>
            <input type="text" class="form-control" id="choice3" name="choice_3" required tabindex="5" title="">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    Pilihan 4
                </div>
            </div>
            <input type="text" class="form-control" id="choice4" name="choice_4" required tabindex="6" title="">
        </div>
    </div>
    <div class="form-group">
        <label for="answer">Kunci Jawaban</label>
        <select class="form-control custom-select" id="answer" name="answer" required tabindex="7" title="">
            <option value=""></option>
            <option value="pil_1">Pilihan 1</option>
            <option value="pil_2">Pilihan 2</option>
            <option value="pil_3">Pilihan 3</option>
            <option value="pil_4">Pilihan 4</option>
        </select>
    </div>
    <div class="form-group">
        <label for="points">Poin</label>
        <input type="number" min="1" class="form-control" id="points" name="points" required tabindex="8" title="">
    </div>
    <div class="form-group text-right">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>