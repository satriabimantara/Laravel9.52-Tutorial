<?php

namespace App\Http\Controllers;

use App\Mail\Blogposted;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get data dummy from file storage
        // $posts = Storage::get('posts.txt');
        // $posts = explode("\n", $posts);

        // get data dummy from Query builder
        // $posts = DB::table('posts')
        //     ->where('active', true)
        //     ->get();

        // Get data from model yang sudah berisi scope <isactive> dan soft deletes

        // $posts = Post::isactive()->withTrashed()->get();
        $posts = Post::isactive()->get();


        $context = [
            'posts' => $posts
        ];
        return view('posts.index', $context);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $context = [
            'form' => [
                'url' => '/posts',
                'method' => 'POST',
            ],
            'button' => [
                'text' => 'Create',
                'class' => 'btn btn-primary'
            ]
        ];
        return view('posts.create', $context);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //ambil input request
        $title_content = $request->input('title-content');
        $body_content = $request->input('body-content');

        // input new data to local storage
        // $posts = Storage::get('posts.txt');
        // $posts = explode("\n", $posts);

        // $new_post = [
        //     count($posts) + 1,
        //     $title_content,
        //     $body_content,
        //     $creator,
        //     date("Y/m/d h:i")
        // ];
        // $new_post = implode('<>', $new_post);
        // array_push($posts, $new_post);

        // $posts = implode("\n", $posts);
        // Storage::write('posts.txt', $posts);

        // input new data using query builder
        // DB::table('posts')->insert([
        //     'title' => $title_content,
        //     'content' => $body_content,
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s'),
        // ]);

        // input new data using Eloquent Model
        // Post::insert([
        //     'title' => $title_content,
        //     'content' => $body_content,
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s'),
        // ]);


        // input new data dengan Eloquent model + event (ganti insert to create)
        $post = Post::create([
            'title' => $title_content,
            'content' => $body_content,
        ]);

        // Send email
        Mail::to(auth()->user()->email)->send(new Blogposted($post));

        // Send notify telegram
        $this->notify_telegram($post);


        return redirect('posts');
    }
    private function notify_telegram(Post $post)
    {
        $api_token = env('TELEGRAM_API_TOKEN', null);
        $chat_id = env('TELEGRAM_CHAT_ID', null);
        $url = "https://api.telegram.org/bot{$api_token}/sendMessage";
        $content = "Ada blog baru nihh: <strong>\"$post->title\"</strong>";
        $data = [
            "chat_id" => $chat_id,
            "text" => $content,
            "parse_mode" => "HTML"
        ];
        Http::post($url, $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get content from local storage
        // $posts = Storage::get('posts.txt');
        // $posts = explode("\n", $posts);
        // foreach ($posts as $post) {
        //     $post = explode("<>", $post);
        //     if ($post[0] == $id) {
        //         break;
        //     }
        // }
        // get content data from Query builder
        // $post = DB::table('posts')->where('id', '=', $id)->first();

        // get content data from model
        $post = Post::where('id', '=', $id)->first();
        $comments = $post->comments()->get();

        $context = [
            'post' => $post,
            'comments' => $comments
        ];
        return view('posts.show', $context);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get data by ID first using Query Builder
        $post = DB::table('posts')
            ->where('id', $id)
            ->first();

        // get data by ID using Eloquent MOdel
        $post = Post::where('id', $id)
            ->first();
        $context = [
            'post' => $post,
            'form' => [
                'url' => "/posts/$post->id",
                'method' => 'PATCH',
            ],
            'button' => [
                'text' => 'Edit',
                'class' => 'btn btn-warning'
            ]
        ];
        return view('posts.edit', $context);
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
        $title_content = $request->input('title-content');
        $body_content = $request->input('body-content');
        // update data using Query builder
        // DB::table('posts')->where('id', "=", $id)->update([
        //     'title' => $title_content,
        //     'content' => $body_content,
        //     'updated_at' => date('Y-m-d H:i:s'),
        // ]);

        // update data using Eloquent Model
        Post::where('id', "=", $id)->update([
            'title' => $title_content,
            'content' => $body_content,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return redirect("posts/$id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete data using Query Builder
        // DB::table('posts')->where('id', '=', $id)->delete();

        // delete data using Eloquent model
        Post::where('id', '=', $id)->delete();

        return redirect('posts');
    }
}
