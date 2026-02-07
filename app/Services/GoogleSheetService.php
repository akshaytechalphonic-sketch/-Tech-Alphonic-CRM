<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GoogleSheetService
{



public function fetchSheetWithHeaders(string $sheetUrl): array
{
    // Extract Sheet ID
    preg_match('/\/d\/([a-zA-Z0-9-_]+)/', $sheetUrl, $m);
    if (!isset($m[1])) {
        throw new \Exception("Invalid Google Sheet URL");
    }
    $sheetId = $m[1];

    // Extract GID (sheet tab)
    preg_match('/gid=([0-9]+)/', $sheetUrl, $g);
    $gid = $g[1] ?? 0;


     // 🔹 GET SHEET NAME (TITLE)
    $html = @file_get_contents($sheetUrl);
    preg_match('/<title>(.*?)<\/title>/', $html, $t);

    $sheetName = isset($t[1])
        ? trim(str_replace(' - Google Sheets', '', $t[1]))
        : 'Google Sheet Live Sync';

    // CSV export URL (BEST)
    $csvUrl = "https://docs.google.com/spreadsheets/d/{$sheetId}/export?format=csv&gid={$gid}";

    $response = Http::timeout(15)->get($csvUrl);
    if (!$response->successful()) {
        throw new \Exception("Unable to fetch Google Sheet");
    }

    $lines = array_map("str_getcsv", explode("\n", trim($response->body())));

    if (count($lines) < 1) {
        throw new \Exception("Sheet is empty");
    }

    // ✅ FIRST ROW = HEADERS ONLY
    $headers = array_map('trim', $lines[0]);

    // Remove empty headers
    $headers = array_values(array_filter($headers));

    return [
        "sheet_name" => $sheetName,
        "headers" => $headers,
        "rows"    => array_slice($lines, 1)
    ];
}


}
