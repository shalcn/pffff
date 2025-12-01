<?php
$format = isset($_REQUEST['format']) ? strtolower($_REQUEST['format']) : 'json';
$berat = isset($_REQUEST['berat']) ? floatval($_REQUEST['berat']) : null;
$tinggi = isset($_REQUEST['tinggi']) ? floatval($_REQUEST['tinggi']) : null;
function respond($data, $format) {
    if ($format === 'json') {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    } else {
        header('Content-Type: text/plain; charset=utf-8');
        if (isset($data['error'])) {
            echo $data['error'];
        } else {
            echo 'BMI: '.$data['bmi']."\nKategori: ".$data['category']."\nSaran: ".$data['advice'];
        }
    }
    exit;
}
if ($berat === null || $tinggi === null) {
    respond(['error'=>'Masukkan parameter berat(kg) dan tinggi(cm)'], $format);
}
if ($berat <= 0 || $tinggi <= 0 || $berat > 500 || $tinggi > 300) {
    respond(['error'=>'Nilai berat/tinggi tidak valid'], $format);
}
$m = $tinggi / 100.0;
$bmi = $berat / ($m * $m);
if ($bmi < 18.5) { $category='Kurus'; $class='yellow'; $advice='Naikkan asupan kalori dan latihan kekuatan.'; }
elseif ($bmi < 25) { $category='Normal'; $class='green'; $advice='Pertahankan pola makan seimbang dan rutin olahraga.'; }
elseif ($bmi < 30) { $category='Berlebih'; $class='orange'; $advice='Kurangi kalori dan tingkatkan aktivitas aerobik.'; }
else { $category='Obesitas'; $class='red'; $advice='Konsultasi dengan profesional kesehatan dan rencana penurunan berat badan.'; }
$data = ['bmi'=>round($bmi,1),'category'=>$category,'advice'=>$advice,'class'=>$class];
respond($data, $format);
