<?php
//удалить файл

//система отлова удаления
function delFile($status, $ctlg)
{
  if (is_dir($ctlg)) {
    rmdir($ctlg);
  }
  chdir(dirname ($ctlg));
}