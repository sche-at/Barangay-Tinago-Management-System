<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\BudgetDetailsValue;
use App\Models\BudgetsDetails;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if($user->user_type == 'captain' || $user->user_type == 'treasurer'){
            $budgets =  Budget::all();
            $budgetDetails = BudgetsDetails::all();
            return view('admin.budgetplan', compact('budgets', 'budgetDetails'));
        }else{
            return redirect(route('dashboard'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //      try{
    //     $request->validate([
    //         'title_plan' => 'required|string|max:255',
    //         'trans_id' => 'required|array',
    //         'trans_details' => 'required|array',
    //         'trans_amt' => 'required|array'
    //     ]);

    //     $request->validate([
    //         'title_plan' => 'required|string|max:255',
    //         'trans_id' => 'required|array',
    //         'trans_details' => 'required|array',
    //         'trans_amt' => 'required|array|min:1',
    //         'trans_amt.*' => 'required|numeric|min:0'
    //     ]);

    //     // Create a new Blotter entry
    //     $budget = new Budget();
    //     $budget->title_plan = $request->title_plan;
    //     $budget->save();

    //     // Loop through each transaction detail and save them
    //     foreach ($request->trans_id as $index => $transId) {
    //         $budgetDetailValue = new BudgetDetailsValue(); // Assuming BudgetDetailsValue is the model name
    //         $budgetDetailValue->budget_header_id = $budget->id; // Link to the main budget entry
    //         $budgetDetailValue->budget_details_id = $transId; // Detail type from `trans_id[]`
    //         $budgetDetailValue->details_value = $request->trans_details[$index];
    //         $budgetDetailValue->amount = $request->trans_amt[$index];
    //         $budgetDetailValue->save();
    //     }

    //     return json_encode($request->all());
    //    // return response()->json(['message' => 'Budget Plan Heading saved successfully!']); // Return success message
    // }catch(Exception $exception){
    //     return $exception;
    // }
    // }


    public function store(Request $request)
    {
        try {
            // Log the incoming request data
            Log::info('Budget creation request data:', $request->all());

            // Validate the request
            $request->validate([
                'title_plan' => 'required|string|max:255',
                'trans_id' => 'required|array',
                'trans_details' => 'required|array',
                'trans_amt' => 'required|array|min:1',
                'trans_amt.*' => 'required|numeric|min:0'
            ]);

            // Start a database transaction
            DB::beginTransaction();
            
            try {
                // Create the main budget record
                $budget = Budget::create([
                    'title_plan' => $request->title_plan
                ]);

                Log::info('Created budget record:', ['budget_id' => $budget->id]);

                // Process each transaction detail
                foreach ($request->trans_id as $index => $budgetDetailsId) {
                    $detailData = [
                        'budget_header_id' => $budget->id,
                        'budget_details_id' => $budgetDetailsId,
                        'details_value' => $request->trans_details[$index],
                        'amount' => $request->trans_amt[$index]
                    ];

                    Log::info('Creating budget detail:', $detailData);
                    
                    BudgetDetailsValue::create($detailData);
                }

                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Budget Plan created successfully',
                    'budget_id' => $budget->id
                ], 200);

            } catch (Exception $e) {
                DB::rollBack();
                Log::error('Error in transaction:', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                throw $e;
            }

        } catch (Exception $e) {
            Log::error('Error creating budget:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error creating budget plan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Budget $budget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Budget $budget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Budget $budget)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $budget = Budget::findOrFail($id);
        $budget->delete();

        return response()->json(['message' => 'Budget Plan Heading deleted successfully!'], 200);
    }

    public function export($id)
    {
        $budget = Budget::findOrFail($id);
        $budgetDetails = BudgetsDetails::all();
        $grandTotal = 0;
        
        // Get current date information
        $currentDate = now();
        $data = [
            'budget' => $budget,
            'budgetDetails' => $budgetDetails,
            'details' => [],
            'grandTotal' => 0,
            'day' => $currentDate->format('jS'),
            'month' => $currentDate->format('F'),
            'year' => $currentDate->format('Y')
        ];
    
        // Process the data similar to your Excel generation
        foreach ($budgetDetails as $budgetDetail) {
            $budgetDetailsVals = BudgetDetailsValue::where('budget_header_id', $budget->id)
                ->where('budget_details_id', $budgetDetail->id)
                ->get();
    
            $sectionTotal = $budgetDetailsVals->sum('amount');
            $grandTotal += $sectionTotal;
    
            $data['details'][] = [
                'title' => $budgetDetail->budget_details,
                'values' => $budgetDetailsVals,
                'sectionTotal' => $sectionTotal
            ];
        }
    
        $data['grandTotal'] = $grandTotal;
    
        return view('budgets.print-excel', $data);
    }
}
