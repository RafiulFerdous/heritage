<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BidController extends Controller
{

    public function placeBid(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'property_id' => 'required|exists:properties,id',
            'bid_value' => 'required|numeric|min:0',
        ]);


        DB::beginTransaction();

        try {
            $property = Property::findOrFail($request->property_id);

            // Validate that the bid is within the allowed range
            if ($request->bid_value < $property->min_value || $request->bid_value > $property->max_value) {
                return response()->json(['error' => 'Bid value must be within the allowed range.'], 422);
            }

            // Update the bid in the bids table
            $bid = Bid::updateOrCreate(
                [
                    'user_id' => $request->user_id,
                    'property_id' => $request->property_id,
                ],
                [
                    'min_value' => $property->min_value,
                    'max_value' => $request->bid_value,
                ]
            );

            // Update the property max_value if the bid is higher
            if ($request->bid_value > $property->max_value) {
                $property->update(['max_value' => $request->bid_value]);
            }


            DB::commit();

            return response()->json(['success' => 'Bid placed successfully.', 'bid' => $bid], 200);
        } catch (\Exception $e) {

            DB::rollBack();


            Log::error('Bid placement failed: ' . $e->getMessage());

            return response()->json(['error' => 'Failed to place bid. Please try again later.'], 500);
        }
    }
}
