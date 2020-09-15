<?php

namespace App\Console\Commands;

use App\Events\WeeklyPostsNotificationEvent;
use App\Model\Post;
use App\Model\Settings;
use App\Model\Subscribers;
use App\ModelRepository\PostRepository;
use Carbon\Carbon;
use Illuminate\Console\Command;

class WeeklySubscribersPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weekly:send_posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send most views weekly new posts';

    protected $prepo;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(PostRepository $prepo)
    {
        parent::__construct();

        $this->prepo = $prepo;


    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $subscribers = Subscribers::all();
        $weeklyMostViewsPosts = $this->prepo->getWeeklyMostViewPosts();

        if ($weeklyMostViewsPosts->isEmpty()) {
            return;
        }

        if ($subscribers->isEmpty()) {
            return;
        }

        event(new WeeklyPostsNotificationEvent($subscribers, $weeklyMostViewsPosts));

    }
}
