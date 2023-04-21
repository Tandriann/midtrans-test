<?php
// Set parameter untuk koneksi ke API Midtrans
$server_key = "VT-server-Cpo03kYDOc0cNUKgt6hnLkKg";
$api_url = "Tugas_Sesi5_ARL\index.php";

// Data Transaction Detail
$transaction_details = array(
    "order_id" => "ORD-123456789",
    "gross_amount" => 100000
);

// Data Credit Card
$credit_card = array(
    "token_id" => $_POST["token_id"], // Token ID yang diperoleh dari proses pembayaran
    "bank" => "bni",
    "secure" => true
);

// Data Item Details
$item_details = array(
    array(
        "id" => "ITEM-01",
        "price" => 50000,
        "quantity" => 2,
        "name" => "Kaos"
    ),
    array(
        "id" => "ITEM-02",
        "price" => 10000,
        "quantity" => 1,
        "name" => "Topi"
    )
);

// Data Customer Detail
$customer_details = array(
    "first_name" => $_POST["first_name"],
    "last_name" => $_POST["last_name"],
    "email" => $_POST["email"],
    "phone" => $_POST["phone"],
    "billing_address" => array(
        "first_name" => $_POST["first_name"],
        "last_name" => $_POST["last_name"],
        "address" => $_POST["address"],
        "city" => $_POST["city"],
        "postal_code" => $_POST["postal_code"],
        "phone" => $_POST["phone"],
        "country_code" => "IDN"
    ),
    "shipping_address" => array(
        "first_name" => $_POST["first_name"],
        "last_name" => $_POST["last_name"],
        "address" => $_POST["address"],
        "city" => $_POST["city"],
        "postal_code" => $_POST["postal_code"],
        "phone" => $_POST["phone"],
        "country_code" => "IDN"
    )
);

// Menggabungkan semua data dalam satu array
$params = array(
    "transaction_details" => $transaction_details,
    "credit_card" => $credit_card,
    "item_details" => $item_details,
    "customer_details" => $customer_details
);

// Mengirim data ke API Midtrans
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type: application/json",
    "Accept: application/json",
    "Authorization: Basic " . base64_encode($server_key . ":")
));
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
$result = curl_exec($ch);
curl_close($ch);

// Mengembalikan hasil dari API Midtrans
echo $result;
