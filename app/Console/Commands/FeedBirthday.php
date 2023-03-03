<?php

namespace App\Console\Commands;

use App\Models\Feed;
use App\Models\User;
use App\Traits\CroppedImage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class FeedBirthday extends Command
{
    use CroppedImage;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feed:birthday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Feed Birthday of staff';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::leftjoin('user_details', 'users.id', 'user_details.user_id')
                ->where('users.status', 1)
                ->whereMonth('user_details.dob', '=', Date('m'))
                ->whereDay('user_details.dob', '=', Date('d'))
                ->select('users.id', 'users.name', 'users.branch_id', 'users.profile_image', 'user_details.dob')
                ->get();
        foreach($users as $user)
        {
            $checkAutoBdayWish = Feed::where('to_user', $user->id)->where('category', Feed::CATEGORY_BIRTHDAY)->whereDate('created_at', Date('y-m-d'))->first();
            if(!isset($checkAutoBdayWish->id))
            {
                // user image
                $image_url = $this->getCroppedImage($user->profile_image, [100, 100]);
                $title = 'HAPPY BIRTHDAY';
                $background = asset('images/feed/birthday.jpg');

                $message = 'Happy birthday! May your day be filled with positivity, productivity, lots of love  <br>and happiness.</br>';
                $html = '<div style="width:100%; background-image: url(' . $background . '); background-repeat: no-repeat; background-size: cover;">
                <div class="text-center" style="padding-top: 50px;padding-bottom: 50px;">
                    <h3>' . $title . '</h3>
                    <img alt="profile picture" class="img-circle" src="' . $image_url . '" style="width: 100px; height: 100px; object-fit:contain; border: 1px solid #9f9fd2;">
                    <div>
                        <span style="font-size: 30px; font-family: cursive; padding: 5px;">' . $user->name . '</span>
                        <br>
                        <span style="font-size: 20px; font-family: cursive; text-align: center; padding: 5px;">' . $message . '</span>
                        <div style="font-size: 16px; text-align: center; font-family: cursive;">
                        <p class="mt-5">Warm Regards,<br>People & Culture Unit, HR Department <br>Shine Resunga Development Bank Limited</p>
                        </div>
                    </div>
                </div>
                </div>';
                Feed::create([
                    'user_id' => config('custom.feeds.handler'),
                    'to_user' => $user->id,
                    'category' => FEED::CATEGORY_BIRTHDAY,
                    'event' => json_encode($html, JSON_UNESCAPED_SLASHES)
                ]);
            }
//            Log::notice($user->name.' Birthday Wish Dispatch');
        }
    }
}
