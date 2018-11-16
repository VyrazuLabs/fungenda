<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShareLocation;
use Illuminate\Http\Request;

class SharedLocationController extends Controller
{
    public function getPublicLocation()
    {
        $shared_locations = ShareLocation::where('status', 1)->where('user_id', '=', '')->paginate(10);
        return view('admin.shared_location.list-location', ['shared_locations' => $shared_locations]);
    }

    /* Delete event */
    public function destroy(Request $request)
    {
        $input = $request->input();
        $returnArray = [];

        $locationDetails = ShareLocation::where('shared_location_id', $input['data'])->first();

        if (!empty($locationDetails)) {
            $locationDetails->delete();
            $returnArray = ['success' => 1,
                'error' => 0,
            ];
        } else {
            $returnArray = ['success' => 0,
                'error' => 1,
            ];
        }

        return $returnArray;
    }
}
