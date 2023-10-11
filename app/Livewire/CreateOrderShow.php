<?php

namespace App\Livewire;

use Livewire\Component;

class CreateOrderShow extends Component
{
    // Atributes order
    public $total;
    public $date;
    public $paymentMethod;
    public $quantity;
    public $price;

    protected $rules = [
        'total' => 'required',
        'paymentMethod' => 'required',
        'quantity' => 'required',
        'price' => 'required',
    ];

    public function render()
    {
        return view('livewire.create-order-show');
    }
}
