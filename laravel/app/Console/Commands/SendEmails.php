<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\EmailNotificationSettings;
use Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail to users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        date_default_timezone_set('asia/kolkata');
        $all_notification_data = EmailNotificationSettings::all();

        foreach ($all_notification_data as $value) {
            if(empty($value['sending_date'])){
                if(!empty($value['business_id']) && $value['notification_enabled'] == 1){
                    $user_email = User::where('user_id',$value['user_id'])->pluck('email');
                    $email = $user_email[0];
                    $user_first_name = User::where('user_id',$value['user_id'])->pluck('first_name');
                   $first_name =  $user_first_name[0];

                    Mail::send('email.test_email',['name' => 'Efungenda'],function($message) use($email,$first_name){$message->from('vyrazulabs@gmail.com', $name = null)->to($email,$first_name)->subject('Update business');
                    });

                    $user_data = EmailNotificationSettings::where('user_id',$value['user_id'])->first();

                    if($value['notification_frequency'] == 1){
                        $user_data->update([
                            'sending_date' => $this->notificationFrequency(1),
                            'business_id' => ''
                        ]);
                    }
                    if($value['notification_frequency'] == 2){
                        $user_data->update([
                            'sending_date' => $this->notificationFrequency(7),
                            'business_id' => ''
                        ]);
                    }
                    if($value['notification_frequency'] == 3){
                        $user_data->update([
                            'sending_date' => $this->notificationFrequency(30),
                            'business_id' => ''
                        ]);
                    }
                }
                if(!empty($value['event_id']) && $value['notification_enabled'] == 1){
                    $user_email = User::where('user_id',$value['user_id'])->pluck('email');
                    $email = $user_email[0];
                    $user_first_name = User::where('user_id',$value['user_id'])->pluck('first_name');
                   $first_name =  $user_first_name[0];

                    Mail::send('email.test_email',['name' => 'Efungenda'],function($message) use($email,$first_name){$message->from('vyrazulabs@gmail.com', $name = null)->to($email,$first_name)->subject('Update event');
                    });

                    $user_data = EmailNotificationSettings::where('user_id',$value['user_id'])->first();

                    if($value['notification_frequency'] == 1){
                        $user_data->update([
                            'sending_date' => $this->notificationFrequency(1),
                            'event_id' => ''
                        ]);
                    }
                    if($value['notification_frequency'] == 2){
                        $user_data->update([
                            'sending_date' => $this->notificationFrequency(7),
                            'event_id' => ''
                        ]);
                    }
                    if($value['notification_frequency'] == 3){
                        $user_data->update([
                            'sending_date' => $this->notificationFrequency(30),
                            'event_id' => ''
                        ]);
                    }
                }
            }
            if(!empty($value['sending_date'])){
                date_default_timezone_set('asia/kolkata');
                $date = date("Y/m/d");
                $date = strtotime($date);
                if($date == strtotime($value['sending_date'])){
                    if(!empty($value['business_id']) && $value['notification_enabled'] == 1){
                        $user_email = User::where('user_id',$value['user_id'])->pluck('email');
                        $email = $user_email[0];
                        $user_first_name = User::where('user_id',$value['user_id'])->pluck('first_name');
                       $first_name =  $user_first_name[0];

                        Mail::send('email.test_email',['name' => 'Efungenda'],function($message) use($email,$first_name){$message->from('vyrazulabs@gmail.com', $name = null)->to($email,$first_name)->subject('Update business');
                        });

                        $user_data = EmailNotificationSettings::where('user_id',$value['user_id'])->first();

                        if($value['notification_frequency'] == 1){
                            $user_data->update([
                                'sending_date' => $this->notificationFrequencyDateSet($value['sending_date'],1),
                                'business_id' => ''
                            ]);
                        }
                        if($value['notification_frequency'] == 2){
                            $user_data->update([
                                'sending_date' => $this->notificationFrequencyDateSet($value['sending_date'],7),
                                'business_id' => ''
                            ]);
                        }
                        if($value['notification_frequency'] == 3){
                            $user_data->update([
                                'sending_date' => $this->notificationFrequencyDateSet($value['sending_date'],30),
                                'business_id' => ''
                            ]);
                        }
                    }
                    if(!empty($value['event_id']) && $value['notification_enabled'] == 1){
                        $user_email = User::where('user_id',$value['user_id'])->pluck('email');
                        $email = $user_email[0];
                        $user_first_name = User::where('user_id',$value['user_id'])->pluck('first_name');
                       $first_name =  $user_first_name[0];

                        Mail::send('email.test_email',['name' => 'Efungenda'],function($message) use($email,$first_name){$message->from('vyrazulabs@gmail.com', $name = null)->to($email,$first_name)->subject('Update event');
                        });

                        $user_data = EmailNotificationSettings::where('user_id',$value['user_id'])->first();

                        if($value['notification_frequency'] == 1){
                            $user_data->update([
                                'sending_date' => $this->notificationFrequencyDateSet($value['sending_date'],1),
                                'event_id' => ''
                            ]);
                        }
                        if($value['notification_frequency'] == 2){
                            $user_data->update([
                                'sending_date' => $this->notificationFrequencyDateSet($value['sending_date'],7),
                                'event_id' => ''
                            ]);
                        }
                        if($value['notification_frequency'] == 3){
                            $user_data->update([
                                'sending_date' => $this->notificationFrequencyDateSet($value['sending_date'],30),
                                'event_id' => ''
                            ]);
                        }
                    }
                }
            }
        }
    }

    public function notificationFrequency($freequescy){
        date_default_timezone_set('asia/kolkata');
        $date = date("Y/m/d");
        $date = strtotime($date);
        $date = strtotime("+".$freequescy."day", $date);
        $final_date = date('Y/m/d', $date);
        return $final_date;
    }

    public function notificationFrequencyDateSet($nowDate,$freequescy){
        date_default_timezone_set('asia/kolkata');
        $date = $nowDate;
        $date = strtotime($date);
        $date = strtotime("+".$freequescy."day", $date);
        $final_date = date('Y/m/d', $date);
        return $final_date;
    }
}
