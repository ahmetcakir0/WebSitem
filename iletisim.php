<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verileri al ve güvenlik için temizle
    $adi = htmlspecialchars(strip_tags($_POST['adi']));
    $soyadi = htmlspecialchars(strip_tags($_POST['soyadi']));
    $dogumtarihi = htmlspecialchars(strip_tags($_POST['dogumtarihi']));
    $telno = htmlspecialchars(strip_tags($_POST['telno']));
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $mesaj = htmlspecialchars(strip_tags($_POST['mesaj']));

    if(!$email) {
        echo "Geçerli bir email adresi giriniz.";
        exit;
    }

    $to = "ahmetcakir@gmail.com";  // Mailin buraya gelecek
    $subject = "Yeni İletişim Formu Mesajı";
    $body = "Ad: $adi\nSoyad: $soyadi\nDoğum Tarihi: $dogumtarihi\nTelefon: $telno\nE-mail: $email\n\nMesaj:\n$mesaj";
    $headers = "From: $email" . "\r\n" .
               "Reply-To: $email" . "\r\n" .
               "Content-Type: text/plain; charset=utf-8";

    if(mail($to, $subject, $body, $headers)) {
        echo "<h2>Mesajınız başarıyla gönderildi. Teşekkür ederiz!</h2>";
        echo '<p><a href="iletisim.html">Geri Dön</a></p>';
    } else {
        echo "<h2>Mesaj gönderilirken bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.</h2>";
        echo '<p><a href="iletisim.html">Geri Dön</a></p>';
    }
} else {
    echo "Lütfen formu kullanınız.";
}
?>
