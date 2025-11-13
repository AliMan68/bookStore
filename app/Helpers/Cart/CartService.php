<?php


namespace App\Helpers\Cart;


use Illuminate\Database\Eloquent\Model;

class CartService
{
    protected $cart;
    public function __construct()
    {
        $this->cart = session()->get('cart') ?? collect([]);

    }

    //insert item to cart
    public function put(array $value , $object = null){

        if (!is_null($object) && $object instanceof \Illuminate\Database\Eloquent\Model) {
            //merge item it self with additional value --mean may be we have book our product in out cart
            $value = array_merge($value, [
//                'id' => \Illuminate\Support\Str::random(2),
                'id' => rand(10000,99999),
                'subject_id' => $object->id,
                'subject_type' => get_class($object)
            ]);
        }elseif (! isset($value['id'])){
            $value = array_merge($value, [
                'id' => rand(10000,99999),
//                'id' => \Illuminate\Support\Str::random(10),
            ]);
        }

        $this->cart->put($value['id'],$value);
        session()->put('cart',$this->cart);
        return $this;

    }

    //check if items is in our cart or not
    public function has($value){
        //check if value is object or ID
        if ($value instanceof Model)

//            dd(is_null($this->cart->where('subject_id',$value->id)->where('subject_type',get_class($value))->first()));
//            dd(is_null($this->cart->where('subject_id',$value->id)));
            return ! is_null($this->cart->where('subject_id',$value->id)->where('subject_type',get_class($value))->first());
        return ! is_null($this->cart->where('id',$value)->first());
    }

    //return items by value

    public function get($value,$withRelation = false){
        // here we find item if it is an object or an String and return it

        $item = $value instanceof Model ? $this->cart->where('subject_id',$value->id)->where('subject_type',get_class($value))->first() : $this->cart->where('id',$value)->first();
        return $withRelation ? $this->withRelationIfExist($item) : $item;
    }

    //find product by relations we inserted and add it to item
    protected function withRelationIfExist($item){

        //check if we have An relation
        //use subject_type to create class of item
        if (isset($item['subject_id']) && isset($item['subject_type'])){
            $className = $item['subject_type'];
            $subject = (new $className())->find($item['subject_id']);
            $item[strtolower(class_basename($className))] = $subject;
            unset($item['subject_id']);
            unset($item['subject_type']);
            return $item;
        }
        return $item;

    }
    public function all(){

        $cart = $this->cart;
        $cart = $cart->map(function ($item){
            return $this->withRelationIfExist($item);
        });
        return $cart;
    }
    public function isEmpty(){
        $cart = $this->cart;
        return $cart->isEmpty() ? true : false;
    }



//return total items price
    public function totalPrice(){
        $postPrice = \App\Models\Setting::latest()->first()->post_price ?? 0;
        $cart = $this->cart;
        $cart = $cart->map(function ($item){
            return $this->withRelationIfExist($item);
        });
        $totalPrice = $cart->sum(function ($item){
            return $item['quantity'] * ($item['book']->price - (($item['book']->price * $item['book']->discount_percent/100)));
        });
        return $totalPrice + $postPrice;

    }



    public function update($key,$option){
        $item = collect($this->get($key,false));
        if (!is_null($item)){
            if (is_array($option)){
                $item = $item->merge([
                    'quantity'=>$option['type'] == 'add' ? $item['quantity'] + $option['quantity'] : $item['quantity'] - $option['quantity']
                ]);
            }
            $this->put($item->toArray());

            return $this;
        }else{
            return back()->with('error','بروزرسانی ناموفق!کتاب مورد نظر در سبد خرید موجود نیست ');
        }

    }

    public function delete($key){
        if ($this->has($key)){

            $this->cart = $this->cart->filter(function ($item) use($key){
                if ($key instanceof Model){
                    return ($item['subject_id'] != $key->id) && ($item['subject_type'] != get_class($key));
                }else{
                    return $item['id'] != $key;
                }

            });
            session()->put('cart',$this->cart);
            return true;

        }
        return false;
    }

    public function flush(){
        $this->cart = collect([]);
        session()->put('cart',$this->cart);
    }


}
