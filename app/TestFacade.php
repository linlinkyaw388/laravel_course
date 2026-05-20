
<?php


// namespace APP;
// namespace App;


use Illuminate\Support\Facades\Facade;
use App\Test;

class TestFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'test';          //implict binding
        // return Test::class;  explicit binding        contractor / prara မရှိရင် သုံးလို့ရ။
    }
    
}