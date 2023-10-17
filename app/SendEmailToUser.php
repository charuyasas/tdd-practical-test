<?php

namespace App;

use App\Jobs\SendPostEmailJob;
use App\Mail\SendPostMail;
use App\Models\EmailLogs;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendEmailToUser
{
    public static function sendEmailNotification()
    {
        $usersList = DB::table('users')
            ->join('subscriptions', 'subscriptions.user_id', '=', 'users.id')
            ->get();
        $postsList = DB::table('posts')->get();

        if ($usersList->count() == 0) {
            return false;
        }
        if ($postsList->count() == 0) {
            return false;
        }
        foreach ($postsList as $post) {
            foreach ($usersList as $user) {
                if ($user->website_id != $post->website_id){
                    continue;
                }
                $result = DB::table('email_logs')->where('post_id', $post->id)->where('user_id', $user->id)->get();
                if ($result->count() == 0) {
                    $result = EmailLogs::create(['post_id' => $post->id, 'user_id' => $user->id]);
                    //Mail::to($user->email)->send(new SendPostMail($post->title, $post->description));
                    dispatch(new SendPostEmailJob($user->email, $post->title, $post->description));
                }else{
                    return false;
                }
            }
        }
    }
}
