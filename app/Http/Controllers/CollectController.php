<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\Don;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Symfony\Component\HttpFoundation\Response;

class CollectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        $userId = Auth::id();
        $collections = Collection::where('user_id', $userId)->get();

        return view('Associationspace.collection.index', compact('collections'));
    }
    public function generatePDF()
    {
        $userId = Auth::id();
        $collections = Collection::where('user_id', $userId)->get();
    
        $data = [
            'title' => 'User Collections Report',
            'date' => date('m/d/Y'),
            'collections' => $collections
        ];
    
        $pdf = PDF::loadView('Associationspace.Collection.myPDF', $data);
    
        return $pdf->download('collections_report.pdf');
    }

    public function export()
    {
        $userId = Auth::id();
        $collections = Collection::where('user_id', $userId)->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Date Collecte');
        $sheet->setCellValue('C1', 'User ID');
        $sheet->setCellValue('D1', 'État');
        $sheet->setCellValue('E1', 'Created At');
        $sheet->setCellValue('F1', 'Updated At');

       
        $row = 2;
        foreach ($collections as $collection) {
            $sheet->setCellValue('A' . $row, $collection->id);
            $sheet->setCellValue('B' . $row, $collection->dateCollecte);
            $sheet->setCellValue('C' . $row, $collection->user_id);
            $sheet->setCellValue('D' . $row, $collection->etat);
            $sheet->setCellValue('E' . $row, $collection->created_at);
            $sheet->setCellValue('F' . $row, $collection->updated_at);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'collections.xlsx';
        $filePath = public_path($fileName);
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
    

    public function generateQRCode($id)
    {
        $collection = Collection::findOrFail($id);
        $qrCode = new QrCode($collection->id); 

        $qrCode->setSize(300);
        $qrCode->setMargin(10);

        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        return new Response($result->getString(), 200, [
            'Content-Type' => $result->getMimeType(),
            'Content-Disposition' => 'inline; filename="qrcode.png"',
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dons = Don::whereDoesntHave('collection')->get();
        return view('Associationspace.collection.create',compact('dons'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {$request->validate([
       
        'etat' => 'required|string',
        'dateCollecte' => 'required|date',
    ]);
    $userId = Auth::id();

    $collection = Collection::create(
        $request->only('dateCollecte', 'etat') + ['user_id' =>$userId]
    );
    
    Don::whereIn('id', $request->dons)->update(['collection_id' => $collection->id]);

    return redirect()->route('collect.index')->with('success', 'Collection created successfully.');    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $collection = Collection::findOrFail($id);
        return view('Associationspace.collection.edit', compact('collection'));    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
       
            'etat' => 'required|string',
            'dateCollecte' => 'required|date',
        ]);

        $collect = Collection::findOrFail($id);
        $collect->update($request->all());

        return redirect()->route('collect.index')->with('success', 'collection modifié avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        
        $collection = Collection::findOrFail($id);
        $collection->delete();
        return redirect()->route('collect.index')->with('success', 'collection supprimé avec succès!');
    
    }
}
