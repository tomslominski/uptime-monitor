<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Spatie\UptimeMonitor\Models\Monitor;

/**
 * Controller for handling all of the site functions.
 *
 * @package App\Http\Controllers
 */
class SiteController extends Controller
{
	/**
	 * Register auth middleware.
	 */
	public function __construct() {
		$this->middleware('auth.basic');
	}

    /**
     * Display a listing of uptime monitors.
     *
     * @return View
     */
    public function index()
    {
    	$sites = Monitor::all();

    	// return response($monitors);
        return view('index', compact('sites'));
    }

    /**
     * Show the form for creating a new site monitor.
     *
     * @return View
     */
    public function create()
    {
    	return view('edit');
	}

    /**
     * Store a newly created site monitor in database.
     *
     * @param Request $request
     * @return Redirector
     */
    public function store(Request $request)
    {
    	request()->validate([
    		'url' => 'required|unique:monitors|max:1000',
		]);

    	$monitor = new Monitor();
    	$monitor->url = request('url');
    	$monitor->save();

		return redirect(route('viewSites'));
	}

    /**
     * Show the form for editing the specified site monitor.
     *
     * @param Monitor $site
     * @return Response
     */
    public function edit(Monitor $site)
    {}

    /**
     * Update the specified site monitor in storage.
     *
     * @param Request $request
     * @param Monitor $site
     * @return Response
     */
    public function update(Request $request, Monitor $site)
    {}

    /**
     * Remove the specified site monitor from storage.
     *
     * @param Monitor $site
     * @return Response
     */
    public function destroy(Monitor $site)
    {}
}
