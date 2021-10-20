<?php

namespace App\Classes;

use Illuminate\Support\Collection;
use App\Models\Vehicle;

class Cart
{  
    private $vehicles;

    private function load(){
        if(!session()->has('vehicles')):
            session(['vehicles' => collect()]);
        endif;

        $this->vehicles = session('vehicles');
    }

    // ADD VEHICLE
    public function add(Vehicle $vehicle){
        $this->load();
        $v = $this->vehicles->get($vehicle->id);

        if(is_null($v)):
            $this->vehicles->put($vehicle->id, ['vehicle' => $vehicle, 'quantity' => 1, 'price' => $vehicle->price]);
        else:
            $this->set($v['vehicle'], ++$v['quantity'], $v['price']);
        endif;

        session(['vehicles' => $this->vehicles]);
    }

    // SET VEHICLE
    public function set(Vehicle $vehicle, int $quantity, float $price){
        $this->load();
        $v = $this->vehicles->get($vehicle->id);

        if(!is_null($v)):
            $v['quantity'] = ($quantity > 0 && $quantity <= $v['vehicle']->quantity) ? $quantity : $v['vehicle']->quantity;
            $v['price'] = $price;
            $this->vehicles->put($vehicle->id, $v);
        endif;

        session(['vehicles' => $this->vehicles]);
    }

    // REMOVE VEHICLE
    public function remove(int $index){
        $this->load();
        $this->vehicles->forget($index);

        session(['vehicles' => $this->vehicles]);
    }

    // CLEAR CART
    public function clear(){
        $this->load();
        $this->vehicles = collect();
        
        session(['vehicles' => $this->vehicles]);
    }

    // RETURN ELEMENTS
    public function all(){
        $this->load();
        return $this->vehicles->all();
    }

    // RETURN AMOUNT QUANTITY
    public function amountQuantity(){
        $this->load();
        return $this->vehicles->sum('quantity');
    }

    // RETURN AMOUNT PRICE
    public function amountPrice(){
        $this->load();
        return $this->vehicles->sum('price');
    }

    // RETURN AMOUNT
    public function amount(){
        $this->load();
        return $this->amountQuantity() * $this->amountPrice();
    }
}
