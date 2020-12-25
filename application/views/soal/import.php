<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $subjudul ?></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <ul class="alert alert-info" style="padding-left: 40px">
            <li>Silahkan import data dari excel, menggunakan format yang sudah disediakan</li>
            <li>Data tidak boleh ada yang kosong, harus terisi semua.</li>
            <li>Untuk data dosen_id, matkul_id, id_ujian dan tipe hanya bisa diisi menggunakan ID masing-masing. <a data-toggle="modal" href="#matkulId" style="text-decoration:none" class="btn btn-xs btn-primary">Lihat ID</a></li>
        </ul>
        <div class="text-center">
            <a href="<?= base_url('uploads/import/format/soal.xlsx') ?>" class="btn-default btn">Download Format</a>
        </div>
        <br>
        <div class="row">
            <?= form_open_multipart('soal/preview'); ?>
            <label for="file" class="col-sm-offset-1 col-sm-3 text-right">Pilih File</label>
            <div class="col-sm-4">
                <div class="form-group">
                    <input type="file" name="upload_file">
                </div>
            </div>
            <div class="col-sm-3">
                <button name="preview" type="submit" class="btn btn-sm btn-success">Preview</button>
            </div>
            <?= form_close(); ?>
            <div class="col-md-12 ">
                <div class="table-responsive col-md-12">
                    <?php if (isset($_POST['preview'])) : ?>
                        <br>
                        <h4>Preview Data</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>no</td>
                                    <td>dosen_id</td>
                                    <td>matkul_id</td>
                                    <td>bobot</td>
                                    <td>soal</td>
                                    <td>opsi_a</td>
                                    <td>opsi_b</td>
                                    <td>opsi_c</td>
                                    <td>opsi_d</td>
                                    <td>opsi_e</td>
                                    <td>jawaban</td>
                                    <td>tipe</td>
                                    <td>id_ujian</td>
                                    <td>Pembahasan</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $status = true;
                                    if (empty($import)) {
                                        echo '<tr><td colspan="2" class="text-center">Data kosong! pastikan anda menggunakan format yang telah disediakan.</td></tr>';
                                    } else {
                                        $no = 1;
                                        foreach ($import as $data) :
                                            ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td class="<?= $data['dosen_id'] == null ? 'bg-danger' : ''; ?>">
                                                <?= $data['dosen_id'] == null ? 'BELUM DIISI' : $data['dosen_id']; ?>
                                            </td>
                                            <td class="<?= $data['matkul_id'] == null ? 'bg-danger' : ''; ?>">
                                                <?= $data['matkul_id'] == null ? 'BELUM DIISI' : $data['matkul_id'];; ?>
                                            </td>
                                            <td class="<?= $data['bobot'] == null ? 'bg-danger' : ''; ?>">
                                                <?= $data['bobot'] == null ? 'BELUM DIISI' : $data['bobot'];; ?>
                                            </td>
                                            <td class="<?= $data['soal'] == null ? 'bg-danger' : ''; ?>">
                                                <?= $data['soal'] == null ? 'BELUM DIISI' : $data['soal'];; ?>
                                            </td>
                                            <td class="<?= $data['opsi_a'] == null ? 'bg-danger' : ''; ?>">
                                                <?= $data['opsi_a'] == null ? 'BELUM DIISI' : $data['opsi_a'];; ?>
                                            </td>
                                            <td class="<?= $data['opsi_b'] == null ? 'bg-danger' : ''; ?>">
                                                <?= $data['opsi_b'] == null ? 'BELUM DIISI' : $data['opsi_b'];; ?>
                                            </td>
                                            <td class="<?= $data['opsi_c'] == null ? 'bg-danger' : ''; ?>">
                                                <?= $data['opsi_c'] == null ? 'BELUM DIISI' : $data['opsi_c'];; ?>
                                            </td>
                                            <td class="<?= $data['opsi_d'] == null ? 'bg-danger' : ''; ?>">
                                                <?= $data['opsi_d'] == null ? 'BELUM DIISI' : $data['opsi_d'];; ?>
                                            </td>
                                            <td class="<?= $data['opsi_e'] == null ? 'bg-danger' : ''; ?>">
                                                <?= $data['opsi_e'] == null ? 'BELUM DIISI' : $data['opsi_e'];; ?>
                                            </td>
                                            <td class="<?= $data['jawaban'] == null ? 'bg-danger' : ''; ?>">
                                                <?= $data['jawaban'] == null ? 'BELUM DIISI' : $data['jawaban'];; ?>
                                            </td>
                                            <td class="<?= $data['tipe'] == null ? 'bg-danger' : ''; ?>">
                                                <?= $data['tipe'] == null ? 'BELUM DIISI' : $data['tipe'];; ?>
                                            </td>
                                            <td class="<?= $data['id_ujian'] == null ? 'bg-danger' : ''; ?>">
                                                <?= $data['id_ujian'] == null ? 'BELUM DIISI' : $data['id_ujian'];; ?>
                                            </td>
                                            <td class="<?= $data['Pembahasan'] == null ? 'bg-danger' : ''; ?>">
                                                <?= $data['Pembahasan'] == null ? 'BELUM DIISI' : $data['Pembahasan'];; ?>
                                            </td>
                                        </tr>
                                <?php

                                            if ($data['dosen_id'] == null || $data['matkul_id'] == null || $data['bobot'] == null || $data['soal'] == null || $data['opsi_a'] == null || $data['opsi_b'] == null || $data['opsi_c'] == null || $data['opsi_d'] == null || $data['opsi_e'] == null || $data['jawaban'] == null || $data['tipe'] == null || $data['id_ujian'] == null || $data['Pembahasan'] == null) {
                                                $status = false;
                                            }
                                        endforeach;
                                    }
                                    ?>
                            </tbody>
                        </table>
                        <?php if ($status) : ?>

                            <?= form_open('soal/do_import', null, ['data' => json_encode($import)]); ?>
                            <button type='submit' class='btn btn-block btn-flat bg-purple'>Import</button>
                            <?= form_close(); ?>

                        <?php endif; ?>
                        <br>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="matkulId">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Data ID</h4>
            </div>
            <div class="modal-body">
                <table id="matkul" class="table table-condensed table-striped">
                    <thead>
                        <th>matkul_id</th>
                        <th>Mata Bimbingan</th>
                    </thead>
                    <tbody>
                        <?php foreach ($matkul as $m) : ?>
                            <tr>
                                <td><?= $m->id_matkul; ?></td>
                                <td><?= $m->nama_matkul; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <table id="pembimbing" class="table table-condensed table-striped">
                    <thead>
                        <th>dosen_id</th>
                        <th>Pembimbing</th>
                    </thead>
                    <tbody>
                        <?php foreach ($pembimbing as $d) : ?>
                            <tr>
                                <td><?= $d->id_dosen; ?></td>
                                <td><?= $d->nama_dosen; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <table id="tipe" class="table table-condensed table-striped">
                    <thead>
                        <th>tipe</th>
                        <th>Nama Tipe</th>
                    </thead>
                    <tbody>
                        <?php foreach ($tipe as $d) : ?>
                            <tr>
                                <td><?= $d->id; ?></td>
                                <td><?= $d->tipe; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <table id="ujian" class="table table-condensed table-striped">
                    <thead>
                        <th>id_ujian</th>
                        <th>Nama Ujian</th>
                    </thead>
                    <tbody>
                        <?php foreach ($ujian as $d) : ?>
                            <tr>
                                <td><?= $d->id_ujian; ?></td>
                                <td><?= $d->nama_ujian; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let table;
        table = $("#matkul").DataTable({
            "lengthMenu": [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
            ],
        });
    });
</script>