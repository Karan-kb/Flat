<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CosineSimilarity extends Model
{
    use HasFactory;
    
    function insertCosineSimilarity($flat1, $flat2, $CosineSimilarity) {
        $now = Carbon::now();

        return DB::table('cosine_similarity')->insertGetId([
            'flat1' => $flat1,
            'flat2' => $flat2,
            'cosine_similarity' => $Cosinesimilarity,
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }

    function getCosineSimilarity($f1, $f2) {
        return DB::table('cosine_similarity')
            ->select('cosine_similarity')
            ->where('flat_1', '=', $f1)
            ->where('flat_2', '=', $f2)
            ->get();
    }
}

