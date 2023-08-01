<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inquiry extends Model
{
    use HasFactory, SoftDeletes;

    // Inquiryモデルにテーブル名とプライマリキーを設定する
    protected $table = 'inquiries';
    protected $primaryKey = 'id';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
