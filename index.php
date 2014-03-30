<?php

// Class
require_once 'Imshell.php';

try {

    $Imshell = new Imshell;

    // 画像URL
    if (!empty($argv[1])) {
        $Imshell->setImage($argv[1]);
    } elseif (!empty($_POST['url'])) {
        $Imshell->setImage($_POST['url']);
    } else {
        throw new Exception('画像URLが指定されてません');
    }

    // 横幅の文字数
    if (!empty($argv[2])) {
        $width = (int) $argv[2];
        $Imshell->setWidth($width);
    } elseif (!empty($_POST['width'])) {
        $width = (int) $_POST['width'];
        $Imshell->setWidth($width);
    }

    // 置き換える文字
    if (!empty($argv[3])) {
        $Imshell->setChara($argv[3]);
    } elseif (!empty($_POST['dot'])) {
        $Imshell->setChara($_POST['dot']);
    }

    echo $Imshell->convert();

} catch (ImagickException $e) {
    echo 'エラーが発生しました';
} catch (Exception $e) {
    echo $e->getMessage()."\n";
}

