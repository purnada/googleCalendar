<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CalendarRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\GoogleCalendar\Event;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calendars = Event::get();
//        return $calendars;
        return view('admin.pages.calendars.index',compact('calendars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.calendars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CalendarRequest $request)
    {
        $event = new Event;

        $event->name = $request->title;
        $event->startDateTime = Carbon::parse($request->start_date);
        $event->endDateTime = Carbon::parse($request->end_date);
        $event->location = $request->location;
        $event->description = $request->description;
        $event->type = 'Office';

        $event->save();
        $notification = Str::toastMsg(config('custom.msg.create'), 'success');

        return redirect()->route('admin.calendars.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($calendar)
    {
        $calendar = Event::find($calendar);


        return view('admin.pages.calendars.edit',compact('calendar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $calendar)
    {


        $event = Event::find($calendar);

        $event->name = $request->title;
        $event->startDateTime = Carbon::parse($request->start_date);
        $event->endDateTime = Carbon::parse($request->end_date);
        $event->location = $request->location;
        $event->description = $request->description;
        $event->type = 'Office';

        $event->save();
        $notification = Str::toastMsg(config('custom.msg.update'), 'success');

        return redirect()->route('admin.calendars.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($calendar)
    {
        $event = Event::find($calendar);

        $event->delete();

        $notification = Str::toastMsg(config('custom.msg.delete'), 'success');
        return response($notification);
    }

    public function embed()
    {
        return view('admin.calendar.view');
    }
}
