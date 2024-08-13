<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [ //保存機能
        'title',
        'body',
    ];
    
    public function getPaginateByLimit(int $limit_count = 5){
        //return $this->orderby('updated_at', 'DESC')->limit($limit_count)->get(); //limitで10個とってくるよ　orderby(並び替え)
        //更新日順に->10個とってくるよ
        return $this->orderby('updated_at', 'DESC')->paginate($limit_count); //pagenat版
    }
}

?>

