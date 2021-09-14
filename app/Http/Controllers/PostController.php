<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Events\NewNotification;
use App\Events\NotifyUser;
use App\Events\NotifyUsers;
use App\Http\Requests\InputValidation;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Generator\Method;
use PhpParser\Node\Expr\New_;
use Illuminate\Support\Facades\Http;

use function PHPUnit\Framework\isEmpty;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'pending'])->except('allPosts', 'showPost', 'searchCategory', 'searchTag');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()) {

            $userid = Auth::user('id')->admin_status;
            $pending = Auth::user('id')->pending;

            // return $pending;
            // return $userid;

            // $new = User::find($userid)->where('');
            // $user_Key = $new[0]->admin_status;
            // return $userid;
            // $user_Key = $new[0]->user_id;
            //     //
            //     $posts = User::with('getpost');
            //     return view('user.showall', ['posts' => $posts]);
            //     // return view('user.dash', ['posts' => $posts]);
            if ($pending == 1) {
                return redirect('/pending');
            } elseif ($pending == 0) {
                if ($userid == 1) {
                    $allposts = Post::select('*')->get();
                    // $allposts = Post::simplePaginate(10);
                    $allUsers = User::select('*')->get();
                    $admins = User::where('admin_status', '=', '1')->get();
                    $pending = User::where('pending', '=', '1')->get();

                    return view('admin.dash', ['allposts' => $allposts, 'allUsers' => $allUsers, 'admins' => $admins, 'pending' => $pending]);
                }
            }
        }
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (Auth::user()) {
            $userid = Auth::user('id')->admin_status;
            // $user_id = User::select('id')->where('id', $id);
            $userid = Auth::user();
            $pending = Auth::user('id')->pending;

            if ($pending == 1) {
                return redirect('/pending');
            } elseif ($pending == 0) {
                // $new = User::find($userid)->first()->getPosts;
                // $user_Key = $new[0]->user_id;
                return view('user.newpost');
            }
        } else {
            return redirect('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InputValidation $request)
    {

        // if ((!($_SERVER['REQUEST_METHOD'] == 'post'))) {
        //     return 'errors.404';
        // }
        // if (validator()->fails()) {
        //     return validator()->errors()->first();
        // }
        $file_ext =  $request->file->getClientOriginalExtension();
        $file_name = time() . '.' . $file_ext;
        $path = './images';
        $request->file->move($path, $file_name);
        if (Auth::user()) {

            $request->validated();
            $userid = Auth::user('id')->admin_status;
            $pending = Auth::user('id')->pending;

            if ($pending == 1) {
                return redirect('/pending');
            } elseif ($pending == 0) {

                if ($userid == 1) {

                    $userid = Auth::user()->id;
                    // if (!(Post::where('user_id', $userid)->get())) {
                    //     $new = User::find($userid)->getPosts[0]->user_id;
                    //     return             $new;
                    $new = Post::where('user_id', $userid)->get();
                    $user_Key = Auth::user('id')->id;

                    $post = new Post;
                    $post->user_id = $user_Key;
                    $post->name = $request->name;
                    $post->description = $request->description;
                    $post->tag = $request->tag;
                    $post->category = $request->category;
                    $post->file =  $file_name;
                    $post->save();
                    return redirect('/home')->with($request->session()->flash('success', 'Done'));
                } elseif ($userid == 0) {
                    $userid = Auth::user()->id;
                    if (!(Post::where('user_id', $userid)->get())) {
                        $new = User::find($userid)->getPosts[0]->user_id;
                        return             $new;
                    } else {
                        $post = new Post;
                        $post->user_id = $userid;
                        $post->name = $request->name;
                        $post->description = $request->description;
                        $post->tag = $request->tag;
                        $post->category = $request->category;
                        $post->file =  $file_name;
                        $post->save();
                        return redirect('/show')->with($request->session()->flash('success', 'Done'));
                    }
                    // :   return    $new ? return redirect('user.newpost');

                    // return            $user_Key = $new[0][1]->user_id;


                }
            }
        } else {
            return redirect('/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showMyPosts()
    {
        // if (Auth::user()) {
        //     $userid = Auth::user('id')->admin_status;
        //     $pending = Auth::user('id')->pending;

        //     if ($pending == 1) {
        //         return redirect('/pending');
        //     } elseif ($pending == 0) {

        //         if ($userid == 1) {
        // return
        $user = Auth::user()->id;
        // $new = User::find($user)->first()->getPosts;
        // $new =  DB::table('posts')->where('user_id', $user)->get();
        $new = Post::select('*')->where('user_id', $user)->get();

        return view('user.dash', ['posts' =>  $new]);
        //     } elseif ($userid == 0) {
        //         $user = Auth::user('id')->id;
        //         // return $user;
        //         // $new = Post::Paginate(10);
        //         $new = Post::select('*')->where('user_id', $user)->get();
        //         // $new =  DB::table('posts')->where('user_id', $user) ;

        //         return view('user.dash', ['posts' =>  $new]);
        //     }
        // }
        // }
        // return redirect('login');
    }

    public function allPosts()
    {
        // if (Auth::user()) {
        //     $userid = Auth::user('id')->admin_status;
        //     $pending = Auth::user('id')->pending;

        //     if ($pending == 1) {
        //         return redirect('/pending');
        //     } elseif ($pending == 0) {

        //         if ($userid == 1) {

        // $user = Auth::user()->id;
        // // $new = User::find($user)->first()->getPosts;
        // // $new =  DB::table('posts')->where('user_id', $user)->get();
        // $new = Post::select('*')->where('user_id', $user)->get();
        // $categories = Post::select('category')->where('user_id', $user)->get();
        // $categories = Post::select('tags')->where('user_id', $user)->get();

        // return view('home', [
        //     'posts' =>  $new,
        //     'categories' =>  $categories,

        // ]);
        //         } elseif ($userid == 0) {
        // $user = Auth::user('id')->id;
        // return $user;
        // $new = Post::Paginate(10);
        // $user = Auth::user()->id;
        $new = Post::select('*')->simplePaginate('5');
        $post_comments = Post::with('getComments')->get();
        // return  $post_comments[0]->getComments;
        $categories = Post::select('category')->get();
        $tags = Post::select('tag')->get();
        $comments = Comment::select('*')->get();
        $usercomments =  User::with('getComments')->select('*')->get();
        // return  User::find($user)->getComments;

        // $post_id= ;
        // return $post_comments = Comment::where('post_id',$post_id)->get();
        // return Post::All()->getComments;

        // $new =  DB::table('posts')->where('user_id', $user) ;

        return view('home',  [
            'posts' =>  $new,
            'categories' =>  $categories,
            'tags' =>  $tags,
            'comments' =>  $comments,
            'post_comments' =>  $post_comments,

        ]);
        //         }
        //     }
        // }
        // return redirect('login');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function showPost($postid)
    {
        // $user = Auth::user()->id;
        $new =  Post::findorfail($postid);
        $comments = Comment::select('*')->where('post_id', $postid)->get();
        // $commentswithuser = Comment::with(['getUsers' => function ($q) {
        //     // $q->select('*');
        // }])->All();
        $commentswithuser = Comment::with('getUsers')->where('post_id', $postid)->get();
        // $commentswithuser[0]->getUsers->name;
        // return response()->json($commentswithuser);
        return view('user.showpost', [
            'post' =>  $new,
            'comments' =>  $comments,
            'commentswithuser' =>  $commentswithuser,
        ]);
    }


    public function edit($postid)
    {
        //
        if (Auth::user()) {
            $userid = Auth::user('id')->admin_status;
            $pending = Auth::user('id')->pending;

            if ($pending == 1) {
                return redirect('/pending');
            } elseif ($pending == 0) {
                $post = Post::findorfail($postid);
                return view('user.editpost', ['post' => $post]);
            }
        } else {
            return redirect('login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InputValidation $request, $id)
    {

        $request->validated();
        if (Auth::user()) {
            $userid = Auth::user('id')->admin_status;
            // $id =  Auth::user()->id;
            $pending = Auth::user('id')->pending;

            if ($pending == 1) {
                return redirect('/pending');
            } elseif ($pending == 0) {
                if ($userid == 1) {

                    $userid = Auth::user();
                    if (empty($request->file)) {
                        $old_file = Post::select('file')->where('id', $id)->get()[0]->file;
                        $post = Post::where('id', $id);
                        $post->update([
                            'name' => $request->name,
                            'description' => $request->description,
                            'tag' => $request->tag,
                            'category' => $request->category,
                            'file' => $old_file,

                        ]);
                        return redirect('/home')->with($request->session()->flash('success', 'Done'));
                    }


                    $file_ext =  $request->file->getClientOriginalExtension();
                    $file_name = time() . '.' . $file_ext;
                    $path = './images';
                    $request->file->move($path, $file_name);

                    $post = Post::where('id', $id);
                    $post->update([
                        'name' => $request->name,
                        'description' => $request->description,
                        'tag' => $request->tag,
                        'category' => $request->category,
                        'file' => $file_name,

                    ]);
                    return redirect('/home')->with($request->session()->flash('success', 'Done'));
                } elseif ($userid == 0) {


                    Auth::user()->id;
                    if (empty($request->file)) {
                        $old_file = Post::select('file')->where('id', $id)->get()[0]->file;
                        $post = Post::where('id', $id);
                        $post->update([
                            'name' => $request->name,
                            'description' => $request->description,
                            'tag' => $request->tag,
                            'category' => $request->category,
                            'file' => $old_file,

                        ]);
                        return redirect('/home')->with($request->session()->flash('success', 'Done'));
                    }
                    Auth::user()->id;

                    $file_ext =  $request->file->getClientOriginalExtension();
                    $file_name = time() . '.' . $file_ext;
                    $path = './images';
                    $request->file->move($path, $file_name);

                    $post = Post::where('id', $id);
                    $post->update([
                        'name' => $request->name,
                        'description' => $request->description,
                        'tag' => $request->tag,
                        'category' => $request->category,
                        'file' => $file_name,

                    ]);
                }
                return redirect('/home')->with($request->session()->flash('success', 'Done'));
            };
            // return redirect('/show')->with($request->session()->flash('success', 'Done'));
        }
        // }

        // return redirect('login');
    }
    // $post->name = $request->name;
    // $post->description = $request->description;
    // $post->tag = $request->tag;
    // $post->category = $request->category;
    // $post->save();
    // return redirect('/show');


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if (Auth::user()) {
            $userid = Auth::user('id')->admin_status;
            $pending = Auth::user('id')->pending;

            if ($pending == 1) {
                return redirect('/pending');
            } elseif ($pending == 0) {
                if ($userid == 1) {

                    $userid = Auth::user();
                    $post = Post::where('id', $id);
                    $post->delete();
                    return redirect('/home')->with(['success' => 'Done']);
                } else {
                    $post = Post::where('id', $id);
                    $post->delete();
                    return redirect('/show')->with(['success' => 'Done']);
                }
            }
        } else {
            return redirect('login');
        }
    }
    public function newComment(Request $request)
    {
        // return 's';
        $user_id = Auth::user()->id;
        $post_id = $request->post_id;
        $comment = Comment::create([
            'user_id' => $user_id,
            'post_id' => $post_id,
            'content' => $request->content,

        ]);
        $data = [
            'user_id' => $user_id,
            'user_name'  => Auth::user()->name,
            'content' => $request->content,
            'post_id' => $post_id,
        ];

        Notification::insert($data);
        event(new NotifyUsers($data));
        return back()->with(['success' => 'Comment Done']);
    }
    // public function storeComment()
    // {
    //     return 's';
    // }
    public function editComment($post_id, $comment_id)
    {
        $user = Auth::user()->id;
        $new =  Post::findorfail($post_id);
        $comments = Comment::select('*')->where('post_id', $comment_id)->get();
        // $commentswithuser = Comment::with(['getUsers' => function ($q) {
        //     // $q->select('*');
        // }])->All();
        $commentswithuser = Comment::with('getUsers')->where('post_id', $comment_id)->get();
        $comments_with_user_only = Comment::with('getUsers')->find($comment_id);
        // $commentswithuser[0]->getUsers->name;
        // return response()->json($commentswithuser);
        return view(
            'user.editcomment',
            [
                'post' =>  $new,
                'comments' =>  $comments,
                'commentswithuser' =>  $commentswithuser,
                'comments_with_user_only' =>  $comments_with_user_only,
            ]
        );
    }
    public function updateComment(Request $request, $comment_id)
    {
        $user_id = Auth::user()->id;
        $post_id = $request->post_id;
        // Comment::where('id', $comment_id);
        $comment = Comment::where('id', $comment_id)->update([
            'user_id' => $user_id,
            'post_id' => $post_id,
            'content' => $request->content,

        ]);
        return redirect(('showpost') . '/' . $post_id);

        // return back()->with(['success' => 'Comment Done']);
    }
    public function destroyComment($id)
    {
        $post = Comment::where('id', $id);
        $post->delete();
        return back()->with(['success' => 'Done']);
    }

    public function searchCategory($search)
    {
        // return ($search);
        $post = Post::where('category', $search)->get();
        $post_comments = Post::with('getComments')->get();
        $categories = Post::select('category')->get();
        $tags = Post::select('tag')->get();
        $comments = Comment::select('*')->get();
        $usercomments =  User::with('getComments')->select('*')->get();

        return view('home',  [
            'posts' =>  $post,
            'categories' =>  $categories,
            'tags' =>  $tags,
            'comments' =>  $comments,
            'post_comments' =>  $post_comments,

        ]);
    }
    public function searchTag($search)
    {
        $post = Post::where('tag', $search)->get();
        $post_comments = Post::with('getComments')->get();
        $categories = Post::select('category')->get();
        $tags = Post::select('tag')->get();
        $comments = Comment::select('*')->get();
        $usercomments =  User::with('getComments')->select('*')->get();

        return view('home',  [
            'posts' =>  $post,
            'categories' =>  $categories,
            'tags' =>  $tags,
            'comments' =>  $comments,
            'post_comments' =>  $post_comments,

        ]);
    }
}