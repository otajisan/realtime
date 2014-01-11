<?php

namespace Fuel\App\Object;

/**
 * サイコロを表すクラス
 */
class Dice{

    /** サイコロの方向 x 数値のマッピング */
    const TOP    = 1;
    const NORTH  = 2;
    const WEST   = 3;
    const EAST   = 4;
    const SOUTH  = 5;
    const BOTTOM = 6;

    /** 略称とのマッピング */
    private $DIRECTIONS = array(
        'N' => self::NORTH,
        'W' => self::WEST,
        'E' => self::EAST,
        'S' => self::SOUTH,
    );

    /** サイコロの状態を管理する配列 */
    private $_state = array();

    /**
     * コンストラクタ
     */
    public function __construct($top, $north, $west){

        // サイコロの初期状態を設定する
        $this->setState($top, $north, $west);
    }

    /**
     * サイコロの状態を設定する
     */
    public function setState($top, $north, $west){

        $this->_state = array(
            self::TOP    => $top,
            self::NORTH  => $north,
            self::WEST   => $west,
            self::EAST   => 7 - intval($west),
            self::SOUTH  => 7 - intval($north),
            self::BOTTOM => 7 - intval($top),
        );
    }

    /**
     * サイコロを転がす
     */
    public function shake($directions){

        // 初期配置時の上面を取得
        $result = array($this->getTop());

        for($i = 0, $len = mb_strlen($directions); $i < $len; $i++){

            // 方向を1つ取る
            $direction = mb_substr($directions, $i, 1);

            // サイコロを1マス転がす
            $next = $this->getNext($direction);

            // サイコロの状態を更新
            $this->setState(
                $next['top'],
                $next['north'],
                $next['west']
            );

            // 現在の上面を取得
            $result[] = $this->getTop();
        }

        $result = implode('', $result);

        return $result;
    }

    /**
     * サイコロが転がったときの状態を取得する
     *
     * TODO:縦と横方向に分解すればもっとリファクタできるかも
     */
    public function getNext($direction){

        $dirNum = $this->DIRECTIONS[$direction];

        // 上面を取得(上面にくるのは、転がった方向の裏側の数値)
        $top = $this->_state[7 - $dirNum];

        switch($direction){

            // 東, 西の場合、北面は変わらない
            case 'E':
                $north = $this->_state[self::NORTH];
                $west  = $this->_state[self::BOTTOM];
                break;

            case 'W':
                $north = $this->_state[self::NORTH];
                $west  = $this->_state[self::TOP];
                break;

            // 北, 南面の場合、西面は変わらない
            case 'S':
                $north = $this->_state[self::BOTTOM];
                $west  = $this->_state[self::WEST];
                break;

            case 'N':
                $north = $this->_state[self::TOP];
                $west  = $this->_state[self::WEST];
                break;
        }

        return array(
            'top'   => $top,
            'north' => $north,
            'west'  => $west,
        );
    }

    /**
     *
     */
    public function getTop(){

        return $this->_state[self::TOP];
    }

}
