<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class LocationController extends Controller
{
    public function checkOfficeArea(Request $request)
    {
        // Device's current location (from browser or app)
        $deviceLat = $request->lat;
        $deviceLon = $request->lon;

        // 🔹 Office polygon (your coordinates)
        $officePolygon = [
            [28.616309072576477, 77.3858238087516], // A (Top-Left)
            [28.6162878814602, 77.38612891003241],  // B (Top-Right)
            [28.615919390809303, 77.38606319591038], // C (Bottom-Right)
            [28.615946468441027, 77.38584526642408] // D (Bottom-Left)
        ];

        // Check using helper function
        $inside = $this->isPointInPolygon($deviceLat, $deviceLon, $officePolygon);
        return response()->json([
            'inside_office' => $inside,
            'message' => $inside ? '✅ Device is inside the office area' : '❌ Device is outside the office area. If location is on, please change your internet connection or reconnect network.',
        ])->withCookie(cookie('verify_location', Crypt::encrypt($inside ? "device_is_inside_the_office_area" : "device_is_outside_the_office_area"), 30));
    }

    // 🔹 Point-in-Polygon check (Ray Casting Algorithm)
    private function isPointInPolygon($lat, $lon, $polygon)
    {
        $inside = false;
        $x = $lon;
        $y = $lat;
        $n = count($polygon);

        for ($i = 0, $j = $n - 1; $i < $n; $j = $i++) {
            $xi = $polygon[$i][1];
            $yi = $polygon[$i][0];
            $xj = $polygon[$j][1];
            $yj = $polygon[$j][0];

            $intersect = (($yi > $y) != ($yj > $y)) &&
                ($x < ($xj - $xi) * ($y - $yi) / ($yj - $yi) + $xi);
            if ($intersect) $inside = !$inside;
        }

        return $inside;
    }
}
