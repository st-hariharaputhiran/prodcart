<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImages;
use App\Models\ProductOrders;
use App\Traits\RestControllerTrait;
use Illuminate\Http\Request;

class FOO extends Controller
{
    use RestControllerTrait;
}
class ProductController extends FOO
{
    
    

    
        public $modelClass = Product::class;
        public $messageClass = 'Product';
    
    
    protected function _validation_rules( $request, $id ): array {
        $rules = [
            'product_title' => 'required|unique:products,product_title,' . $id . ',id,deleted_at,NULL',
            'product_description' => 'required',
            'product_slug' => 'required',
            'product_price' => 'required',
        ];

        return $rules;

    }

    protected function _validation_messages(): array {
        return [
            'product_title.required' => 'The Product Title is required.',
            'product_title.unique' => 'The Product Title must be unique.',
            'product_description.required' => 'The Product Description is required',
            'product_slug.required' => 'The Email Subject is required.',
            'product_price.required' => 'The Email Source is required.'
        ];
    }

    protected function _save($request, $model)
    {
        //$data = $request->except(['_token']);
        $model->fill([
            'product_title' => $request->product_title,
            'product_description' => $request->product_description,
            'product_slug' => $request->product_slug,
            'product_price' => $request->product_price,
            'product_status' => $request->product_status
        ]);
        $model->save();
        $files = [];
        if($request->hasfile('image_url'))
         {
            foreach($request->file('image_url') as $file)
            {
                $name = time().rand(1,50).'.'.$file->extension();
                $file->move(public_path('images'), $name);  
                $files[] = new ProductImages( [ 'image_url' => $name] ); 
            }
         }
        $model->productImages()->saveMany( $files );
    }
}
