<?php
/**
 * 画像をシェル用に変換するライブラリ
 *
 * @version 1.1.1 2016/02/27
 * @author DotEarl
 * @copyright Geekz Web Development
 **/

namespace App;

class Imshell
{
    // 256 対応テーブル
    private $colors = array(

        '00' => '000000',
        '01' => '800000',
        '02' => '008000',
        '03' => '808000',
        '04' => '000080',
        '05' => '800080',
        '06' => '008080',
        '07' => 'c0c0c0',

        '08' => '808080',
        '09' => 'ff0000',
        '10' => '00ff00',
        '11' => 'ffff00',
        '12' => '0000ff',
        '13' => 'ff00ff',
        '14' => '00ffff',
        '15' => 'ffffff',

        '16' => '000000',
        '17' => '00005f',
        '18' => '000087',
        '19' => '0000af',
        '20' => '0000d7',
        '21' => '0000ff',
        '22' => '005f00',
        '23' => '005f5f',
        '24' => '005f87',
        '25' => '005faf',
        '26' => '005fd7',
        '27' => '005fff',
        '28' => '008700',
        '29' => '00875f',
        '30' => '008787',
        '31' => '0087af',
        '32' => '0087d7',
        '33' => '0087ff',
        '34' => '00af00',
        '35' => '00af5f',
        '36' => '00af87',
        '37' => '00afaf',
        '38' => '00afd7',
        '39' => '00afff',
        '40' => '00d700',
        '41' => '00d75f',
        '42' => '00d787',
        '43' => '00d7af',
        '44' => '00d7d7',
        '45' => '00d7ff',
        '46' => '00ff00',
        '47' => '00ff5f',
        '48' => '00ff87',
        '49' => '00ffaf',
        '50' => '00ffd7',
        '51' => '00ffff',
        '52' => '5f0000',
        '53' => '5f005f',
        '54' => '5f0087',
        '55' => '5f00af',
        '56' => '5f00d7',
        '57' => '5f00ff',
        '58' => '5f5f00',
        '59' => '5f5f5f',
        '60' => '5f5f87',
        '61' => '5f5faf',
        '62' => '5f5fd7',
        '63' => '5f5fff',
        '64' => '5f8700',
        '65' => '5f875f',
        '66' => '5f8787',
        '67' => '5f87af',
        '68' => '5f87d7',
        '69' => '5f87ff',
        '70' => '5faf00',
        '71' => '5faf5f',
        '72' => '5faf87',
        '73' => '5fafaf',
        '74' => '5fafd7',
        '75' => '5fafff',
        '76' => '5fd700',
        '77' => '5fd75f',
        '78' => '5fd787',
        '79' => '5fd7af',
        '80' => '5fd7d7',
        '81' => '5fd7ff',
        '82' => '5fff00',
        '83' => '5fff5f',
        '84' => '5fff87',
        '85' => '5fffaf',
        '86' => '5fffd7',
        '87' => '5fffff',
        '88' => '870000',
        '89' => '87005f',
        '90' => '870087',
        '91' => '8700af',
        '92' => '8700d7',
        '93' => '8700ff',
        '94' => '875f00',
        '95' => '875f5f',
        '96' => '875f87',
        '97' => '875faf',
        '98' => '875fd7',
        '99' => '875fff',
        '100' => '878700',
        '101' => '87875f',
        '102' => '878787',
        '103' => '8787af',
        '104' => '8787d7',
        '105' => '8787ff',
        '106' => '87af00',
        '107' => '87af5f',
        '108' => '87af87',
        '109' => '87afaf',
        '110' => '87afd7',
        '111' => '87afff',
        '112' => '87d700',
        '113' => '87d75f',
        '114' => '87d787',
        '115' => '87d7af',
        '116' => '87d7d7',
        '117' => '87d7ff',
        '118' => '87ff00',
        '119' => '87ff5f',
        '120' => '87ff87',
        '121' => '87ffaf',
        '122' => '87ffd7',
        '123' => '87ffff',
        '124' => 'af0000',
        '125' => 'af005f',
        '126' => 'af0087',
        '127' => 'af00af',
        '128' => 'af00d7',
        '129' => 'af00ff',
        '130' => 'af5f00',
        '131' => 'af5f5f',
        '132' => 'af5f87',
        '133' => 'af5faf',
        '134' => 'af5fd7',
        '135' => 'af5fff',
        '136' => 'af8700',
        '137' => 'af875f',
        '138' => 'af8787',
        '139' => 'af87af',
        '140' => 'af87d7',
        '141' => 'af87ff',
        '142' => 'afaf00',
        '143' => 'afaf5f',
        '144' => 'afaf87',
        '145' => 'afafaf',
        '146' => 'afafd7',
        '147' => 'afafff',
        '148' => 'afd700',
        '149' => 'afd75f',
        '150' => 'afd787',
        '151' => 'afd7af',
        '152' => 'afd7d7',
        '153' => 'afd7ff',
        '154' => 'afff00',
        '155' => 'afff5f',
        '156' => 'afff87',
        '157' => 'afffaf',
        '158' => 'afffd7',
        '159' => 'afffff',
        '160' => 'd70000',
        '161' => 'd7005f',
        '162' => 'd70087',
        '163' => 'd700af',
        '164' => 'd700d7',
        '165' => 'd700ff',
        '166' => 'd75f00',
        '167' => 'd75f5f',
        '168' => 'd75f87',
        '169' => 'd75faf',
        '170' => 'd75fd7',
        '171' => 'd75fff',
        '172' => 'd78700',
        '173' => 'd7875f',
        '174' => 'd78787',
        '175' => 'd787af',
        '176' => 'd787d7',
        '177' => 'd787ff',
        '178' => 'd7af00',
        '179' => 'd7af5f',
        '180' => 'd7af87',
        '181' => 'd7afaf',
        '182' => 'd7afd7',
        '183' => 'd7afff',
        '184' => 'd7d700',
        '185' => 'd7d75f',
        '186' => 'd7d787',
        '187' => 'd7d7af',
        '188' => 'd7d7d7',
        '189' => 'd7d7ff',
        '190' => 'd7ff00',
        '191' => 'd7ff5f',
        '192' => 'd7ff87',
        '193' => 'd7ffaf',
        '194' => 'd7ffd7',
        '195' => 'd7ffff',
        '196' => 'ff0000',
        '197' => 'ff005f',
        '198' => 'ff0087',
        '199' => 'ff00af',
        '200' => 'ff00d7',
        '201' => 'ff00ff',
        '202' => 'ff5f00',
        '203' => 'ff5f5f',
        '204' => 'ff5f87',
        '205' => 'ff5faf',
        '206' => 'ff5fd7',
        '207' => 'ff5fff',
        '208' => 'ff8700',
        '209' => 'ff875f',
        '210' => 'ff8787',
        '211' => 'ff87af',
        '212' => 'ff87d7',
        '213' => 'ff87ff',
        '214' => 'ffaf00',
        '215' => 'ffaf5f',
        '216' => 'ffaf87',
        '217' => 'ffafaf',
        '218' => 'ffafd7',
        '219' => 'ffafff',
        '220' => 'ffd700',
        '221' => 'ffd75f',
        '222' => 'ffd787',
        '223' => 'ffd7af',
        '224' => 'ffd7d7',
        '225' => 'ffd7ff',
        '226' => 'ffff00',
        '227' => 'ffff5f',
        '228' => 'ffff87',
        '229' => 'ffffaf',
        '230' => 'ffffd7',
        '231' => 'ffffff',

        '232' => '080808',
        '233' => '121212',
        '234' => '1c1c1c',
        '235' => '262626',
        '236' => '303030',
        '237' => '3a3a3a',
        '238' => '444444',
        '239' => '4e4e4e',
        '240' => '585858',
        '241' => '626262',
        '242' => '6c6c6c',
        '243' => '767676',
        '244' => '808080',
        '245' => '8a8a8a',
        '246' => '949494',
        '247' => '9e9e9e',
        '248' => 'a8a8a8',
        '249' => 'b2b2b2',
        '250' => 'bcbcbc',
        '251' => 'c6c6c6',
        '252' => 'd0d0d0',
        '253' => 'dadada',
        '254' => 'e4e4e4',
        '255' => 'eeeeee'

    );

    // Break point
    private $incs = array(0x00, 0x5f, 0x87, 0xaf, 0xd7, 0xff);

    // 変換元画像
    private $image;

    // 置き換える文字
    private $chara = '  ';

    // 文字出力用のポインタ
    private $pointer = 0;

    // 横幅の文字数
    private $width_len = 50;

    // サイズのリミット
    private $max_width = 300;

    // 背景を塗りつぶすか
    private $bg_fill = true;

    /**
     * Constructer
     */
    public function __construct($image = null)
    {
        $this->image = $image;
    }

    /**
     * 画像をセット
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * 変換したい文字をセット
     */
    public function setChara($chara)
    {
        $this->bg_fill = false;
        $this->chara = preg_split('//u', $chara, -1, PREG_SPLIT_NO_EMPTY);
    }

    /**
     * 横幅の文字数セット
     */
    public function setWidth($width)
    {
        if ($this->max_width < $width) {
            throw new \Exception('最大サイズは'.$this->max_width.'です');
        }
        if ($width > 2) {
            $this->width_len = $width;
        }
    }

    /**
     * 画像を文字に変換
     * @return string 画像返還後の文字列
     */
    public function convert()
    {
        $image = new Imagick($this->image);

        // 2文字で1pxなので半分に画像縮小
        $img_width = floor($this->width_len / 2);
        $image->thumbnailImage($this->width_len, 0);

        // 画像のサイズ取得
        $width = $image->getImageWidth();
        $height = $image->getImageHeight();

        // 一時ファイル作成
        $tmp = tmpfile();
        fwrite($tmp, $image);
        $tmp_info = stream_get_meta_data($tmp);

        $im = $this->imageCreateFromAny($tmp_info['uri']);
        fclose($tmp); // tmp削除

        $buff = ''; // バッファ
        $x = $y = 0; // x, y 軸

        // 画像解析
        while ($height > $y) {

            // 指定したピクセルの色抽出
            $rgb = imagecolorat($im, $x, $y);
            $rgba = imagecolorsforindex($im, $rgb);

            // 透明部分は空白にする
            if ($rgba['alpha'] === 127) {
                $buff .= '  ';
            } else {
                // 256カラーに変換
                $hex = $this->getRgbToHex($rgba['red'], $rgba['green'], $rgba['blue']);
                $sc256 = $this->getRgbToShort($hex);

                // 背景塗りつぶし優先
                if ($this->bg_fill) {
                    $buff .= "[48;05;{$sc256}m  [0m";
                } else {
                    $buff .= "[38;05;{$sc256}m{$this->getChara()}[0m";
                }
            }

            // x軸移動
            $x += 1;

            // 右端までいったら折り返し
            if ($x >= $this->width_len) {
                $x = 0; // reset
                $y += 1; // y軸移動
                $buff .= "\n";
            }

        }

        return $buff;
    }

    /**
     * 1マス分の文字を返す
     * @return string 1マス文の文字列
     */
    private function getChara()
    {
        $strs = $this->chara;

        // 1文字目
        $str = $strs[$this->pointer++];

        if ($this->pointer == count($strs)) {
            $this->pointer = 0;
        }

        // 2文字目
        $str2 = $strs[$this->pointer];

        // 1マス2文字幅 マルチバイトは1文字
        if (mb_strwidth($str, 'utf8') == 1) {
            if (mb_strwidth($str2, 'utf8') == 1) {

                // シングルバイト2文字
                $str .= $str2;
                $this->pointer++;

                if ($this->pointer == count($strs)) {
                    $this->pointer = 0;
                }

            } else {
                // ２文字目がマルチだったら数合わせ
                $str .= $str;
            }

            return $str;
        }

        // マルチバイト1文字
        return $str;
    }

    /**
     * 新しい画像を生成する
     * @return resource
     */
    private function imageCreateFromAny($file)
    {
        $type = exif_imagetype($file);
        switch ($type) {
            case 1: // gif
                $im = imagecreatefromgif($file);
                break;
            case 2: // jpg
                $im = imagecreatefromjpeg($file);
                break;
            case 3: // png
                $im = imagecreatefrompng($file);
                break;
            case 6: // bmp
                $im = imagecreatefrombmp($file);
                break;
            default:
                $im = false;
        }
        return $im;
    }

    /**
     * HexからRGBへ変換
     * @param string hex カラーコード
     * @return array RGB
     */
    private function getHexToRgb($hex) {
        return array(
            hexdec(substr($hex, 0, 2)),
            hexdec(substr($hex, 2, 2)),
            hexdec(substr($hex, 4, 2))
        );
    }

    /**
     * RGBからHexに変換
     * @param int red 赤の数値
     * @param int green 緑の数値
     * @param int blue 青の数値
     * @return string Hex
     */
    private function getRgbToHex($red, $green, $blue)
    {
        $hex = str_pad(dechex($red), 2, 0, STR_PAD_LEFT);
        $hex .= str_pad(dechex($green), 2, 0, STR_PAD_LEFT);
        $hex .= str_pad(dechex($blue), 2, 0, STR_PAD_LEFT);
        return $hex;
    }

    /**
     * RGBを256インデックスカラーに変換
     * @param string hex カラーコード
     * @return string 256カラー番号
     */
    private function getRgbToShort($hex)
    {
        $rgb_to_short = array_flip($this->colors);
        $parts = $this->getHexToRgb($hex);
        $res = array();
        foreach ($parts as $part) {
            $i = 0;
            while ($i < count($this->incs)-1) {
                list($s, $b) = array($this->incs[$i], $this->incs[$i+1]);
                if ($s <= $part && $part <= $b) {
                    $sl = abs($s - $part);
                    $bl = abs($b - $part);
                    $closest = $sl < $bl ? $s : $b;
                    $res[] = $closest;
                    break;
                }
                $i += 1;
            }
        }
        $res = $this->getRgbToHex($res[0], $res[1], $res[2]);
        if (!empty($rgb_to_short[$res])) {
            return $rgb_to_short[$res];
        }
        return;
    }

}

