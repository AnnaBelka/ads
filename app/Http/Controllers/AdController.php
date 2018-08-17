<?php

namespace App\Http\Controllers;
use App\User;
use App\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdController extends Controller
{
    protected $ads;

    /**
     * Create a new controller instance.
     *
     * @param  AdsRepository  $ads
     * @return void
     */

    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Display a list of all of the user's ad.
     *
     * @param  Request  $request
     * @return Response
     */

    public function index(Request $request)
    {

        $ads = DB::table('ads')
            ->join('users', 'users.id', '=', 'ads.user_id')
            ->select('ads.*', 'users.name as user_name')
            ->paginate(5);

        return view('ads.index', [
            'ads' => $ads,
        ]);
    }

    public function edit(Request $request) {
        return view('ads.create');
    }

    /**
     * Create a new ad.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required'
        ]);

        $ad = $request->user()->ads()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect('/'.$ad->id);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param  Ad  $ad
     * @return Response
     */

    public function show($id)
    {
        $ad = Ad::findOrFail($id);
        $author = User::findOrFail($ad->user_id);
        return view('ads.show', compact('ad', 'author'));
    }

    public function change($id)
    {
        $ad = Ad::findOrFail($id);
        return view('ads.edit', compact('ad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */

    public function update(Request $request, $id)
    {
        $ad = Ad::findOrFail($id);

        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required'
        ]);

        $input = $request->all();

        $ad->fill($input)->save();
        return redirect('/'.$id);

    }

    /**
     * Destroy the given ad.
     *
     * @param  Request  $request
     * @param  Ad  $ad
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $ad = Ad::findOrFail($id);
        $this->authorize('destroy', $ad);

        $ad->delete();

        return redirect('/');
    }
}
