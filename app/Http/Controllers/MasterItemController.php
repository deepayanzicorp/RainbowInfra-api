<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Facades
use Str, Validator;
use Carbon;

// Model
use App\Models\MasterItem;

class MasterItemController extends Controller 
{
    // API methods
    public function index(){
        // $records = MasterItem::all();
        $records = MasterItem::where('item_status', 'Active');
        if($records->count() > 0){
            $records = $records->get()->toArray();
            return response()->json(['status' => 200, 'records' => $records], 200);
        }else{
            return response()->json(['status' => 404, 'message' => 'No Records Found'], 404);
        }
    }

    public function store(Request $request){
        $nowTime    = Carbon::now();
        $validator  = Validator::make($request->all(), [
            'item_guid'                 => 'required|string|unique:master_items',
            'item_name'                 => 'required|string',
            'item_group_id'             => 'required|string',
            'item_uom'                  => 'required|string',
            'item_gst_applicable'       => 'required|string',
            'item_gst_type'             => 'required|string',
            'item_gst_rate_guid'        => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 422, 'errors' => $validator->messages()], 422);
        }else{
            $record = MasterItem::create([
                'item_guid'             => $request->item_guid,
                'item_name'             => $request->item_name,
                'item_group_id'         => $request->item_group_id,
                'item_uom'              => $request->item_uom,
                'item_gst_applicable'   => $request->item_gst_applicable,
                'item_gst_type'         => $request->item_gst_type,
                'item_gst_rate_guid'    => $request->item_gst_rate_guid,

                'create_date_time'      => $nowTime,
            ]);

            if($record){
                return response()->json(['status' => 200, 'message' => 'Record Created Successfully'], 200);
            }else{
                return response()->json(['status' => 500, 'message' => 'Something Went Wrong'], 500);
            }
        }
    }

    public function show($id){
        $record = MasterItem::find($id);
        if($record){
            return response()->json(['status' => 200, 'record' => $record], 200);
        }else{
            return response()->json(['status' => 404, 'message' => 'No Such Record Found!'], 404);
        }
    }

    public function edit($id){
        $record = MasterItem::find($id);
        if($record){
            return response()->json(['status' => 200,'record' => $record], 200);
        }else{
            return response()->json(['status' => 404, 'message' => 'No Such Record Found!'], 404);
        } 
    }

    public function update(Request $request, int $id){
        $nowTime    = Carbon::now();
        $validator  = Validator::make($request->all(), [
            'item_guid'                 => 'required|string|unique:master_items,item_guid,' . $id,
            'item_name'                 => 'required|string',
            'item_group_id'             => 'required|string',
            'item_uom'                  => 'required|string',
            'item_gst_applicable'       => 'required|string',
            'item_gst_type'             => 'required|string',
            'item_gst_rate_guid'        => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 422, 'errors' => $validator->messages()], 422);
        }else{
            $record = MasterItem::find($id);
            if($record){
                $record->update([
                    'item_guid'             => $request->item_guid,
                    'item_name'             => $request->item_name,
                    'item_group_id'         => $request->item_group_id,
                    'item_uom'              => $request->item_uom,
                    'item_gst_applicable'   => $request->item_gst_applicable,
                    'item_gst_type'         => $request->item_gst_type,
                    'item_gst_rate_guid'    => $request->item_gst_rate_guid,

                    'modify_date_time'      => $nowTime,
                ]);
                return response()->json(['status' => 200, 'message' => 'Record Updated Successfully'], 200);
            }else{
                return response()->json(['status' => 404, 'message' => 'No Such Record Found!'], 404);
            }
        }
    }

    public function destroy(Request $request, int $id){
        $nowTime= Carbon::now();
        $record = MasterItem::where(array('id' => $id, 'deleted_at' => NULL));
        if($record->count() > 0){
            $record->update([
                'item_status'   => 'Inactive',
                'deleted_at'    => $nowTime
            ]);
            return response()->json(['status' => 200, 'record' => 'Record Deleted Successfully'], 200);
        }else{
            return response()->json(['status' => 404, 'message' => 'No Such Record Found!'], 404);
        } 
    }
    

   /* // Test purpose
    public function test(){
        // Generate a UUID
        $uuid = Str::uuid(); //echo 'uuid -> '. $uuid; die();

        // Generate a unique identifier for your item (e.g., using an incremental value)
        $itemIdentifier = sprintf('%04x', 17); // Replace '206' with your actual item identifier

        // Concatenate the UUID and item identifier
        $itemGuid = $uuid . '-' . $itemIdentifier;

        // Output the generated item GUID
        // dd($itemGuid);
        echo 'UUID -> '. $uuid . '<br> ItemGUid -> '. $itemGuid;
    }*/
}
