<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;


class UserService extends Model
{
    use HasFactory;

    public static function getAll(){
        $users = DB::table('users')->get();
        return $users;
    }

    public static function getOne($id){
        $user = DB::table('users')->where('id', $id)->first();
        return $user;
    }

    public static function getOneByEmail($email){
        $user = DB::table('users')->where('email', $email)->first();
        if($user){
            return $user->id;
        } else {
            return false;
        }
    }

    public static function new($posted_data){
        $input_array = collect($posted_data)->except(['_token', 'image']);       

        if(isset($posted_data['image']))
        {
            $image = $posted_data['image']->store('img/demo/avatars');
            $array = Arr::add($input_array->toArray(),'image',$image);
        } else {
            $array = $input_array->toArray();
            
        }
        DB::table('users')->insert([$array]);

        $user = DB::table('users')->where('email', $posted_data['email'])->first();
        return $user;
    }

    public static function newFromForm($posted_data){
        DB::table('users')->insert($posted_data);
    }

    public static function upd($id, $posted_data){
        $input_array = collect($posted_data)->except(['_token', 'password2']);
        DB::table('users')
            ->where('id', $id)
            ->update($input_array->toArray());
    }

    public static function upd_status($id, $new_status){
        DB::table('users')
            ->where('id', $id)
            ->update(['status'=>$new_status]);
    }

    public static function upd_media($id, $new_image){
        $user = self::getOne($id);
        $old_image = $user->image;
        unlink($old_image);

        $new_img = $new_image->store('img/demo/avatars');

        DB::table('users')
            ->where('id', $id)
            ->update(['image'=>$new_img]);
    }

    public static function del($id){
        $user = self::getOne($id);
        if($user->image){
            unlink($user->image);
        };
        DB::table('users')->where('id', $id)->delete();
    }

    public static function login_ok($data){
        $user = DB::table('users')->where('email', $data['email'])->first();
        if(isset($user)){
            if($data['password']==$user->password){
                $user_id = self::getOneByEmail($data['email']);
                return $user_id;
            }
        } else {
          return false;  
        }
    }


}
