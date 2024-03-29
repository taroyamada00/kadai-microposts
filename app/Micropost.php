<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    //$fillable を設定
    protected $fillable = ['content'];
    
    //この投稿を所有するユーザ。（Userモデルとの関係を定義）
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    //その投稿をお気に入りに追加しているユーザ群の取得を定義
    public function favorite_users() {
        return $this->belongsToMany(User::class, 'favorites', 'micropost_id', 'user_id')->withTimestamps();
    }
}
