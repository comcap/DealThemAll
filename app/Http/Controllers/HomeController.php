<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Comment;
use App\Feed;
use App\Game;
use App\Like;
use App\StatsPlayer;
use App\Team;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()){
            $gameList = Game::get();

            $userRole = UserRole::join('tbl_Role','tbl_Role.role_ID','=','tbl_User_Role.role_ID')
                ->join('tbl_Game','tbl_Game.game_ID','=','tbl_User_Role.game_ID')
                ->where('user_ID','=',Auth::user()->user_ID)
                ->where('stateRole','>',0)
                ->limit(2)
                ->get();

            $countStats= StatsPlayer::where('user_ID','=',Auth::user()->user_ID)->count();

            $feeds = Feed::select('*','tbl_feed.updated_at','tbl_feed.created_at')
                    ->join('tbl_User','tbl_User.user_ID','=','tbl_feed.user_ID')
                    ->join('tbl_Game','tbl_Game.game_ID','=','tbl_feed.game_ID')
                    ->orderBy('tbl_feed.created_at','desc')
                    ->get();

            $asset = Asset::get();

            $result = $feeds->map(function ($item,$key) use ($asset){
                $orders = $asset->filter(function ($value, $key) use ($item){
                    return $value->post_ID == $item->post_ID;
                });

                $item->imagePath = $orders->values();

                return $item;
            });

//            ->join('tbl_asset','tbl_asset.post_ID','=','tbl_feed.post_ID')
//            return $result;
            $listComment = Comment::select('*','tbl_comment.created_at')->join('tbl_User','tbl_User.user_ID','=','tbl_comment.user_ID')
                ->get()->groupBy('post_ID');
            $listComment = ['data'=>$listComment];

            $getLike = Like::select('post_ID',DB::raw('count(post_ID) as total'))->where('state','=',1)->groupBy('post_ID')->get()->keyBy('post_ID');
            $getLike = ['data'=>$getLike];

            $stateLike = Like::select('post_ID','state')->where('user_ID','=',1)->where('state','=',1)->get()->groupBy('post_ID');

//            return $getLike;
            return view('pages.home',compact('stateLike','getLike','listComment','gameList','userRole','countStats','feeds'));
        }else{
            $feeds = Feed::select('*','tbl_feed.updated_at','tbl_feed.created_at')
                ->join('tbl_User','tbl_User.user_ID','=','tbl_feed.user_ID')
                ->join('tbl_Game','tbl_Game.game_ID','=','tbl_feed.game_ID')
                ->orderBy('tbl_feed.created_at','desc')
                ->get();

            $asset = Asset::get();

            $result = $feeds->map(function ($item,$key) use ($asset){
                $orders = $asset->filter(function ($value, $key) use ($item){
                    return $value->post_ID == $item->post_ID;
                });

                $item->imagePath = $orders->values();

                return $item;
            });

            $listComment = Comment::select('*','tbl_comment.created_at')->join('tbl_User','tbl_User.user_ID','=','tbl_comment.user_ID')
                ->get()->groupBy('post_ID');
            $listComment = ['data'=>$listComment];

            $getLike = Like::select('post_ID',DB::raw('count(post_ID) as total'))->where('state','=',1)->groupBy('post_ID')->get()->keyBy('post_ID');
            $getLike = ['data'=>$getLike];



            return view('pages.home',compact('getLike','listComment','feeds'));
        }

    }

    public function store(Request $request){
        if (isset($request)){
            if (isset($text)){
                $postID = $request->postID;
                $text = $request->text;
                $userID = $request->userID;

                $comment = new Comment();
                $comment->user_ID = $userID;
                $comment->post_ID = $postID;
                $comment->textMessage =$text;
                $comment->save();

                $listComment = Comment::select('tbl_comment.post_ID','tbl_User.user_ID','tbl_User.user_image','tbl_User.user_name','tbl_comment.textMessage','tbl_comment.created_at')
                    ->join('tbl_User','tbl_User.user_ID','=','tbl_comment.user_ID')
                    ->where('post_ID','=',$postID)
                    ->get();

                return $listComment;
            }else{
                $postID = $request->postID;
                $userID = $request->userID;

                $getLike = Like::where('post_ID','=',$postID)->where('user_ID','=',$userID)->first();

                if ($getLike == ""){
                    $like = new Like();
                    $like->post_ID = $postID;
                    $like->user_ID = $userID;
                    $like->state = 1;
                    $like->save();
                }else{
                    if ($getLike->state == 0){
                        Like::where('post_ID','=',$postID)->where('user_ID','=',$userID)
                            ->update(['state'=>1]);
                    }else{
                        Like::where('post_ID','=',$postID)->where('user_ID','=',$userID)
                            ->update(['state'=>0]);
                    }
                }

                $countLike = Like::where('post_ID','=',$postID)->where('state','=',1)->get()->count();

                return $countLike;
            }
        }else{
            return "error";
        }
    }
}
