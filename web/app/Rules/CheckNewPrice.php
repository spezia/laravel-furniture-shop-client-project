<?php

namespace App\Rules;

use App\Repository\ProductRepository;
use Illuminate\Contracts\Validation\Rule;

class CheckNewPrice implements Rule
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
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * 
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $product = $this->productRepository->getById(request()->get('product_id'));

        if ($product->price <= $value) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The discount price is equal or bigger than product price.';
    }
}
