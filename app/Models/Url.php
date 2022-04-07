<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\CodeGenerator;

class Url extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'user_id',
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function short_url(string $long_url)
    {
        $url = self::create([
            'url' => $long_url,
            'user_id' => auth()->id(),
        ]);

        $code = (new CodeGenerator())->get_code($url->id);

        $url->code = $code;

        $url->save();

        return $url->code;
    }
}
