banyak = Number(banyak);
$(document).ready(function () {
    if (banyak < 1 || banyak > 50) {
        alert('Maksimum input 50');
        window.location.href = base_url+"pengeluaran";
    } else {
        generate(banyak);
    }

    $('#inputs input:first').select();
    $('form#pengeluaran input').on('change', function () {
        $(this).parent('.form-group').removeClass('has-error');
        $(this).next('.help-block').text('');
    });

    $('.datetimepicker').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    $('form#pengeluaran').on('submit', function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        var btn = $('#submit');
        btn.attr('disabled', 'disabled').text('Wait...');

        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            method: 'POST',
            success: function (data) {
                btn.removeAttr('disabled').text('Simpan');
                //console.log(data);
                if (data.status) {
                    Swal({
                        "title": "Sukses",
                        "text": "Data Berhasil disimpan",
                        "type": "success"
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = base_url+'pengeluaran';
                        }
                    });
                } else {
                    var j;
                    for (let i = 0; i <= data.errors.length; i++) {
                        $.each(data.errors[i], function (key, val) {
                            j = $('[name="' + key + '"]');
                            j.parent().addClass('has-error');
                            j.next('.help-block').text(val);
                            if (val == '') {
                                j.parent('.form-group').removeClass('has-error');
                                j.next('.help-block').text('');
                            }
                        });
                    }
                }
            }
        });
    });
});

function generate(n) {
    for (let i = 1; i <= n; i++) {
        inputs = `
            <tr>
                <td>${i}</td>
                <td>
                    <div class="form-group">
                        <input name="tanggal[${i}]" type="text" class="datetimepicker form-control" placeholder="Tanggal">
                        <small class="help-block text-right"></small>
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <input autocomplete="off" type="text" name="nama_pengeluaran[${i}]" class="input-sm form-control">
                        <small class="help-block text-right"></small>
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <input autocomplete="off" type="text" name="nominal[${i}]" class="input-sm form-control">
                        <small class="help-block text-right"></small>
                    </div>
                </td>
                <td>
                <div class="form-group">
                    <select name="rekening[${i}]" class="select2 pull-left">
                        <option value="0">-- Rekening --</option>
                        <option value="0143252019">0143252019</option>
                        <option value="9000025229858">9000025229858</option>
                    </select>
                    <small class="help-block"></small>
                </div>
                </td>
                
            </tr>
            `;
        $('#inputs').append(inputs);
    }
}