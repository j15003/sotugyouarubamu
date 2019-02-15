<?php echo $this->Html->css('stylesheet.css') ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js" type="text/javascript"></script>


<div class="albumPhotos result">
  <soeda><?php echo $alname; ?></soeda><br>

<?php

    $path3 = "../../../test/all.photo/";
    $path5 = "../../../test/all.photo/*";

    $count = 1;
    //配列を中を指定するための添え字変数
    $i = 0;
    $x = 0;


    //未定義でもNULLでもなく配列だった場合、POSTで受け取る
    if (isset($_POST['dir_name']) && is_array($_POST['dir_name'])) {
      //implode関数で取得した値をデリミタで並べる
      $dir_name = implode(" ", $_POST['dir_name']);
    //  echo $dir_name;
      //explode関数でデリミタごとに値を配列に分ける
      $part_name = explode(" ", $dir_name);

      foreach ($part_name as $k => $value) {
        if (empty($value)) unset($part_name[$k]);
      }
      //  var_dump($part_name);

      foreach ($part_name as $value) {
        //    echo $part_name[$i];
        $name = $part_name[$i];
        //  echo ($name);echo "<br>";
        $path = "../../../test/$name/*.jpg";
        $path2 = "../../../test/$name/";
        $path3 = "../../../test/all.photo/";
        $path4 = "../../../test/all.photo/*.jpg";
        $path5 = "../../../test/all.photo/*";


        $i += 2;
        //そのフォルダにあるファイル数を数える
        $get_files = glob($path ,GLOB_BRACE);
        //var_dump($get_files);
        //$fileに完成されたパスを格納する
        $file_path = $get_files;
        //  var_dump($file);echo "<br>";
        foreach ($get_files as $get_file) {
          if (is_file($get_file)) {
            $file_path = $get_file;
            //    echo $file;
            //ファイルを移動させたいディレクトリの指定
            $move_directory = "$path3";
            //ディレクトリのハンドルをオープンできれば処理を実行
            if ($handle = opendir("$path2")) {
              //オープンしたディレクトリにファイルが存在すればループで取り出す
              while(false !== ($entry = readdir($handle))) {
                //ファイル名が「.」「..」じゃなければ処理を実行
                if ($entry != "." && $entry != "..") {
                  //echo $entry;
                  //ファイルを指定したディレクトリに複製する
                  copy($path2 . $entry , $move_directory . $entry);
                    //echo $entry;
                }
              }
                //echo $file_path;
               // echo "<br>";
              //オープンしたディレクトリのハンドルをクローズする
              closedir($handle);
            }
          }
        }
      }
     }

      if (isset($_GET["imageno"])) { //ページ指定がある場合
          $imageno = $_GET["imageno"]; //変数セット
          $image = $imageno; //そのページが始まる画像NO
      }
      echo "<div class = imgWrap>";
      echo "<div id = fourtable>";
      echo "<table>";
      $imagedir = opendir("$path3");
      while (false !== ($file[] = readdir($imagedir)));
        closedir($imagedir);
        natsort($file);
        reset($file);
        $reverse = array_reverse($file, true);
          if (!isset($imageno)) {
            $imageno = 0; //最初のページは 0（ページ内で++していく）
            $image = 0; //そのページが始まる画像NO
          }
          $pageline = 16; //１ページに表示させる枚数
          $imagecount = 0; //ページ内で増やしていく
          while (false !== ($jpg = each($reverse))){
            //if (ereg(".jpg$", $jpg[1])) {php6でeregが削除になるというので2009年10月7日に修正
            if (preg_match ("|.*$|", $jpg[1])) {
              $imagecount++;
              if ($imageno == ($image+$pageline)) { //このページの分が表示済みなら
                break; //ループを抜ける
              }
              if ($imagecount > $image) { //このページの分まで来たら表示する
                if ($count == 1) {
                  echo "<tr>";
                }
                echo "<td>";
                echo "<a href='$path3" . $jpg[1] . "' data-lightbox='popup[]'>
                      <img src='$path3" . $jpg[1] . "'>
                      </a>";
                echo "</td>";
                if ($count == 4) {
                  echo "</tr>";
                  $count = 0;
                }
                $imageno++; //１枚表示したら++
                $count++;
              }
            }
          }
          echo "</table>";
          echo "</div>";
?>
</div>
</div>
<center><sub1>
<!-- <div style="margin-top:12px;clear:both;"> -->
<!-- <p class="txt"> -->
<?php
      $page = $imageno+$pageline; //以下 back と next 表示
          if ($imageno > $pageline) {
                $backno = $imageno-($pageline*2);
                echo "<a href='album_result2?imageno=" . $backno . "'>前ページ</a>　";
          }
          if ($imageno < $imagecount) {
                echo "<a href='album_result2?imageno=" . $imageno . "'>次ページ</a>";
          }
?>
</sub1></center>
      <!-- ボタンを押してやり直すファイルの削除 -->
<form name="natadecoco" action="album_check" method="POST">
      <input type="hidden" name="answer" value="1">
      <input type="submit" value="やり直す" width="100">
</form>
</div>
