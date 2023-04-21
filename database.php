<?php

// Koneksi ke database
$host = "localhost";
$username = "root";
$password = "#amhsong07";
$database = "nama_database";

$koneksi = mysqli_connect($host, $username, $password, $database);

// Cek koneksi
if (!$koneksi) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil data dari form input
$transaction_id = $_POST["transaction_id"];
$transaction_date = $_POST["transaction_date"];
$transaction_amount = $_POST["transaction_amount"];
$transaction_status = $_POST["transaction_status"];
$card_number = $_POST["card_number"];
$card_holder_name = $_POST["card_holder_name"];
$card_expiration_month = $_POST["card_expiration_month"];
$card_expiration_year = $_POST["card_expiration_year"];
$card_security_code = $_POST["card_security_code"];
$item_name = $_POST["item_name"];
$item_quantity = $_POST["item_quantity"];
$item_price = $_POST["item_price"];
$customer_name = $_POST["customer_name"];
$customer_email = $_POST["customer_email"];
$customer_address = $_POST["customer_address"];

// Query untuk insert data ke tabel transaction
$query_transaction = "INSERT INTO transaction (transaction_id, transaction_date, transaction_amount, transaction_status) VALUES ('$transaction_id', '$transaction_date', '$transaction_amount', '$transaction_status')";

// Jalankan query transaction
if (mysqli_query($koneksi, $query_transaction)) {
  // Jika berhasil, insert data ke tabel credit card
  $query_credit_card = "INSERT INTO credit_card (card_number, card_holder_name, card_expiration_month, card_expiration_year, card_security_code, transaction_id) VALUES ('$card_number', '$card_holder_name', '$card_expiration_month', '$card_expiration_year', '$card_security_code', '$transaction_id')";

  // Jalankan query credit card
  if (mysqli_query($koneksi, $query_credit_card)) {
    // Jika berhasil, insert data ke tabel item detail
    $query_item_detail = "INSERT INTO item_detail (item_name, item_quantity, item_price, transaction_id) VALUES ('$item_name', '$item_quantity', '$item_price', '$transaction_id')";

    // Jalankan query item detail
    if (mysqli_query($koneksi, $query_item_detail)) {
      // Jika berhasil, insert data ke tabel customer detail
      $query_customer_detail = "INSERT INTO customer_detail (customer_name, customer_email, customer_address, transaction_id) VALUES ('$customer_name', '$customer_email', '$customer_address', '$transaction_id')";

      // Jalankan query customer detail
      if (mysqli_query($koneksi, $query_customer_detail)) {
        echo "Data berhasil disimpan";
      } else {
        echo "Gagal menyimpan data customer detail: " . mysqli_error($koneksi);
      }
    } else {
      echo "Gagal menyimpan data item detail: " . mysqli_error($koneksi);
    }
  } else {
    echo "Gagal menyimpan data credit card: " . mysqli_error($koneksi);
  }
} else  {
    echo "Gagal menyimpan data transaction: "
}