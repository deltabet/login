<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonString = file_get_contents('final.json');
		$coursesJSON = json_decode($jsonString, true);
		foreach($coursesJSON as $courseJSON){
			$course = new App\Models\Course;
			$nameArray = $courseJSON['name'];
			$name = $nameArray[0];
			$name = substr($name, 9);
			$name = substr($name, 0, -7);
			$course->name = $name;
			try{
				$course->address = $courseJSON['address'][0];
			} catch (Exception $e){
				$course->address = "";
			}
			try{
				$course->city = $courseJSON['city'][0];
			} catch (Exception $e){
				$course->city = "";
			}
			try{
				$course->state = $courseJSON['state'][0];
			} catch (Exception $e){
				$course->state = "";
			}		
			$course->zip = "";
			try{	
				$course->phone = $courseJSON['phone'];
			} catch (Exception $e){
				$course->phone = "";
			}
			try{
				$course->website = $courseJSON['website'][0];
			} catch (Exception $e){
				$course->website = "";
			}
			$course->email = "";
			$course->twitter = "";
			$course->facebook = "";
			$course->pinterest = "";
			
			$hdcp = array();
			$par = array();
			$parIn = 0;
			$parOut = 0;
			for ($i = 0; $i < 9; $i++){
				$hdcp[$i] = intval($courseJSON['hdcp'][$i]);
				$par[$i] = intval($courseJSON['par'][$i]);
				$parOut += $par[$i];
			}
			$course->parout = $parOut;
			for ($i = 9; $i < 18; $i++){
				$hdcp[$i] = intval($courseJSON['hdcp'][$i]);
				$par[$i] = intval($courseJSON['par'][$i]);
				$parIn += $par[$i];
			}
			$course->parin = $parIn;
			$course->partotal = $parOut + $parIn;
			$course->par = json_encode($par);
			$course->hdcp = json_encode($hdcp);
			$course->save();

			foreach($courseJSON['colors'] as $colorJSON){
				$color = new App\Models\Color;
				$color->course_id = $course->id;
				switch ($colorJSON['teeName']){
					case "Pro Tee":
						$color->color = "Black";
						break;
					case "Champion Tee":
						$color->color = "Blue";
						break;
					case "Men Tee":
						$color->color = "White";
						break;
					case "Women Tee Tee":
						$color->color = "Red";
						break;
					default:
						$color->color = "White";
				}
				$color->slope = intval($colorJSON['slope']);
				$dis = array();
				$disIn = 0;
				$disOut = 0;
				for ($i = 0; $i < 9; $i++){
					$dis[$i] = intval($colorJSON['dis'][$i]);
					$disOut += $dis[$i];
				}
				$color->disout = $disOut;
				for ($i = 9; $i < 18; $i++){
					$dis[$i] = intval($colorJSON['dis'][$i]);
					$disIn += $dis[$i];
				}
				$color->disin = $disIn;
				$color->distotal = $disOut + $disIn;
				$color->dis = json_encode($dis);
				$color->save();
			}
		}
    }
}
