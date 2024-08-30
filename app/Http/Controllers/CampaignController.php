<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Jobs\ProcessCampaign;
use Illuminate\Support\Facades\ { Storage, Redirect };
use Inertia\Inertia;

class CampaignController extends Controller
{
    public function index(Request $request): \Inertia\Response
    {
        $campaigns = Campaign::paginate(10); // Fetch campaigns with pagination
        return Inertia::render('Campaigns/Index', [
            'campaigns' => $campaigns,
        ]);
    }

    public function addCampaign(): \Inertia\Response
    {
        return Inertia::render('Campaigns/Add');
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse | \Illuminate\Http\RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $file = $request->file('csv_file');

        $path = $request->file('csv_file')->storeAs('campaigns', $file->getClientOriginalName().time().'.'. $file->getClientOriginalExtension());

        $campaign = Campaign::create([
            'user_id' => $request->user()->id,
            'name' => $request->name,
            'csv_file' => $path,
            'status' => 'pending',
        ]);

        // Dispatch job to process campaign (this is a placeholder)
        ProcessCampaign::dispatch($campaign, $request->user());
        return Redirect::route('campaigns.index');
    }
}
