<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use App\Models\MyFavorite;
use App\Models\RecentlyViewed;
use App\Models\Address;
use App\Models\EventOffer;
use App\Models\User;
use App\Models\AssociateTag;
use Mail;
use Config;

class EventDateCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'event:dateValidation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check events date';

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
        /* GET ALL EVENTS DATA */
        $all_event = Event::get();
        $today = date('Y-m-d');

        $url = Config::get('app.url');

        foreach ($all_event as $event) {

            $last_date_array = [];
            $my_favorite = [];
            $recently_viewed = [];
            $address = [];
            $event_offer = [];
            $associate_tags = [];

            $last_date_array = explode(',', $event->event_start_date);
            $last_date = $last_date_array[count($last_date_array)-1];
            $prev_date = date('Y-m-d', strtotime($last_date .' -15 day'));
            $last_date = date('Y-m-d', strtotime($last_date .' +0 day'));

            if($last_date < $today) {

                $my_favorite = MyFavorite::where('entity_id',$event->event_id)->where('entity_type',2)->get();
                if(!empty($my_favorite)){
                  foreach ($my_favorite as $value) {
                    $value->delete();
                  }
                }

                $recently_viewed = RecentlyViewed::where('entity_id',$event->event_id)->where('type',2)->first();
                if(!empty($recently_viewed)){
                  $recently_viewed->delete();
                }

                $address = Address::where('address_id',$event->event_location)->first();
                $address->delete();
                $event_offer = EventOffer::where('event_id',$event->event_id)->first();
                $event_offer->delete();
                $associate_tags = AssociateTag::where('entity_id',$event->event_id)->where('entity_type',2)->first();
                if(!empty($associate_tags)){
                  $associate_tags->delete();
                }  
                $event->delete();
            }
            if($prev_date == $today) {

                $user_data = User::where('user_id',$event->created_by)->first();

                $first_name = $user_data->first_name;
                $email = $user_data->email;

                Mail::send('email.event_lastdate_notification',['name' => 'Efungenda','first_name'=>$first_name, 'data'=>$event, 'last_date' => $last_date, 'url' => $url],function($message) use($email,$first_name){
                    $message->from('vyrazulabs@gmail.com', $name = null)->to($email,$first_name)->subject('Notification of events last date');
                  });
                //email.event_lastdate_notification
            }
        }

    }
}
