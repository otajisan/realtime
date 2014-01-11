<?php

namespace Fuel\Tasks;

use Fuel\App\Object\Dice;;

/**
 * サイコロを転がす実行クラス
 */
class ShakeDice {

    /** テストケースの番号 */
    private static $_caseNum = 0;

    /**
     * サイコロを振る
     */
    public static function run($directions){

        // サイコロの初期状態を設定し、インスタンスを生成
        $dice = new Dice('1', '2', '3');

        return $dice->shake($directions);
    }

    /**
     * テストケースを実行
     */
    public static function doTest(){

        /*0*/ static::test( "NNESWWS", "15635624" );
        /*1*/ static::test( "EEEE", "13641" );
        /*2*/ static::test( "WWWW", "14631" );
        /*3*/ static::test( "SSSS", "12651" );
        /*4*/ static::test( "NNNN", "15621" );
        /*5*/ static::test( "EENN", "13651" );
        /*6*/ static::test( "WWNN", "14651" );
        /*7*/ static::test( "SSNN", "12621" );
        /*8*/ static::test( "NENNN", "153641" );
        /*9*/ static::test( "NWNNN", "154631" );
        /*10*/ static::test( "SWWWSNEEEN", "12453635421" );
        /*11*/ static::test( "SENWSWSNSWE", "123123656545" );
        /*12*/ static::test( "SSSWNNNE", "126546315" );
        /*13*/ static::test( "SWNWSSSWWE", "12415423646" );
        /*14*/ static::test( "ENNWWS", "1354135" );
        /*15*/ static::test( "ESWNNW", "1321365" );
        /*16*/ static::test( "NWSSE", "154135" );
        /*17*/ static::test( "SWNWEWSEEN", "12415154135" );
        /*18*/ static::test( "EWNWEEEEWN", "13154532426" );
        /*19*/ static::test( "WNEWEWWWSNW", "145151562421" );
        /*20*/ static::test( "NNEE", "15631" );
        /*21*/ static::test( "EEEEWNWSW", "1364145642" );
        /*22*/ static::test( "SENNWWES", "123142321" );
        /*23*/ static::test( "SWWWSNSNESWW", "1245363635631" );
        /*24*/ static::test( "WESSENSE", "141263231" );
        /*25*/ static::test( "SWNSSESESSS", "124146231562" );
        /*26*/ static::test( "ENS", "1353" );
        /*27*/ static::test( "WNN", "1453" );
        /*28*/ static::test( "SSEENEEEN", "1263124536" );
        /*29*/ static::test( "NWSNNNW", "15414632" );
        /*30*/ static::test( "ESSSSSWW", "132453215" );
        /*31*/ static::test( "ESE", "1326" );
        /*32*/ static::test( "SNWNWWNSSSS", "121456232453" );
        /*33*/ static::test( "SWEESEN", "12423653" );
        /*34*/ static::test( "NEEWNSSWWW", "15323631562" );
        /*35*/ static::test( "WSEW", "14212" );
        /*36*/ static::test( "SWSNNNSNWE", "12464131353" );
        /*37*/ static::test( "ENWEWSEEW", "1351513545" );
        /*38*/ static::test( "WSEWN", "142124" );
        /*39*/ static::test( "EWNEESEWE", "1315321414" );
        /*40*/ static::test( "NESEEN", "1531263" );
        /*41*/ static::test( "WSW", "1426" );
        /*42*/ static::test( "ENEWE", "135656" );
    }

    /**
     * テストを実行し、結果を出力する
     */
    public static function test($case, $answer){

        $result = static::run($case);

        if($result !== $answer){

            print_r('[' . static::$_caseNum . '][NG] result:' . $result . "\n");
            exit();
        }

        print_r('[' . static::$_caseNum . '][OK] result:' . $result . "\n");

        static::$_caseNum++;
    }

}

