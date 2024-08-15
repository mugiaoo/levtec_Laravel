<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [ //保存機能
        'title',
        'body',
    ];
    
    public function getPaginateByLimit(int $limit_count = 5){
        //return $this->orderby('updated_at', 'DESC')->limit($limit_count)->get(); //limitで10個とってくるよ　orderby(並び替え)
        //更新日順に->10個とってくるよ
        return $this->orderby('updated_at', 'DESC')->paginate($limit_count); //pagenat版
    }
    
    // Categoryに対するリレーション
    //「1対多」の関係なので単数系に
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
?>

