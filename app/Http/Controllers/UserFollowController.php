<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserFollowController extends Controller
{
    /**
     * ユーザをフォローするアクション。
     *
     * @param  $id  相手ユーザのid
     * @return \Illuminate\Http\Response
     */
     public function store($id) {
         // （投稿を所有する）認証済みユーザ（閲覧者）が、 idのユーザをフォローする
         \Auth::user()->follow($id);
         
         // 前のURLへリダイレクトさせる
         return back();
     }
     
     /**
     * ユーザをアンフォローするアクション。
     *
     * @param  $id  相手ユーザのid
     * @return \Illuminate\Http\Response
     */
     public function destroy($id) {
         // 認証済みユーザ（閲覧者）が、 idのユーザをアンフォローする
         \Auth::user()->unfollow($id);
         
         // 前のURLへリダイレクトさせる
         return back();
     }
     
     /**
     * 投稿をお気に入りするアクション。
     */
}
