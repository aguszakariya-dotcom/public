$(document).ready(function () {
    // URL API yang akan digunakan
    var apiUrl = '<?= BASEAPI; ?>/karyawan.php';
  
    // Mengambil data dari API menggunakan AJAX
    $.get(apiUrl, function (data) {
      // Membuat variabel untuk menyimpan elemen ul
      var userList = $('#user-list');
  
      // Loop melalui data dari API
      $.each(data, function (index, user) {
    // Membuat elemen li untuk setiap data karyawan
    var listItem = '<li>' +
      '<img class= "shadow" src="<?= BASEURL; ?>/imgTeams/' + user.gambar + '" alt="User Image">' +
      '<a class="users-list-name" href="#">' + user.nama + '</a>' + // Menggunakan user.nama
      '<span class="users-list-date">' + user.jabatan + '</span>' + // Menggunakan user.jabatan
      '</li>';
  
    // Memasukkan elemen li ke dalam ul
    userList.append(listItem);
  });
  
    });
  
    $.get("<?= BASEAPI; ?>/karyawan.php", function (data) {
    var userCount = data.length; // Mendapatkan jumlah pengguna dari panjang data.
    updateBadge(userCount); // Memanggil fungsi untuk memperbarui badge.
  });
  
  function updateBadge(userCount) {
    var badgeElement = $("#newMembersBadge");
    badgeElement.text(userCount + " New Teams");
  }
  
  });