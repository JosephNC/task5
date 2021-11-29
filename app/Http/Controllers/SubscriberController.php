<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    /**
     * Subscribe a user
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $website = $this->createModalWithController($request, new WebsiteController);
        if (!$website->success) return response()->json((array) $website);

        $user = $this->createModalWithController($request, new UserController);
        if (!$user->success) return response()->json((array) $user);

        // Get the subscriber object
        $subscriber = Subscriber::whereUserId($user->id)->whereWebsiteId($website->id)->first();

        if (!$subscriber) {
            $subscriber = Subscriber::create([
                'user_id'       => $user->id,
                'website_id'    => $website->id
            ]);
        }

        // Response
        return response()->json([
            'success' => true,
            'website' => $request->input('website'),
        ]);
    }

    private function createModalWithController(Request $request, Controller $controller)
    {
        $response = $controller->create($request);
        $website = $response->getData();

        return $website;
    }
}
