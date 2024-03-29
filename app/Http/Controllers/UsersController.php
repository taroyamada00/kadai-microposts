<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User; // 追加

class UsersController extends Controller
{
    public function index()
    {
    //ユーザ一覧をidの降順で取得
    $users = User::orderBy('id','desc')->paginate(10);
    // ユーザ一覧ビューでそれを表示
    return view('users.index', [
        'users' => $users,
    ]);
    }
    
    public function show($id)
    {
    // idの値でユーザを検索して取得
    $user = User::findOrFail($id);
    
    // 関係するモデルの件数をロード
    $user->loadRelationshipCounts();
    
    // ユーザの投稿一覧を作成日時の降順で取得
    $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);
    
    // ユーザ詳細ビューでそれを表示
    return view('users.show', [
            'user' => $user,
            'microposts' => $microposts,
    ]);
    }
    
    /**
     * ユーザのフォロー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
     public function followings($id) {
         // idの値でユーザを検索して取得
         $user = User::findOrFail($id);
         
         // 関係するモデルの件数をロード
         $user->loadRelationshipCounts();
         
         // ユーザのフォロー一覧を取得（1ページ10件。11件目からはページャーが出る）
         $followings = $user->followings()->paginate(10);
         
         // フォロー一覧ビューでそれらを表示
         return view('users.followings', [
            'user' => $user,
            'users' => $followings,
        ]);
     }
     
     /**
     * ユーザのフォロワー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
     public function followers($id) {
         // idの値でユーザを検索して取得
         $user = User::findOrFail($id);
         
         // 関係するモデルの件数をロード
         $user->loadRelationshipCounts();
         
         // ユーザのフォロワー一覧を取得
         $followers = $user->followers()->paginate(10);
         
         // フォロワー一覧ビューでそれらを表示
         return view('users.followers', [
            'user' => $user,
            'users' => $followers,
        ]);
     }
     
     /**
     * ユーザが追加したお気に入り投稿を一覧表示するアクション
     */
    public function favorites($id) {
        
        // idの値で検索して取得
        $user = User::findOrFail($id);
        
        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        // ユーザがお気に入りした投稿一覧を降順で取得
        $microposts = $user->favorites()->orderBy('created_at', 'desc')->paginate(10);
        //dd($favorites);
        // ユーザ詳細ビューでそれを表示
        return view('users.favorites', [
            'user' => $user,
            'microposts' => $microposts,
    ]);
    }
}