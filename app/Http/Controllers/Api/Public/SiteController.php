<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\Business\BusinessResource;
use App\Http\Resources\Event\EventCategoryResource;
use App\Http\Resources\Event\EventResource;
use App\Http\Resources\Event\EventScheduleResource;
use App\Http\Resources\Gym\GymResource;
use App\Http\Resources\Lease\LeaseResource;
use App\Http\Resources\Subscription\SubscriptionResource;
use App\Http\Resources\Workout\WorkoutResource;
use App\Models\Business\Business;
use App\Models\Ebook\EbookDowload;
use App\Models\Event\Event;
use App\Models\Event\EventCategory;
use App\Models\Event\EventSchedule;
use App\Models\Gym\Gym;
use App\Models\Lease\Lease;
use App\Models\Partner;
use App\Models\Subscription\Subscription;
use App\Models\Workout\Workout;
use App\Models\Workout\WorkoutEbookDownload;
use App\Notifications\Ebook\EbookDownloadNotification;
use App\Notifications\Workout\WorkoutEbookDownloadNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteController extends Controller
{
    public function gyms()
    {
        return $this->outputJSON(GymResource::collection(Gym::with('comforts', 'tennisCourts', 'workouts', 'subscriptions', 'leases')->get()));
    }

    public function showGym($slug)
    {
        $gym = Gym::where('slug', $slug)->firstOrFail();

        return $this->outputJSON(new GymResource($gym->load('comforts', 'tennisCourts', 'workouts', 'subscriptions', 'leases', 'events')));
    }

    public function partners()
    {
        return $this->outputJSON(Partner::all());
    }

    public function workouts()
    {
        return $this->outputJSON(WorkoutResource::collection(Workout::with('ebook', 'gyms', 'benefits')->get()));
    }

    public function subscriptions()
    {
        return $this->outputJSON(SubscriptionResource::collection(Subscription::with('gyms', 'classifications', 'benefits')->get()));
    }

    public function business()
    {
        return $this->outputJSON(BusinessResource::collection(Business::with('workouts', 'subscriptions', 'leases')->get()));
    }

    public function showProduct($slug)
    {
        $business = explode('-', $slug)[0];

        switch ($business) {
            case 'aulas':
                $workout = Workout::where('slug', $slug)->with('ebook', 'gyms', 'benefits')->firstOrFail();
                return $this->outputJSON(new WorkoutResource($workout));
            case 'assinaturas':
                $subscription = Subscription::where('slug', $slug)->with('ebook', 'gyms')->firstOrFail();
                return $this->outputJSON(new  SubscriptionResource($subscription));
            case 'locacoes':
                $lease = Lease::where('slug', $slug)->with('ebook', 'ebook', 'gyms')->firstOrFail();
                return $this->outputJSON(new LeaseResource($lease));
            default:
                return $this->outputJSON([], '', 400);
        }
    }

    public function leases()
    {
        return $this->outputJSON(LeaseResource::collection(Lease::with('gyms')->get()));
    }

    public function ebookDownload(Request $request)
    {
        $download = EbookDowload::firstOrCreate($request->all());

        $download->ebook->update(['download_total' =>  count($download->ebook->downloads)]);

        $download->notify(new EbookDownloadNotification($download->ebook->url));

        return $this->outputJSON([], 'success', true, 201);
    }

    public function schedule()
    {
        return $this->outputJSON(EventScheduleResource::collection(EventSchedule::with('event')->orderBy('start_at','DESC')->get()));
    }

    public function scheduleEvent($code)
    {
        return $this->outputJSON(new EventScheduleResource(EventSchedule::where('code', $code)->with('event', 'gym')->firstOrFail()));
    }

    public function eventsByCategory()
    {
        return $this->outputJSON(EventCategoryResource::collection(EventCategory::with('events')->get()));
    }
}
