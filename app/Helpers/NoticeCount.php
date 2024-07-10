<?php
/**
 * Created by PhpStorm.
 * User: Zwei
 * Date: 9/26/2019
 * Time: 6:02 PM
 */

namespace App\Helpers;

use App\Mail\VerificationCode;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use function Ramsey\Collection\Map\get;

class  NoticeCount
{

    static function getUnreadNoticeCount()
    {

//        $user = auth()->user();
//        get unread notification for this user
        return 5;
    }
}

?>
