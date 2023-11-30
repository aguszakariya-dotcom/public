$(document).ready(function() {
    // Tangkap submit form
    $('#myForm').submit(function(event) {
        // Menghentikan perilaku default form submit
        event.preventDefault();

        // Mengambil nilai input dari form
        var nama = $('input[name="nama"]').val();
        var tanggal = $('input[name="tanggal"]').val();
        var cst = $('input[name="nama"]').val();
        var style = $('input[name="style"]').val();
        var size = $('input[name="size"]').val();
        var hrg = $('input[name="hrg"]').val();
        var qty = $('input[name="qty"]').val();
        var total = $('input[name="total"]').val();

        // Mengirim data ke server menggunakan AJAX
        $.ajax({
            url: 'save_data.php', // Ganti dengan URL ke skrip PHP yang akan menyimpan data ke database
            method: 'POST',
            data: {
                nama: nama,
                tanggal: tanggal,
                cst: cst,
                style: style,
                size: size,
                hrg: hrg,
                qty: qty,
                total: total
            },
            success: function(response) {
                // Tindakan setelah data berhasil disimpan
                alert('Data berhasil disimpan!');
                // Mengosongkan nilai input
                $('input[name="size"]').val('');
                $('input[name="qty"]').val('');
                $('input[name="total').val;('');
            },
            error: function(xhr, status, error) {
                // Tindakan jika terjadi kesalahan
                alert('Terjadi kesalahan: ' + error);
            }
        });
    });
});
