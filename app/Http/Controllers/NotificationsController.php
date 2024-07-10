<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;
use Mockery\Matcher\Not;

class NotificationsController extends Controller
{
    public function getNotificationsData(Request $request)
    {

//        $notices = Notice::all();
        $notifications = [];
        $noticeDescription = Notice::pluck('description')->toArray();
        foreach ($noticeDescription as $description) {;

            $notifications[] = [
                'icon' => 'fas fa-fw fa-envelope',
                'text' => $description,
                'time' => rand(0, 0.1) . ' minutes',
            ];
        }

        $dropdownHtml = '';

        foreach ($notifications as $key => $not) {
            $icon = "<i class='mr-2 {$not['icon']}'></i>";

            $time = "<span class='float-right text-muted text-sm'>
                   {$not['time']}
                 </span>";

            $dropdownHtml .= "<a href='#' class='dropdown-item'>
                            {$icon}{$not['text']}{$time}
                          </a>";

            if ($key < count($notifications) - 1) {
                $dropdownHtml .= "<div class='dropdown-divider'></div>";
            }
        }

        // Return the new notification data.

        return [
            'label' => count($notifications),
            'label_color' => 'success',
            'icon_color' => 'dark',
            'dropdown' => $dropdownHtml,
        ];
    }
}
