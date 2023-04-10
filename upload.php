<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  // Verifica se o arquivo é uma imagem
  $check = getimagesize($_FILES["file"]["tmp_name"]);
  if ($check !== false) {
    // Move o arquivo para a pasta de uploads
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
      // Retorna a URL da imagem para ser exibida
      $url = $_SERVER["HTTP_REFERER"] . $target_file;
      echo json_encode(array("url" => $url));
    } else {
      http_response_code(500);
    }
  } else {
    http_response_code(400);
  }
}
?>
