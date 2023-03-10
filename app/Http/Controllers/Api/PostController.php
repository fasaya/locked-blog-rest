<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\PostDetailResource;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->category)) {
            $posts = Category::where('slug', $request->category)->first()->posts()
                ->whereStatus(1)->orderBy('published_at', 'DESC')->withCount('passwords')->paginate(10)->withQueryString();
        } else {
            $posts = Post::whereStatus(1)->orderBy('published_at', 'DESC')->withCount('passwords')->paginate(10)->withQueryString();
        }

        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $post = Post::create([
            'user_id' => auth()->guard('api')->user()->id,
            'title' => $input['title'],
            'preview' => $input['preview'] ?? null,
            'content' => $input['content'] ?? null,
            'meta_title' => $input['meta_title'] ?? null,
            'meta_description' => $input['meta_description'] ?? null,
            'published_at' => now(),
        ]);

        return PostResource::make($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {

        $post = Post::whereSlug($id)->withCount('passwords')->first();
        if (!$post) {
            return $this->sendError();
        }

        $is_private = $post->passwords_count > 0 ? true : false;

        $validator = Validator::make($request->all(), [
            'passkey' => $is_private ? 'required' : 'nullable',
        ]);

        $validator->after(function ($validator) use ($is_private, $post, $request) {
            if ($is_private) {
                // match password
                $isPassCorrect = false;
                foreach ($post->passwords as $item) {
                    if (Hash::check($request->passkey, $item->password)) {
                        $isPassCorrect = true;
                    }
                }

                if (!$isPassCorrect) {
                    $validator->errors()->add('passkey', 'The passkey field is incorrect.');
                }
            }
        });

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Forbidden'], 403);
        }

        return PostDetailResource::make($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::whereSlug($id)->first();
        if (!$post) {
            return $this->sendError();
        }

        $input = $request->all();

        $posts = $post->update([
            'title' => $input['title'],
            'preview' => $input['preview'] ?? null,
            'content' => $input['content'] ?? null,
            'meta_title' => $input['meta_title'] ?? null,
            'meta_description' => $input['meta_description'] ?? null,
        ]);

        return $this->sendResponse(Post::find($post->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::whereSlug($id)->first();
        if ($post) {
            $post->delete();
            return $this->sendResponse(null, 'Post deleted');
        }
        return $this->sendError();
    }
}
