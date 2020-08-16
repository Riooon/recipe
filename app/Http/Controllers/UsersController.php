<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Recipe;
use App\Process;
use App\Ingredient;
use Validator;

class UsersController extends Controller
{
    //
     public function destroy(User $user){
        $recipes = Recipe::where('user_id',$user->id)->get();
        foreach ($recipes as $recipe){
            $ingredient = Ingredient::where('recipe_id',$recipe->id)->delete();
            $processes = Process::where('recipe_id',$recipe->id)->get();
            foreach ($processes as $process){
                $process->delete();
            }
            $recipe->delete();
        }
        $user->delete();
        return redirect('/');
    }

    public function userpage(User $user){
        $recipes = Recipe::join('users', 'recipes.user_id', '=', 'users.id')
        ->orderBy('recipes.created_at', 'desc')
        ->where('user_id', $user->id)
        ->select('recipes.id', 'recipes.title', 'recipes.hd_img', 'users.name')
        ->get();
        return view('userpage', compact('recipes', 'user'));
    }

    public function useredit(User $user){
        return view('useredit', compact('user'));
    }

    public function update(Request $request){
        $users = User::find($request->id);
        if(!$request->name==NULL){
            $users->name = $request->name;
        }
        if(!$request->file('icon')==NULL){
            Storage::delete('public/img/'.$request->icon);
            $path = $request->file('icon')->store('public/img');
            $users->icon = basename($path);
        }
        if(!$request->email==NULL){
            $users->email = $request->email;
        }
        if(!$request->password==NULL){
            $users->password = $request->password;
        }
        $users->save(); 
        return redirect('userpage/'.$request->id);
    }
}