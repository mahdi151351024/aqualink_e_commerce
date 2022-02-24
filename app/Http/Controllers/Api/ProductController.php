<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ProductInterface;
use Exception;

class ProductController extends Controller
{
    protected $product_info;

    public function __construct(ProductInterface $product_info)
    {
        $this->product_info = $product_info;
    }

    public function index()
    {
        $response = [];
        try
        {
            $response = $this->product_info->get();
        }
        catch(Exception $e)
        {
            $response = [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
        return response()->json($response);
    }

    public function createProduct(Request $request)
    {
        $request->validate([
            'product_title' => 'required',
            'price' => 'required|numeric',
            'description' => 'required'
        ]);
        $response = [];
        try
        {
            $response = $this->product_info->create($request->all());
        }
        catch(Exception $e)
        {
            $response = [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
        return response()->json($response);
    }

    public function updateProduct(Request $request)
    {
        $response = [];
        try
        {
            $response = $this->product_info->update($request->all());
        }
        catch(Exception $e)
        {
            $response = [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
        return response()->json($response);
    }

    public function deleteProduct($id)
    {
        $response = [];
        try
        {
            $response = $this->product_info->delete($id);
        }
        catch(Exception $e)
        {
            $response = [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
        return response()->json($response);
    }

    public function searchProduct($title)
    {
        $response = [];
        try
        {
            $response = $this->product_info->search($title);
        }
        catch(Exception $e)
        {
            $response = [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
        return response()->json($response);
    }
}
