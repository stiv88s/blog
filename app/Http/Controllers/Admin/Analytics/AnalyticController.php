<?php

namespace App\Http\Controllers\Admin\Analytics;

use App\Http\Controllers\Controller;
use App\ModelRepository\PostRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AnalyticController extends Controller
{
    public $prepo;

    public function __construct(PostRepository $prepo)
    {
        $this->prepo = $prepo;
    }

    public function postAnalytic(Request $request)
    {
        $startDate = $request->input('startDate') ? Carbon::parse($request->input('startDate')) : Carbon::now()->firstOfMonth();
        $endDate = $request->input('endDate') ? Carbon::parse($request->input('endDate')) : Carbon::now()->lastOfMonth();
        $topPosts = $this->prepo->getTopPosts($n = 5,$startDate->startOfDay() ,$endDate->endOfDay());
        $postsAnalytic = $this->prepo->postAnalytic($startDate->startOfDay() ,$endDate->endOfDay());
        $dateRange = $this->generateDateRange(Carbon::parse($startDate), Carbon::parse($endDate));
        $startDateFormat = $startDate->format('Y/m/d');
        $endDateFormat = $endDate->format('Y/m/d');
//dd( $postsAnalytic);
        if ($request->wantsJson()) {

            return [
                'topPosts' => $topPosts,
                'datarange' => $dateRange,
                'startDateFormat' => $startDateFormat,
                'endDate' => $endDateFormat,
                'postAnalytic'=>$postsAnalytic

            ];
        }

        return view('admin.analytics.post', compact('dateRange', 'startDateFormat', 'endDateFormat', 'topPosts','postsAnalytic'));
    }


    private function generateDateRange(Carbon $start_date, Carbon $end_date): array
    {
        $dates = [];

        for ($date = $start_date; $date->lte($end_date); $date->addDay()) {
            $dates['range'][] = $date->format('d F');
            $dates['data'][] = $date->format('Y-m-d');
        }

        return $dates;
    }

    private function rand_color()
    {
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }

}
