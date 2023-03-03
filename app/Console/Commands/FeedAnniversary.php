<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Feed;
use App\Models\User;
use App\Traits\CroppedImage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class FeedAnniversary extends Command
{
    use CroppedImage;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feed:anniversary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Feed Anniversary of staff';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::whereMonth('join_date', '=', Date('m'))
            ->whereDay('join_date', '=', Date('d'))
            ->where('status', 1)
            ->get(['id', 'name', 'profile_image', 'join_date']);
        foreach($users as $user)
        {
            $checkAutoBdayWish = Feed::where('to_user', $user->id)->where('category', Feed::CATEGORY_ANNIVERSARY)->whereDate('created_at', Date('y-m-d'))->first();
            if(!isset($checkAutoBdayWish->id))
            {

                $dbDate = Carbon::parse($user->join_date)->format('Y-m-d');
                $countYear = Carbon::now()->diffInYears($dbDate);
                if($countYear < 1){
                    continue;
                }
                $title = 'Many Congratulations!';
                $message = '<mark><p>We would like to take a moment to recognize and thank you for your contributions to Shine Resunga Development Bank over the past year/s. We are indeed happy to have you with us. In particular, we would
                like to acknowledge your contribution for all the professional areas you have been involved with.</P><br><p>Happy '.$countYear.' Year Work Anniversary. We would like to wish you all the best for your future with us. Keep up the good work!</p></mark>';
                $background = asset('images/feed/anniversary.jpeg');

                // user image
                $image_url = $this->getCroppedImage($user->profile_image, [100, 100]);

                $html = '<div style="width:100%; background-image: url('.$background.'); background-repeat: no-repeat; background-size: cover;">
                <div class="text-center" style="padding-top: 50px;padding-bottom: 50px;">
                    <h3 style="color:green;">'.$title.'</h3>
                    <img alt="profile picture" class="img-circle" src="'.$image_url.'" style="width: 100px; height: 100px; object-fit:contain; border: 1px solid #9f9fd2;">
                    <div>
                        <span style="font-size: 30px; font-family: cursive; padding: 5px;">Dear '.$user->name.'</span>
                        <br>
                        <span style="font-size: 20px; font-family: cursive; text-align: center; padding: 5px;">'.$message.'</span>
                        <div style="font-size: 16px; text-align: center; font-family: cursive;">
                        <p>Warm regards, <br>People & Culture Unit, HR Department <br>Shine Resunga Development Bank Limited</p>
                        </div>
                    </div>
                </div>
                </div>';
                Feed::create([
                    'user_id' => config('custom.feeds.handler'),
                    'to_user' => $user->id,
                    'category' => FEED::CATEGORY_ANNIVERSARY,
                    'event' => json_encode($html, JSON_UNESCAPED_SLASHES)
                ]);
//                Log::notice($user->name.' Anniversary Wish Dispatch');
            }
        }
    }
}
