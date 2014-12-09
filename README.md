# Imshell

    画像をシェルで表示できる形式に変換するプログラムです。
    元々は遊びで、ログインメッセージのmotd用に画像を変換したかっただけです
    
公式: http://rskull.github.io/Imshell/

## 使い方

```php
<?php

require_once 'Imshell.php';

$Imshell = new Imshell;
//$Imshell = new Imshell('image.jpg');

// 画像を設定
$Imshell->setImage('image.jpg');

// 横幅を何文字で表現するか
$Imshell->setWidth(80);

// 置き換える文字(無指定で背景塗りつぶし)
$Imshell->setChara('■');
//$Imshell->setChara('Github'); // 文章可

// 変換
$Imshell->convert();

```

## 作ってみた

curlコマンドを使い画像を変換します。
各オプションの前に-dをつけてください。

```shell
$ curl imshell.tk -d url=[画像URL] -d size=100
```

### オプション

| オプション     | 説明                                      |
|:---------------|:------------------------------------------|
| url            | 画像URL                                   |
| file           | ローカルの画像パス                        |
| size           | 横幅の文字数。デフォルトで50文字          |
| dot            | 置き換える文字。デフォルトで背景塗りつぶし|

### ローカルの画像を変換する

画像URLだけでなく、ローカルの画像も変換できます。
その場合はcurlコマンドの-Fオプションを使います。
※ -dは使えなくなるので全て-Fを使うことに注意

```shell
$ curl imshell.tk -F file=@image.jpg -F size=80 -F dot=■
```

### Demo

![Github](http://i.gzn.jp/img/2011/12/26/shirokuro-social-icons/icon-white-github.png)

```shell
curl imshell.tk -d url=http://i.gzn.jp/img/2011/12/26/shirokuro-social-icons/icon-white-github.png -d size=40 -d dot=Github
```

![Github](http://imshell.tk/demo.png)

## バージョン履歴

    [ 2014-09-15 ] v1.1.0
        - キャッシュ機能追加

    [ 2014-03-30 ] v1.0.0
        - リリース

