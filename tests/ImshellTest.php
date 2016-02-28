<?php

use \App\Imshell;

class ImshellTest extends \PHPUnit_Framework_TestCase
{
    public $target = null;

    public function setUp()
    {
        Closure::bind(function () {
            $this->target = new \App\Imshell;
        }, $this, $this->target)->__invoke();
    }

    public function testSetImage()
    {
        Closure::bind(function () {
            $this->target->setImage('./img/sample.png');
            $this->assertEquals($this->target->image, './img/sample.png');
        }, $this, $this->target)->__invoke();
    }

    public function testSetChara()
    {
        Closure::bind(function () {
            $this->target->setChara('あいうえお');
            $this->assertFalse($this->target->bg_fill);
            $this->assertEquals($this->target->chara, array('あ', 'い', 'う', 'え', 'お'));
        }, $this, $this->target)->__invoke();
    }

    /**
     * @expectedException Exception
     * @expectedException Message 最大サイズは300です
     * @expectedExceptionCode 0
    */
    public function testSetWidth()
    {
        Closure::bind(function () {

            $this->target->max_width = 300;
            $this->target->width_len = 50;

            // 最小値に達していなかったらデフォルト値
            $this->target->setWidth(2);
            $this->assertEquals($this->target->width_len, 50);

            // 最小値
            $this->target->setWidth(3);
            $this->assertEquals($this->target->width_len, 3);

            // 最大値
            $this->target->setWidth(300);
            $this->assertEquals($this->target->width_len, 300);

            // 文字数オーバー
            $this->expectException($this->target->setWidth(301));

        }, $this, $this->target)->__invoke();
    }

    public function testGetChara()
    {
        Closure::bind(function () {

            // 背景塗りつぶし
            $this->assertEquals($this->target->getChara(), '  ');
            $this->assertEquals($this->target->getChara(), '  ');

            // シングルバイト
            $this->target->setChara('ABC');
            $this->assertEquals($this->target->getChara(), 'AB');
            $this->assertEquals($this->target->getChara(), 'CA');
            $this->assertEquals($this->target->getChara(), 'BC');
            $this->assertEquals($this->target->getChara(), 'AB');

            $this->target->pointer = 0;

            // マルチバイト
            $this->target->setChara('あいう');
            $this->assertEquals($this->target->getChara(), 'あ');
            $this->assertEquals($this->target->getChara(), 'い');
            $this->assertEquals($this->target->getChara(), 'う');
            $this->assertEquals($this->target->getChara(), 'あ');

            $this->target->pointer = 0;

            // シングル + マルチ
            $this->target->setChara('あAいBCうえA');
            $this->assertEquals($this->target->getChara(), 'あ');
            $this->assertEquals($this->target->getChara(), 'AA');
            $this->assertEquals($this->target->getChara(), 'い');
            $this->assertEquals($this->target->getChara(), 'BC');
            $this->assertEquals($this->target->getChara(), 'う');
            $this->assertEquals($this->target->getChara(), 'え');
            $this->assertEquals($this->target->getChara(), 'AA');
            $this->assertEquals($this->target->getChara(), 'あ');

        }, $this, $this->target)->__invoke();
    }

    public function testGetHexToRgb()
    {
        Closure::bind(function () {
            $this->assertEquals($this->target->getHexToRgb('ffffff'), array(255, 255, 255));
        }, $this, $this->target)->__invoke();
    }

    public function testGetRbgToHex()
    {
        Closure::bind(function () {
            $this->assertEquals($this->target->getRgbToHex(255, 255, 255), 'ffffff');
        }, $this, $this->target)->__invoke();
    }
}
