<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seo;
use App\Imports\ImportSeo;
use App\Exports\ExportSeo;
use Maatwebsite\Excel\Facades\Excel;


class SeosearchController extends Controller
{
    public function index()
    {
        $seo = seo::all();
        return view('search.index',compact('seo'));
    }
    public function show($id)
    {
        $seo = seo::find($id);
    return view('search.show', compact('seo'));
        
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'Name' => 'required',
            'usage_count' => 'required',
           
        ]);

        $seo = Seo::findOrFail($id);
    
    
        $seo->update([
            'Name' => $request->input('Name'),
            'usage_count' => $request->input('usage_count'),
            
        ]);

    return redirect('/seo')->with('success', 'SEO data updated successfully.');
    }   

   
    public function destroy($id)
    {
          $data =  Seo::findOrFail($id)->delete();
          return redirect()->route('admin.seo-search')->with('success', 'SEO item deleted successfully!');

         
    }

    public function showForm()
    {
        return view('upload_seo_excel');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls|max:2048',
        ]);
        $file = $request->file('excel_file');
        Excel::import(new SeoImport, $file);
        return redirect('/upload-seo-excel')->with('success', 'SEO data imported successfully.');
    }

    public function importView(Request $request){
        return view('search.index');
    }
 
    
    public function import(Request $request)
    {
        if ($request->hasFile('file')) {
            Excel::import(new ImportSeo, $request->file('file')->store('files'));
        }
    
        return redirect()->back();
    }
    public function exportSeo(Request $request){
        return Excel::download(new ExportSeo, 'seo.xlsx');
    }
}

