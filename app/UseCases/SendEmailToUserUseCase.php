<?php

namespace App\UseCases;

use App\Mail\SendPostMail;
use App\Models\EmailLog;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SendEmailToUserUseCase
{
    public function execute()
    {
        $users = User::join('subscriptions', 'subscriptions.user_id', '=', 'users.id')->get();
        $posts = Post::all();

        if ($users->count() == 0) {
            return false;
        }

        if ($posts->count() == 0) {
            return false;
        }

        foreach ($posts as $post) {
            foreach ($users as $user) {
                if ($user->website_id != $post->website_id) {
                    continue;
                }

                $result = EmailLog::where('post_id', $post->id)->where('user_id', $user->id)->get();

                if ($result->count() == 0) {
                    self::sendEmailToUser($post, $user);
                } else {
                    return false;
                }
            }
        }
    }

    private static function sendEmailToUser(mixed $post, mixed $user): void
    {
        $emailLogs = new EmailLog();
        $emailLogs->post_id = $post->id;
        $emailLogs->user_id = $user->id;
        $emailLogs->save();
        Mail::to($user->email)->queue(new SendPostMail($post->title, $post->description));
    }
}
