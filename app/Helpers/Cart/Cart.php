<?php


namespace App\Helpers\Cart;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * Class Cart
 * @package App\Helpers\Cart
 * @method static bool has($id)
 * @method static integer totalPrice()
 * @method static Collection all()
 * @method static array get($value)
 * @method static Cart put(array $value,Model $object=null)
 */

class Cart extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cart';
    }

}
