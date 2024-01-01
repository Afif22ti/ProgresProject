<?php
$to = "afif22ti@mahasiswa.pcr.ac.id";
$subject = "Percobaan Pengiriman Email";
$message = "Ini adalah pesan percobaan menggunakan fungsi mail()";
$headers = "From: mhdafifjumardi26@gmail.com";

if (mail($to, $subject, $message, $headers)) {
    echo "Email berhasil dikirim.";
} else {
    echo "Gagal mengirim email.";
}
