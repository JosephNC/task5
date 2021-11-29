<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WebsiteController extends Controller
{
    /**
     * Creates a website
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request = $this->sanitize($request);

        $validator = Validator::make($request->all(), [
            'website' => 'required|string',
        ]);

        // Validate request
        if ($validator->fails()) {
            // Failed
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all()
            ]);
        }

        // Create the website
        $url = $request->input('website');
        $website = Website::firstOrCreate(compact('url'));

        // Response
        return response()->json([
            'success' => true,
            'id' => $website->id,
        ]);
    }


    /**
     * Sanitize the url, remove scheme and "www."
     * from the request object
     * 
     * @return \Illuminate\Http\Request
     */
    private function sanitize(Request $request)
    {
        $fields = $request->all();

        foreach ($fields as $field => &$value) {
            if ($field != 'website') continue;

            // Remove protocol
            $value = preg_replace('(^https?://)', '', $value);

            // Remove www
            $value = ltrim($value, 'www.');

            // Remove trailing slash
            $value = rtrim($value, '/');
        }

        $request->replace($fields);

        return $request;
    }
}
