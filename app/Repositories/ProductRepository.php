<?php
namespace App\Repositories;
use App\Models\Product;

class ProductRepository implements ProductInterface {

    public function create(array $data)
    {
        $product = Product::create($data);
        $response = [
            'status' => true,
            'message' => 'Product created successfully',
            'data' => [
                'product' => $product
            ]
        ];
        return $response;
    }

    public function get()
    {
        $products = Product::all();
        $response = [
            'status' => true,
            'message' => 'Data found',
            'data' => [
                'products' => $products
            ]
        ];
        return $response;
    }

    public function update(array $data)
    {
        $product = Product::findOrFail($data['id']);
        $product->update($data);
        $response = [
            'status' => true,
            'message' => 'Product updated successfully',
            'data' => [
                'product' => $product
            ]
        ];
        return $response;
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        $response = [
            'status' => true,
            'message' => 'Product deleted successfully'
        ];
        return $response;
    }

    public function search($title)
    {
        $response = [];
        $products = Product::where('product_title', 'like', '%'.$title.'%')->get();
        if($products->count() > 0)
            $response = [
                'status' => true,
                'message' => 'Data found',
                'data' => [
                    'products' => $products
                ]
            ];
        else
            $response = [
                'status' => false,
                'message' => 'Data not found'
            ];
        return $response;    
    }

}