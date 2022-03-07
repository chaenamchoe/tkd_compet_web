<?php
$fileName = $_FILES["file1"]["name"]; // The file name
$fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["file1"]["type"]; // The type of file it is
$fileSize = $_FILES["file1"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true
$ath_id = $_POST["ath_id"];
if (!$fileTmpLoc) { // if file not chosen
    echo "에러: 파일을 선택하세요.";
    exit();
}
if(move_uploaded_file($fileTmpLoc, "./video/$ath_id")){
    echo "$ath_id 업로드완료!";
} else {
    echo "업로드 실패!";
}
?>