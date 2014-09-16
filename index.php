<?php

// Class
require_once 'Imshell.php';

// Cache path
define('CACHE_PATH', dirname(__FILE__).'/cache/');

try {

    $Imshell = new Imshell;

    if (!empty($_FILES)) {

        // どれかに該当していれば不正なパラメータとして処理する
        if (!isset($_FILES['file']['error']) || !is_int($_FILES['file']['error'])) {
            throw new RuntimeException('パラメータが不正です');
        }

        // エラーチェック
        switch ($_FILES['file']['error']) {
            // OK
            case UPLOAD_ERR_OK:
                break;
            // ファイル未選択
            case UPLOAD_ERR_NO_FILE:
                throw new RuntimeException('ファイルが選択されていません');
            // 定義の最大サイズ超過
            case UPLOAD_ERR_INI_SIZE:
            // フォーム定義の最大サイズ超過
            case UPLOAD_ERR_FORM_SIZE:
                throw new RuntimeException('ファイルサイズが大きすぎます');
            default:
                throw new RuntimeException('その他のエラーが発生しました');
        }

        // 全て小文字に変換して拡張子取得
        $finfo = pathinfo($_FILES['file']['name']);
        $ext = strtolower($finfo['extension']);

        // ファイルチェック
        if (!in_array($ext, array('jpg', 'jpeg', 'gif', 'png', 'bmp'))) {
            throw new RuntimeException('不正なファイルです');
        }

        // アップロード画像
        $url = $_FILES['file']['tmp_name'];

    } else {
        // 画像URL
        $url = !empty($argv[1]) ? $argv[1] : filter_input(INPUT_POST, 'url');
    }

    if (!empty($url)) {

        // オプション
        $width = !empty($argv[2]) ? $argv[2] : filter_input(INPUT_POST, 'size');
        $dot = !empty($argv[3]) ? $argv[3] : filter_input(INPUT_POST, 'dot');
        $option = md5($width.$dot);

        $md5 = md5_file($url);
        $cache_file = CACHE_PATH.$md5.$option;

        if (file_exists($cache_file)) {

            // キャッシュを出力
            echo file_get_contents($cache_file);

        } else {

            $Imshell->setImage($url);

            // 横幅の文字数
            if (!empty($width)) {
                $Imshell->setWidth((int) $width);
            }

            // 置き換える文字
            if (!empty($dot)) {
                $Imshell->setChara($dot);
            }

            // シェル出力用に変換
            $output = $Imshell->convert();

            // キャッシュの作成
            $fp = fopen($cache_file, 'w');
            fwrite($fp, $output);
            fclose($fp);

            // 出力
            echo $output;

        }

    } else {
        throw new Exception('画像URLが指定されてません');
    }

} catch (ImagickException $e) {
    echo "エラーが発生しました\n";
} catch (Exception $e) {
    echo $e->getMessage()."\n";
}

