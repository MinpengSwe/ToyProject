<?php

namespace App;


class Cart
{
    //this class is a simple php class and does not extend eloquent model
    public $items = null; //items is like product names in cart, e.g. Harry Potter1, 2
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if ($oldCart){
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id){
        $storedItem = ['qty' => 0, 'price' => $item->price, 'item'=>$item];
        if($this->items){
            if(array_key_exists($id, $this->items)){
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $storedItem['price']=$storedItem['qty']*$item->price;
        $this->items[$id]=$storedItem;
        $this->totalQty++;
        $this->totalPrice += $item->price;
    }

    public function reduceByone($id){
        $this->items[$id]['qty']--;
        $this->items[$id]['price'] -= $this->items[$id]['item']['price'];
        $this->totalQty--;
        $this->totalPrice -= $this->items[$id]['item']['price'];

        if($this->items[$id]['qty'] <= 0){
            unset($this->items[$id]); //this php function 'unset' destroy specific element in items
        }
    }

    public function removeItem($id){
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }
}
