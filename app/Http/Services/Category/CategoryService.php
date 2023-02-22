<?php
namespace App\Http\Services\Category;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CategoryService{
    public function handleAdd($request){
        try{
            $create = Category::create([
                'name' => request()->input('name'),
                'alias' => Str::slug(request()->input('alias'),'-'),
                'created_by'=> Auth::id()
            ]);
            session()->flash('success','Saved successfully.');
        }catch(\Exception $err){
            session()->flash('error','Save failed.');
            return false;
        }
        return true;
    }
    public function getCategory($id){
        return Category::where('id','=',$id)->first();
    }
    public function handleEdit($request, $id ){
        try {
            Category::where('id','=',$id)->update([
                'name' => request()->input('name'),
                'alias' => Str::slug(request()->input('alias'),'-'),
                'updated_by'=> Auth::id()
            ]);
            session()->flash('success', 'Saved successfully.');
        } catch (\Exception $err) {
            session()->flash('error', 'Save failed.');
            return  false;
        }
        return  true; 
    }
    public function getCategories(){
        return Category::orderbyDesc('id')->where('del_flg',0);
    }
    public function destroy($request){
        $user= Category::where('id', $request->input('id'));
        if($user){
            $user->update(['deleted_at' => now(),'deleted_by' => Auth::user()->id,'del_flg'=>1 ]);
            return true;
        }else{
            return false;
        }
    }
    
    public function putSession($request){
        $data =[ 
        'id' => $request->input('id'),
        'name' => $request->input('name'),
        'alias' => $request->input('alias'),
        ];
        session()->put('categories_search', $data);
        return session('categories_search');
    }
    public function getCategorySearch($SesionSearch){
        if(!empty($SesionSearch)){
            $categories= Category::query()->where('del_flg',0);
            if (!empty($SesionSearch['id'])) {
                $categories= $categories->where('id', '=',$SesionSearch['id']);
            }
            if (!empty($SesionSearch['name'])) {
                $categories= $categories->where('name', 'LIKE','%'.$SesionSearch['name'].'%');
            }
            if (!empty($SesionSearch['alias'])) {
                $categories= $categories->where('alias', 'LIKE','%'.$SesionSearch['alias'].'%');
            }
            return $categories;
        }
        
    }
}