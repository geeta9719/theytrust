<?php

namespace App\Imports;

use App\Models\Seo;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportSeo implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $newSeo = [
            'name' => $row[0],
            'usage_count' => $row[1],
            'url' => $row[2],
        ];
        $existingSeo = Seo::where('name', $newSeo['name'])
                        ->where('url', $newSeo['url'])
                        ->first();
        if (!$existingSeo) {
            // Record does not exist, create a new one
            Seo::create($newSeo);
        }
    }
}
