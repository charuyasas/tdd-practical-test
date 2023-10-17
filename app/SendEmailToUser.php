<?php

namespace App;

use App\Jobs\SendPostEmailJob;
use App\Mail\SendPostMail;
use App\Models\EmailLogs;
use App\Models\Posts;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendEmailToUser
{
    public static function sendEmailNotification()
    {
        $usersList = Users::join('subscriptions', 'subscriptions.user_id', '=', 'users.id')->get();
        $postsList = Posts::all();

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
                $result = EmailLogs::where('post_id', $post->id)->where('user_id', $user->id)->get();
                if ($result->count() == 0) {
                    EmailLogs::create(['post_id' => $post->id, 'user_id' => $user->id]);
                    //Mail::to($user->email)->send(new SendPostMail($post->title, $post->description));
                    dispatch(new SendPostEmailJob($user->email, $post->title, $post->description));
                }else{
                    return false;
                }
            }
        }
    }
}
