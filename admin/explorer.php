<?php

//редирект (по ТЗ)
$url = $_SERVER['REQUEST_URI'];
if ($url == '/admin/explorer.php') {
    header('Location: ./index.php');
}

//Базовый путь - кнопка "домой"
$home = __DIR__;
echo "<a href='?ctlg=$home'>Домой</a><br>";

$ctlg = $_GET["ctlg"];
if(is_dir($ctlg)){
  chdir($ctlg);
}

//поиск всех дисков на ПК и создание ссылок
$drive = 'a';
for($n=0; $n<25; $n++){
  ++$drive;
  if(@scandir($drive.":/")){
    echo "<a href='?ctlg=$drive:\'>".$drive.":\\</a><br>";
  }
}

//текущий адрес проводника (разбор + сбор файла)
//с возможностью проходить в любую точку данного адреса
$path = explode("\\", getcwd());
echo "Текущий путь: ";
for($i = 0; $i < count($path); $i++){
  $str = "";
    for($j = 0; $j <= $i; $j++){
        $str .= $path[$j]."\\";
    }
    echo "<a href='?ctlg=$str'>".$path[$i]."\\</a>";
}

//обращение к папке в каталоге
$fileInCat = (scandir(getcwd()));
echo "<p>Файловая система</p>";
foreach($fileInCat as $f){
  if($f !== "."){
    $pathF = getcwd()."\\".$f;
    echo "<p>
      <a href='?ctlg=$pathF'>$f</a></p>
    ";
  }
}
echo "</div>";

?>