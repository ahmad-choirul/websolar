<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pid extends CI_Controller {

  public function __construct()
  {
    parent::__construct();

  }

  public function index()
  {

  }

  public function hitung($x,$y,$timebefore='',$yaw_previous_error=0,$pitch_previous_error=0)
  {

    if (isset($timebefore)) {
     $timebefore = microtime(true);
     usleep(100);
   }

//////////////////////////////PID untuk yaw (atas bawah)///////////////////////////
   $yaw_PID;$pwm_L_F;$pwm_L_B;$pwm_R_F;$pwm_R_B;$yaw_error;$yaw_previous_error;
   $yaw_PID_p=0;
   $yaw_PID_i=0;
   $yaw_PID_d=0;
///////////////////////////////konstanta PID yaw////////////////////
$yaw_kp=4;//3.55
$yaw_ki=0.1;//0.003
$yaw_kd=0.1;//2.05
$setpoint_yaw = 0;     //sudut stabil yaw

//////////////////////////////PID FOR PITCH//////////////////////////
$pitch_PID;$pitch_error;$pitch_previous_error;
$pitch_PID_p=0;
$pitch_PID_i=0;
$pitch_PID_d=0;
///////////////////////////////PITCH PID CONSTANTS///////////////////
$pitch_kp=4;//3.55
$pitch_ki=0.1;//0.003
$pitch_kd=0.1;//2.05
$setpoint_pitch = 0;     //sudut stabil pitch

$PWM_pitch;$PWM_yaw;

$timePrev = $timebefore; 
$time = microtime(true);
$elapsedtime = ($time - $timePrev) / 1000;   

$Gyro_angle_x = $x;
//---X---//
$Gyro_angle_y = $y;

/////////////////////////////P I D/////////////////////////////////////
    $setpoint_yaw = 0;   //The angle we want the gimbal to stay is 0 and 0 for both axis for now...
    $setpoint_pitch = 0;
    
    $yaw_error = $Gyro_angle_x - $setpoint_yaw;
    $pitch_error = $Gyro_angle_y - $setpoint_pitch;    

    $yaw_PID_p = $yaw_kp*$yaw_error;
    $pitch_PID_p = $pitch_kp*$pitch_error;

    if( -3 < $yaw_error && $yaw_error <3)
    {
      $yaw_PID_i = $yaw_PID_i+($yaw_ki*$yaw_error);
    }
    if(-3 < $pitch_error && $pitch_error < 3)
    {
      $pitch_PID_i = $pitch_PID_i+($pitch_ki*$pitch_error);  
    }

    $yaw_PID_d = $yaw_kd*(($yaw_error - $yaw_previous_error)/$elapsedtime);
    $pitch_PID_d = $pitch_kd*(($pitch_error - $pitch_previous_error)/$elapsedtime);
    
    $yaw_PID = $yaw_PID_p + $yaw_PID_i + $yaw_PID_d ;
    $pitch_PID = $pitch_PID_p + $pitch_PID_i + $pitch_PID_d ;

    if($yaw_PID < -90){$yaw_PID = -90;}
    if($yaw_PID > 90) {$yaw_PID = 90; }
    if($pitch_PID < -90){$pitch_PID = -90;}
    if($pitch_PID > 90) {$pitch_PID = 90;}
    
    $yaw_previous_error = $yaw_error;     
    $pitch_previous_error = $pitch_error;  

    $PWM_pitch = 90 + $pitch_PID;          
    $PWM_yaw = 90 - $yaw_PID;
    
    echo "<pre>";
    print_r ($PWM_pitch);
    print_r ("//");
    // print_r ($pitch_PID);
    print_r ("//");
    print_r ($PWM_yaw);
    print_r ("//");
    // print_r ($yaw_PID);

    echo "</pre>";
    $timebefore = $time;
  }
}

// End of file pid.php //
// Location: ./application/controllers/pid.php //