<form action="<?= site_url('kelola-tes/simpan'); ?>" method="POST" id="formTest">
    <input type="hidden" id="testId" name="test_id">
    <div class="form-group">
        <label for="testTitle">Judul Tes</label>
        <input type="text" class="form-control" id="testTitle" name="test_title" required tabindex="1" title="">
    </div>
    <div class="form-group">
        <label for="testDesc">Deskripsi Tes</label>
        <textarea name="test_desc" id="testDesc" class="form-control" required tabindex="2" title="" style="height: auto;" rows="4"></textarea>
    </div>
    <div class="form-group">
        <label for="applicants">Daftar Pelamar</label>
        <select multiple class="form-control select2" id="applicants" name="applicants[]" required tabindex="3" title="">
            <?php foreach ($applicants as $applicant) : ?>
                <option value="<?= $applicant['id_pelamar']; ?>"><?= $applicant['nama_pelamar']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="topics">Topik Tes</label>
        <select multiple class="form-control select2" id="topics" name="topics[]" required tabindex="4" title="">
            <?php foreach ($topics as $topic) : ?>
                <option value="<?= $topic['id_topik']; ?>"><?= $topic['judul_topik']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="minPassGrade">Minimal Nilai Lulus</label>
        <input type="number" min="1" max="100" step="0.01" class="form-control" id="minPassGrade" name="min_pass_grade" required tabindex="6" title="">
    </div>
    <div class="form-group">
        <label for="testDuration">Durasi Tes</label>
        <input type="time" step="1" min="00:00:01" class="form-control" id="testDuration" name="test_duration" required tabindex="7" title="">
    </div>
    <div class="form-group text-right">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>