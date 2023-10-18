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
        $users = Users::join('subscriptions', 'subscriptions.user_id', '=', 'users.id')->get();
        $posts = Posts::all();

        if ($users->count() == 0) {
            return false;
        }

        if ($posts->count() == 0) {
            return false;
        }

        foreach ($posts as $post) {
            foreach ($users as $user) {
                if ($user->website_id != $post->website_id){
                    continue;
                }

                $result = EmailLogs::where('post_id', $post->id)->where('user_id', $user->id)->get();

                if ($result->count() == 0) {
                    $emailLogs=new EmailLogs();
                    $emailLogs->post_id = $post->id;
                    $emailLogs->user_id = $user->id;
                    $emailLogs->save();
                    Mail::to($user->email)->queue(new SendPostMail($post->title, $post->description));
                }else{
                    return false;
                }
            }
        }
    }
}
