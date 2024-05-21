<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'title',
        'content'
    ];

    // menambahkan eloquent events
    public static function boot()
    {
        parent::boot();
        static::creating(function ($post) {
            $post->slug = str_replace(' ', '-', $post->title);
        });
    }

    // menambahkan fungsi relasi one to many ke comment
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Scope Model
     * Fungsinya adalah untuk menuliskan query yang sama (berulang) sehingga bisa dijalankan berulang kali tanpa harus mendefinisikannya kembali
     * public function scopeYourscopename($query)
     * untuk memanggil scope ini di model kita tinggal menuliskan <yourscopename> dengan huruf kecil, semisal Post::active()->get();
     */
    public function scopeIsActive($query)
    {
        return $query->where('active', true);
    }
}
