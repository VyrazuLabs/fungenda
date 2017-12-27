<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\EmailNotificationSettings;
use Mail;
use App\Models\Business;
use App\Models\Event;

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

                   $user_data = EmailNotificationSettings::where('user_id',$value['user_id'])->first();

                   $business_id_array = explode(',', $user_data['business_id']);
                   $business_data_all = [];

                   foreach ($business_id_array as $val) {
                       $business_data = Business::where('business_id',$val)->first();
                       $business_data_all[] = $business_data;
                   }
                   // print_r($business_data_all);die;
                    Mail::send('email.cron_business_email',['name' => 'Efungenda','all_business' => $business_data_all,'first_name' => $first_name],function($message) use($email,$first_name){$message->from('vyrazulabs@gmail.com', $name = null)->to($email,$first_name)->subject('List of Updated business');
                    });

                    // print_r($user_data['business_id']);die;
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

                   $user_data = EmailNotificationSettings::where('user_id',$value['user_id'])->first();

                   $event_id_array = explode(',', $user_data['event_id']);
                   $event_data_all = [];

                   foreach ($event_id_array as $val) {
                       $event_data = Event::where('event_id',$val)->first();
                       $event_data_all[] = $event_data;
                   }

                    Mail::send('email.cron_event_email',['name' => 'Efungenda','all_event' => $event_data_all,'first_name' => $first_name],function($message) use($email,$first_name){$message->from('vyrazulabs@gmail.com', $name = null)->to($email,$first_name)->subject('List of Updated event');
                    });

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

                       $user_data = EmailNotificationSettings::where('user_id',$value['user_id'])->first();

                       $first_name =  $user_first_name[0];

                       $business_id_array = explode(',', $user_data['business_id']);
                       $business_data_all = [];

                       foreach ($business_id_array as $val) {
                           $business_data = Business::where('business_id',$val)->first();
                           $business_data_all[] = $business_data;
                       }

                         Mail::send('email.cron_business_email',['name' => 'Efungenda','all_business' => $business_data_all,'first_name' => $first_name],function($message) use($email,$first_name){$message->from('vyrazulabs@gmail.com', $name = null)->to($email,$first_name)->subject('List of Updated business');
                        });

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

                        $user_data = EmailNotificationSettings::where('user_id',$value['user_id'])->first();

                       $first_name =  $user_first_name[0];

                       $event_id_array = explode(',', $user_data['event_id']);
                       $event_data_all = [];

                       foreach ($event_id_array as $val) {
                           $event_data = Event::where('event_id',$val)->first();
                           $event_data_all[] = $event_data;
                       }

                        Mail::send('email.cron_event_email',['name' => 'Efungenda','all_event' => $event_data_all,'first_name' => $first_name],function($message) use($email,$first_name){$message->from('vyrazulabs@gmail.com', $name = null)->to($email,$first_name)->subject('List of Updated event');
                        });

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
