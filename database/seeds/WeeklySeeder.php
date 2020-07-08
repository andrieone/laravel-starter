<?php

use App\Models\Weekly;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WeeklySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){


        $last_monday="";

        $ii = 0; 
        // 2020-2070年分のデータ
        for($ii=2020;$ii<=2070;$ii++){
            
            $year   = $ii;
            $target = array(0, 1);   // 日曜と土曜
            $datetime = new DateTime();
            $datetime->setTimezone( new DateTimeZone('Asia/Tokyo') );
            $datetime->setDate($year, 1, 1);    // 年,月,日
            $interval =  new DateInterval('P1D');   // 間隔. 1dayごと
            // 閏年をチェック
            // 閏年だったら366, 平年だったら365
            $days = $datetime->format('L') == '1' ? 366 : 365;
            $result = array();
            for($i=0;$i<$days;$i++){
                if( in_array( (int)$datetime->format('w'), $target) ){
                    $result[] = clone $datetime;
                }
                $datetime->add($interval);
            }
            $count = 0;
            $set_count = 0;
            $datum = [];
            $monday_data = "";
            $sunday_data = "";
            // 指定年の日曜月曜を取得する
            foreach($result as $value){
                // 1つめの読み込み
                // 日曜だったら
                if($value->format('w') == 0 && $count == 0){
                        if($ii==2020){
                            $count++;
                        }
                        else{
                            $monday_data = $last_monday;
                            $sunday_data = $value;
                            array_push($datum, ['monday' => $monday_data, 'sunday' => $sunday_data, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
                            $count ++;
                            var_dump($last_monday);
                        }
                }
                else if($value->format('w') == 1 && $count == 0){
                    $count ++;
                    $monday_data = $value;
                }
                else if($value->format('w') == 0 && $count == 1){
                    $sunday_data = $value->format("Y/m/d");
                    array_push($datum, ['monday' => $monday_data, 'sunday' => $sunday_data, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
                    $monday_data = "";
                    $sunday_data = "";
                }
                else if($value->format('w') == 1 && $count == 1){
                    $monday_data = $value->format("Y/m/d");
                    $last_monday = $value->format("Y/m/d");
           
                }
            }
            $weekly = new Weekly();
            $weekly->insert($datum);
        }
    }
}
