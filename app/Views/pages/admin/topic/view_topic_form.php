<form action="<?= site_url('kelola-topik/simpan'); ?>" method="POST" id="formTopic">
    <input type="hidden" id="topicId" name="topic_id">
    <div class="form-group">
        <label for="topicTitle">Judul Topik</label>
        <input type="text" class="form-control" id="topicTitle" name="topic_title" required tabindex="1" title="">
    </div>
    <div class="form-group text-right">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>