<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    private $googleClient;

    public function __construct()
    {
        $this->googleClient = new Google_Client();
        $this->googleClient->setAuthConfig(json_decode(env('GOOGLE_CREDENTIALS'), true));
        $this->googleClient->setAccessType('offline');
        $this->googleClient->setRedirectUri('http://localhost'); // 设置为你的重定向 URI
//        $this->googleClient->setAccessToken(Auth::user()->google_token);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        //
        $email_list = config('app.email_list');
        $events = Event::all();
        return view('event-create', compact('email_list', 'events'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $this->googleClient->setAccessToken(Auth::user()->google_token);
        $service = new Google_Service_Calendar($this->googleClient);
        $event = new Google_Service_Calendar_Event(array(
            'summary' => $data['customer'] . "_" . $data['event'],
//            'location' => 'Location',
            'description' => $data['note'],
            'start' => array(
                'dateTime' => $data['start_time'], // 事件开始时间
                'timeZone' => 'Asia/Taipei',
            ),
            'end' => array(
                'dateTime' => $data['end_time'], // 事件结束时间
                'timeZone' => 'Asia/Taipei',
            ),
        ));

        $email_list = [];
        foreach ($data['email'] as $email) {
            $email_list[] = ['email' => $email];
        }

        $event->setAttendees($email_list);

        $calendarId = 'primary';

        $event = $service->events->insert($calendarId, $event);
        Log::info("Event created: " . $event->getId());
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
