<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $name = $_POST["name"];
    $message = $_POST["message"];
    
    // Pemrosesan file gambar jika ada
    $image = $_FILES["image"];
    $image_name = $image["name"];
    $image_tmp_name = $image["tmp_name"];
    $image_type = $image["type"];
    $image_size = $image["size"];
    
    // Baca isi file gambar
    $image_data = file_get_contents($image_tmp_name);
    
    // Konfigurasi email
    $to = "tujuan@example.com";
    $subject = "Pesan dari ".$name;
    $body = $message;
    $headers = "From: ".$name."\r\n";
    $headers .= "Reply-To: ".$name."\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"PHP-mixed-".$random_hash."\"";
    
    // Attachment untuk gambar
    $attachment = chunk_split(base64_encode($image_data));
    $headers .= "--PHP-mixed-".$random_hash."\r\n";
    $headers .= "Content-Type: image/jpeg; name=\"".$image_name."\"\r\n";
    $headers .= "Content-Transfer-Encoding: base64\r\n";
    $headers .= "Content-Disposition: attachment\r\n\r\n";
    $headers .= $attachment."\r\n";
    
    // Kirim email
    if (mail($to, $subject, $body, $headers)) {
        echo "Email berhasil dikirim.";
    } else {
        echo "Gagal mengirim email.";
    }
} else {
    // Jika bukan metode POST, tampilkan pesan error
    echo "Metode tidak valid.";
}
?>
