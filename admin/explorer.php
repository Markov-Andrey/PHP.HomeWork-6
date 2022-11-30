<?php
$ds = DIRECTORY_SEPARATOR;

//редирект (по ТЗ)
$url = $_SERVER['REQUEST_URI'];
if ($url == '/admin/explorer.php') {
    header('Location: ./index.php');
}

//Базовый путь - кнопка "домой"
$home = __DIR__;
echo "<a href='?ctlg=$home'>Домой</a><br>";

//система отлова GET-запросов
$ctlg = $_GET["ctlg"];
$status = $_GET["status"];

if((is_dir($ctlg))&&(!$status)){//перенаправление по запросу (директория)
  chdir($ctlg);
} elseif ((is_file($ctlg))&&(!$status)){//перенаправление по запросу (файл)
  $content = $ctlg;
  chdir (dirname($ctlg));
} elseif (($ctlg)&&($status = "del")){//удаление пустого каталога
  removeDir($ctlg);
}

//поиск всех дисков на ПК и создание ссылок
$drive = 'A';
for($n=0; $n<25; $n++){
  ++$drive;
  if(@scandir($drive.":/")){
    echo "<a href='?ctlg=$drive:\'>"."Диск ".$drive.DIRECTORY_SEPARATOR."</a><br>";
  }
}

//текущий адрес проводника (разбор + сбор файла)
//с возможностью проходить в любую точку данного адреса
$path = explode(DIRECTORY_SEPARATOR, getcwd());
echo "Текущий путь: ";
for($i = 0; $i < count($path); $i++){
  $str = "";
    for($j = 0; $j <= $i; $j++){
        $str .= $path[$j].DIRECTORY_SEPARATOR;
    }
    echo "<a href='?ctlg=$str'>".$path[$i].DIRECTORY_SEPARATOR."</a>";
}

//обращение к папке в каталоге
$fileInCat = (scandir(getcwd()));
echo "<p>Файловая система</p>";
foreach($fileInCat as $f){
  if($f !== "."){
    $pathF = getcwd().DIRECTORY_SEPARATOR.$f;
    echo "<div>
      <a href='?ctlg=$pathF' class='context-menu'>$f</a></div>
    ";
  }
}
echo "</div>";


//вызов контента файла
if($content){
  $title = basename($content);
  echo "<div class='reader'>";
  echo "<h1 style='text-align: center;'>".$title."</h1>";
  $text = file_get_contents($content);
  echo "<p>$text</p>";
  echo "<hr><b>";
  echo strlen($text)." символов; ";
  echo str_word_count($text, 0, "АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя")." слов"; //костыль для подсчета кириллических слов
  echo "</b></div>";
}

?>