<?php

$zip = new ZipArchive();
$res = $zip->open('assets.zip'); // file yang mau diekstrak
if ($res === TRUE) {
  $zip->extractTo('../');
  $zip->close();
  echo 'ok !';
} else {
  echo 'error!';
}
    # Same with this method of commenting ?>