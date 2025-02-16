<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Level;
use App\Models\MovieGenres;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function discount(){
        Discount::where('endTime', '<', date('Y-m-d'))->update(['status' => false]);
        $discount = Discount::orderBy('id', 'DESC')->Paginate(25);
        
        $levels = Level::all();
        return view('admin.web.discounts.index',[
            'discount'=>$discount,
            'levels' => $levels
        ]);
    }
    public function postCreate(Request $request){
        $request->validate([
            'name'=>'required',
            'code' => 'required|unique:discounts',
            'percent'=>'numeric|min:0|max:100'
        ], [
            'name.required'=>'Please enter name',
            'code.required' => "Please enter code",
            'code.unique' => 'Code exists',
            'percent.max'=>"Maximum discount code is 100",
            'percent.min'=>"Minimum discount code is 0"
        ]);
        $discount = new Discount([
            'name' => $request->name,
            'code' => $request->code,
            'percent' => $request->percent,
            'quantity' => $request->quantity,
            'startTime' => $request->startTime,
            'endTime' => $request->endTime
        ]);
        
        $discount->save();
        $level = Level::find($request->level);
        $discount->level()->attach($level);
        return redirect('admin/discount')->with('success', 'Added Successfully!');
    }

    
    public function postEdit(Request $request,$id){
        $discount = Discount::find($id);
        $request->validate([
            'code' => 'required',
            'percent'=>'numeric|min:0|max:100'
        ], [
            'code.required' => "Please enter code",
            'percent.max'=>"Maximum discount code is 100",
            'percent.min'=>"Minimum discount code is 0"
        ]);
        $discount->update($request->all());
        $discount->level()->detach();
        $level = Level::find($request->level);
        $discount->level()->attach($level);
        return redirect('admin/discount')->with('success', 'Update Successfully!');
    }
    public function delete($id)
    {
        $discount = Discount::find($id);
        if($discount['status'] ==0){
            Discount::destroy($id);
            return response()->json(['success' => 'Delete Successfully']);
        }
        else{
            return response()->json(['error' => "Please change status to offline" ]);
        }
    }
    public function status(Request $request){
        $discount = Discount::find($request->discount_id);
        $discount['status'] = $request->active;
        $discount->save();
        return response('success',200);
    }
}
