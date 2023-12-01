<?php

namespace App\Exports;

use App\Models\Seo;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportSeo implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
        return Seo::select('name','usage_count','ubcategory_id')->get(); 
    }
}
