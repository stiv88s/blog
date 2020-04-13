<?php

namespace App\ModelRepository;

use App\Model\Admin;
use App\Model\Post;
use Illuminate\Support\Facades\DB;

class PostRepository extends Repository
{

    public function getEntity()
    {
        return Post::class;

    }

    public function active()
    {
        return $this->getEntity()::where('is_active', 1);
    }

    public function paginate($limit = 5)
    {

        $q = $this->getEntity()::where('is_active', 1);

        return $q->paginate($limit);

    }

    public function filter()
    {
        DB::connection()->enableQueryLog();
        $q = $this->getEntity()::where('is_active', 1);

//        $fil = ['subtitle'=>'eu','slug'=>'uk','slug'=>'ukraine'];


        $values = ['user_id'=>[1],'slug'=>['uk','ukraine']];



//        $q->whereIn('subtitle', [0=>'eu']);
//
//        $q->whereIn('slug', [0=>'uk',1=>'ukraine']);
//
//        $s=$q->get();
//
//        dd($s);


//$q->whereIn('subtitle',['eu']);
//
//$s=$q->get();
//dd($s);
//        dd($values);

foreach($values as $key=>$value){

                $q->whereIn($key, $value);

}
//        foreach($fil as $key=> $val){
//
//            $q->whereIn($key, [$val]);
//        }

//        dd($q->get());
        $s=$q->get();
        dd($s);
        $queries = DB::getQueryLog();
        dd($queries);
//        dd('sto');
    }
}
