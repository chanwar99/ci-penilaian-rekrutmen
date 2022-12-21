<form action="<?= site_url('kelola-pelamar/simpan'); ?>" method="POST" id="formApplicant">
    <input type="hidden" id="applicantId" name="applicant_id">
    <div class="form-group">
        <label for="applicantName">Nama Pelamar</label>
        <input type="text" class="form-control" id="applicantName" name="applicant_name" required tabindex="1" title="">
    </div>
    <div class="form-group">
        <label for="gender">Jenis Kelamin</label>
        <select class="form-control custom-select" id="gender" name="gender" required tabindex="2" title="">
            <option value=""></option>
            <option value="Pria">Pria</option>
            <option value="Wanita">Wanita</option>
        </select>
    </div>
    <div class="form-group">
        <label for="placeBirth">Tempat Lahir</label>
        <input type="text" class="form-control" id="placeBirth" name="place_birth" required tabindex="3" title="">
    </div>
    <div class="form-group">
        <label for="dateBirth">Tanggal Lahir</label>
        <input type="date" class="form-control" id="dateBirth" name="date_birth" required tabindex="4" title="">
    </div>
    <div class="form-group">
        <label for="email">Alamat Email</label>
        <input type="email" class="form-control" id="email" name="email" required tabindex="8" title="">
    </div>
    <div class="form-group text-right">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>