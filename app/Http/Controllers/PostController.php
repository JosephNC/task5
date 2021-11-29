<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Creates a post
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Create Website
        $response = (new WebsiteController)->create($request);
        $website = $response->getData();

        if ( ! $website->success ) return $response;

        // Validate request
        $validator = Validator::make($request->all(), [
            'title'         => [
                'required',
                'max:100',
                Rule::unique(Post::class)->where(fn ($query) =>
                    $query->whereTitle($request->title)->whereWebsiteId($website->id))
            ],
            'description'   => 'required|string',
        ]);

        if ($validator->fails()) {
            // Failed
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all()
            ]);
        }

        // Store post
        $post = Post::create($request->only(['title', 'description']) + [
            'website_id' => $website->id
        ]);

        // Response
        return response()->json([
            'success' => true,
            'id' => $post->id,
        ]);
    }
}
