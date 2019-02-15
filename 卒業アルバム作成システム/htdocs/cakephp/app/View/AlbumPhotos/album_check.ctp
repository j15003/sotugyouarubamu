<?php echo $this->Html->css('stylesheet.css') ?>
<div class="albumPhotos index">

  <soeda>写真確認画面</soeda><br><br><br><br>

  <sub0>作成するアルバム名：<?php echo $alname; ?></sub0><br><br>
  <sub0>選択した顔モデル：<?php echo $moname; ?></sub0><br><br><br><br>

  <sub1>利用したい人の名前を選択してください</sub1><br><br>
      <!-- 繰り返しチェックボックスを写真フォルダがある分だけ生成、表示させる -->
      <?php
      $path = "../../../test";
      ?>

      <!-- チェックボックスフォームの生成 -->
      <form class="dir_form" action="album_result2" method="post">

      <?php

      $count = 1;

      if ($dir = opendir($path)) {
          //falseになるまでの間$dirのディレクトリを読み取る
          while (($file = readdir($dir)) !== false) {
              if ($file != "." && $file != "..") {
                //フォルダのみを出力させるための場合
                if ((preg_match("/^[^.]+\.*$/",$file)) == true) {
                      //フォルダ名とボックスの出力
                      echo "$file"; ?>
                      <input type="checkbox" name="dir_name[]" value="<?php echo $file ?> "><br>
                      <?php $count++; ?>
                <?php echo "<br>";
                }
              }
          }
          closedir($dir);
      }
      ?>
      <sub1><input type="submit" name="sel_dir" value="作成する"></sub1>
      </form>

      <br><br><br><br>

  <!-- Googleドライブを開く -->
  <input type="button" value="投稿した写真を確認する" onClick="window.open('https://drive.google.com/drive/folders/1Pqt_WHovXYIL3qjFrw4EJGbDD6aDc6pK')">

  <?php

        if (isset($_POST["answer"]) == 1) {

          $answer = $_POST["answer"];

        $path5 = "../../../test/all.photo/*";

        if ($answer == 1) {
          foreach (glob($path5) as $del_photo) {
            unlink($del_photo);
          }
        }
      }
  ?>


</div>
