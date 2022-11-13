<?php

namespace App\Exports;

use App\Models\SemanticCoreKey;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View;
use Maatwebsite\Excel\Concerns\FromView;

class SemanticCoreKeysExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $semantic_core_id;

    public function __construct(int $semantic_core_id)
    {
        $this->semantic_core_id = $semantic_core_id;
    }

    public function view(): \Illuminate\Contracts\View\View
    {

       $semantic_core_to_view = SemanticCoreKey::WHERE("semantic_core_id",$this->semantic_core_id)->get();

        return view("export.export_semantic_key",
       [
           'SemanticCoreKeys' => $semantic_core_to_view
       ]);
    }
}
