<?php

namespace App\Http\Requests;

use App\Repository\ProductRepository;
use App\Rules\CheckNewPrice;
use Illuminate\Foundation\Http\FormRequest;

class ProductDiscountRequest extends FormRequest
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * Create a new rule instance.
     * 
     * @param ProductRepository $productRepository
     *
     * @return void
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id',
            'new_price' => ['required', new CheckNewPrice($this->productRepository)],
            'from' => 'required|date_format:d.m.Y',
            'to' => 'required|date_format:d.m.Y',
        ];
    }
}
