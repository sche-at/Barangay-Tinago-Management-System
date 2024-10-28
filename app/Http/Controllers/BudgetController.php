<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\BudgetsDetails;
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
    public function store(Request $request)
    {
        $request->validate([
            'title_plan' => 'required|string|max:255',
        ]);

        // Create a new Blotter entry
        $budget = new Budget();
        $budget->title_plan = $request->title_plan;
        $budget->save();

        return response()->json(['message' => 'Budget Plan Heading saved successfully!']); // Return success message
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

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Example of setting values in different cells
        // Let's say we want 8 empty cells, and then the content in the 9th cell
        
        // Merge cells from A1 to G1
        $sheet->mergeCells('A1:G1');

        $sheet->setCellValue('A1', $budget->title_plan);

        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        // Set other cells as needed
        $sheet->mergeCells('A3:H3');
        $sheet->setCellValue('A3', 'Estimated Income');
        $sheet->getStyle('A3:H3')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->setCellValue('I3', 'Amount');
        $sheet->getStyle('I3')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // For loop for Estimate Income
        $estimateIncome = 1;
        for($x=4;$x<=13;$x++){
            $sheet->mergeCells('B'.$x.':H'.$x);
            $sheet->setCellValue('A'.$x, $estimateIncome);
            $sheet->getStyle('A'.$x)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $sheet->getStyle('B'.$x.':I'.$x)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $estimateIncome++;
        }
        $sheet->mergeCells('A14:H14');
        $sheet->setCellValue('A14', 'NET AVAILABLE RESOURCES FOR APPROPRIATION  TOTAL');
        $sheet->setCellValue('I14', '=SUM(I4:I13)');
        $sheet->getStyle('A14:I14')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // For Expendetures
        $sheet->mergeCells('A16:I16');
        $sheet->setCellValue('A16', 'EXPENDITURES:');
        $sheet->getStyle('A16:I16')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        $sheet->setCellValue('A17', 'a.');
        $sheet->mergeCells('B17:H17');
        $sheet->setCellValue('B17', 'CURRENT OPERATING EXPENDITURES');
        $sheet->setCellValue('I17', 'Amount');
        $sheet->getStyle('A17:I17')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $expendetures = 1;
        for($x=18;$x<=27;$x++){
            $sheet->mergeCells('B'.$x.':H'.$x);
            $sheet->setCellValue('A'.$x, $expendetures);
            $sheet->getStyle('A'.$x)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $sheet->getStyle('B'.$x.':I'.$x)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $expendetures++;
        }
        $sheet->mergeCells('A28:H28');
        $sheet->setCellValue('A28', 'NET AVAILABLE RESOURCES FOR CY 2023 TOTAL');
        $sheet->setCellValue('I28', '=SUM(I18:I27)');
        $sheet->getStyle('A28:I28')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // For MAINTENANCE AND OTHER OPERATING EXPENSES
        $sheet->mergeCells('A29:I29');
        $sheet->setCellValue('A29', 'MAINTENANCE AND OTHER OPERATING EXPENSES:');
        $sheet->setCellValue('I29', 'Amount');
        $sheet->getStyle('A29:I29')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $expenses = 1;
        for($x=30;$x<=53;$x++){
            $sheet->mergeCells('B'.$x.':H'.$x);
            $sheet->setCellValue('A'.$x, $expenses);
            $sheet->getStyle('A'.$x)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $sheet->getStyle('B'.$x.':I'.$x)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $expenses++;
        }
        $sheet->mergeCells('A54:I54');
        $sheet->setCellValue('A54', 'CULTURAL ACTIVITIES AND OTHER RELATED ACTIVITIES');
        $sheet->getStyle('A54:I54')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $activities = 25;
        for($x=55;$x<=60;$x++){
            $sheet->mergeCells('B'.$x.':H'.$x);
            $sheet->setCellValue('A'.$x, $activities);
            $sheet->getStyle('A'.$x)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $sheet->getStyle('B'.$x.':I'.$x)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $activities++;
        }
        $sheet->mergeCells('A61:H61');
        $sheet->setCellValue('A61', 'TOTAL');
        $sheet->setCellValue('I61', '=SUM(I30:I60)');
        $sheet->getStyle('A61:I61')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // For NON-OFFICE EXPENDITURES
        $sheet->mergeCells('A63:I63');
        $sheet->setCellValue('A63', 'NON-OFFICE EXPENDITURES');
        $sheet->getStyle('A63:I63')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $nonOffices = 1;
        for($x=64;$x<=68;$x++){
            $sheet->mergeCells('B'.$x.':H'.$x);
            $sheet->setCellValue('A'.$x, $nonOffices);
            $sheet->getStyle('A'.$x)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $sheet->getStyle('B'.$x.':I'.$x)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $nonOffices++;
        }
        $sheet->mergeCells('A69:H69');
        $sheet->setCellValue('A69', 'TOTAL');
        $sheet->setCellValue('I69', '=SUM(I64:I68)');
        $sheet->getStyle('A69:I69')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // For Grand Total
        $sheet->mergeCells('A80:H80');
        $sheet->setCellValue('A80', 'GRAND TOTAL');
        $sheet->setCellValue('I80', '=SUM(I14:I28:I61:I69)');
        $sheet->getStyle('A80:I80')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // Save as a .xlsx file
        $writer = new Xlsx($spreadsheet);
        
        // Streamed response to download the file directly
        return new StreamedResponse(function() use ($writer) {
            // Send the file to the browser as a download
            $writer->save('php://output');
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="export.xlsx"',
        ]);
    }
}
