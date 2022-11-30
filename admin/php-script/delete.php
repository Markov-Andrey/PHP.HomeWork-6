<?php
//удалить файл

//система отлова удаления
function removeDir($ctlg) {
  if (is_file($ctlg)) return unlink($ctlg); //удаление файла
  if (is_dir($ctlg)) { //проверка папки
    foreach(scandir($ctlg) as $p) if (($p!='.') && ($p!='..'))
    removeDir($ctlg.DIRECTORY_SEPARATOR.$p);
    return rmdir($ctlg); //удаление папки
    }
  return false;
  }