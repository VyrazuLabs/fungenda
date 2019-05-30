<?php

namespace App\Console\Commands;

use App\Models\Address;
use App\Models\AssociateTag;
use App\Models\Business;
use App\Models\BusinessHoursOperation;
use App\Models\BusinessOffer;
use App\Models\MyFavorite;
use App\Models\RecentlyViewed;
use App\Models\User;
use Config;
use Illuminate\Console\Command;
use Mail;

class BusinessDateCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'business:dateValidation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check business date';

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
        $all_business = Business::all();
        $today = date('Y-m-d');

        $url = Config::get('app.url');

        foreach ($all_business as $business) {

            $my_favorite = [];
            $recently_viewed = [];
            $address = [];
            $business_offer = [];
            $associate_tags = [];
            $business_hours_operation = [];
            //2017-10-14 06:28:31

            $last_update_date = explode(' ', $business->updated_at)[0];
            $last_date = date('Y-m-d', strtotime($last_update_date . ' +181 day'));
            $prev_date = date('Y-m-d', strtotime($last_date . ' -15 day'));
            // echo $prev_date;die;
            if ($last_date == $today) {

                $my_favorite = MyFavorite::where('entity_id', $business->business_id)->where('entity_type', 1)->get();
                if (!empty($my_favorite)) {
                    foreach ($my_favorite as $value) {
                        $value->delete();
                    }
                }
                $recently_viewed = RecentlyViewed::where('entity_id', $business->business_id)->where('type', 1)->first();
                if (!empty($recently_viewed)) {
                    $recently_viewed->delete();
                }

                $address = Address::where('address_id', $business->business_location)->first();
                $address->delete();
                $business_offer = BusinessOffer::where('business_id', $business->business_id)->first();
                $business_offer->delete();
                $associate_tags = AssociateTag::where('entity_id', $business->business_id)->where('entity_type', 1)->first();
                if (!empty($associate_tags)) {
                    $associate_tags->delete();
                }
                $business_hours_operation = BusinessHoursOperation::where('business_id', $business->business_id)->first();
                if (!empty($business_hours_operation)) {
                    $business_hours_operation->delete();
                }
                $business->delete();
            }
            if ($prev_date == $today) {

                $user_data = User::where('user_id', $business->created_by)->first();

                $first_name = $user_data->first_name;
                $email = $user_data->email;
                Mail::send('email.business_lastdate_notification', ['name' => 'Efungenda', 'first_name' => $first_name, 'data' => $business, 'last_date' => $last_date, 'url' => $url], function ($message) use ($email, $first_name) {
                    $message->from('vyrazulabs@gmail.com', $name = null)->to($email, $first_name)->subject('Notification of business last date');
                });
            }
        }
    }
}
