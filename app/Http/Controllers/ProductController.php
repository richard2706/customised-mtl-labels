<?php

namespace App\Http\Controllers;

use App\Models\ScanHistory;
use Illuminate\Http\Request;
use OpenFoodFacts;

class ProductController extends Controller
{
    /**
     * Display the page for scanning a new product
     */
    public function scan()
    {
        return view('product.scan');
    }

    /**
     * Finds a product given a barcode number, then redirect to show the label.
     */
    public function findProduct(Request $request)
    {
        // validate barcode and check product exists
        $request->validate([
            'barcode' => ['required', 'numeric'],
            'numPortions' => ['nullable', 'numeric', 'gt:0']
        ]);
        $barcode = $request->barcode;
        $numPortions = $request->numPortions;
        return redirect()->route('product.show', compact('barcode', 'numPortions'));
    }
    
    /**
     * Show the page which shows a label for the scanned product, or an error message if the
     * product could not be found.
     */
    public function label($barcode, $numPortions = 1)
    {
        $numPortions = $numPortions > 0 ? $numPortions : 1;
        // Check product exists
        $product = OpenFoodFacts::barcode($barcode);

        $productFound = !empty($product);
        $productName = $productFound ? $product['product_name'] : 'Invalid barcode';

        // Add to scan history
        if ($productFound) {
            // check that product not already most recently scanned (e.g. user just reloading page)
            $historyEntry = ScanHistory::create([
                'barcode' => $barcode,
                'product_name' => $productName
            ]);
        }

        return view('product.show', compact('barcode', 'productFound', 'productName', 'numPortions'));
    }

    // add function for barcode validation and checking product exists
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
