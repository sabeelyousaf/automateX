<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use App\Models\GPT;
use App\Models\Setting;
use App\Models\Tweet;
use Illuminate\Http\Request;
use App\Models\File;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\DB;
use App\Models\Ledger;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Exception\RequestException;
class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Tweet::latest()->paginate(16);
        $dealers=Distributor::all();
        return view('backend_app.files.all_files',compact('data','dealers'));
    }

    public function gpt_file(){
        return view('backend_app.files.add_gpt_file');
    }

    public function store_gpt(Request $request)
    {

            $user = Auth::user();
            $data = new GPT();
            $data->user_id = $user->id;
            $data->text = $request->text; // Assign text from request to Tweet object
            $data->tweet_id = 0; // Assign tweet_id from request to Tweet object
            $data->time = $request->time;
            $data->date = $request->date;
            $data->save();



            return back()->with('success', 'New tweet Topic has been posted successfully');

    }

    public function all_gpts_content(){
        $data=GPT::latest()->paginate(16);
        $dealers=Distributor::all();
        return view('backend_app.files.all_gpt_content',compact('data','dealers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $distributor=Distributor::all();
        return view('backend_app.files.add_file',compact('distributor'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
        {





            // Twitter API base URL
            $baseUrl = 'https://api.twitter.com/2/tweets';

            // Your Twitter API credentials

            $user=Auth::user();

            $key_details=Setting::where('user_id',$user->id)->first();

            $consumerKey = $key_details->consumer_key;
            $consumerSecret = $key_details->consumer_secreat;
            $accessToken = $key_details->consumer_access_token;
            $accessTokenSecret = $key_details->consumer_token_secreat;

            // POST data (text you wish to Tweet)
            $data = [
                'text' => $request->text,
            ];

            // Initialize Guzzle client with OAuth1 authentication
            $stack = HandlerStack::create();
            $middleware = new Oauth1([
                'consumer_key' => $consumerKey,
                'consumer_secret' => $consumerSecret,
                'token' => $accessToken,
                'token_secret' => $accessTokenSecret
            ]);

            $stack->push($middleware);

            $client = new Client([
                'base_uri' => $baseUrl,
                'handler' => $stack,
                'auth' => 'oauth'
            ]);

            try {
                // Make the POST request
                $response = $client->post('', [
                    'json' => $data
                ]);

                // Get the response body
                $responseData = json_decode($response->getBody()->getContents(), true); // Decode JSON response

                $tweet_id = $responseData['data']['id']; // Access text from response data
                $data=new Tweet;
                $data->text=$request->text;
                $data->user_id=$user->id;
                $data->tweet_id=$tweet_id;
                $data->save();
                // Handle the response data as needed
                return back()->with('success','New Tweet has been created successfully');
            } catch (RequestException $e) {
                // Handle request errors
                if ($e->hasResponse()) {
                    $errorResponse = $e->getResponse();
                    $errorMessage = $errorResponse->getBody()->getContents();
                    dd($errorMessage);
                } else {
                    dd($e->getMessage());
                }
            }
        }



    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data=Tweet::find($id);

        return view('backend_app.files.edit_file',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {

        try {
            $user = Auth::user();
            $data =Tweet::find($id);
            $data->user_id = $user->id;
            $data->text = $request->text; // Assign text from response to Tweet object
            $data->tweet_id = 0; // Assign tweet_id from response to Tweet object
            $data->time=$request->time;
            $data->date=$request->date;

            $data->save();
            return back()->with('success','Tweet has been updated successfully');

} catch (\Throwable $th) {
    return back()->with('error',$th->getMessage());
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Tweet::destroy($id);
        return back()->with('success','Tweet Has been deleted successfully');
    }
    public function import_excel(Request $request){
        try {
            $collections = (new FastExcel)->import($request->file('excel_file'));

            $required_fields = ['form_no', 'id_no', 'security_no', 'file_status', 'type', 'size', 'unit', 'total_amount', 'file_location'];

            foreach ($collections as $collection) {
                foreach ($required_fields as $field) {
                    if (!array_key_exists($field, $collection) || $collection[$field] === "") {
                        return back()->with("error", "Please ensure all required fields are filled.");
                    }
                }

                // Check if the form_no already exists
                $existingFile = File::where('form_no', $collection['form_no'])->first();

                if ($existingFile) {
                    // Update existing file data
                    $existingFile->update([
                        'id_no' => $collection['id_no'],
                        'security_no' => $collection['security_no'],
                        'file_status' => $collection['file_status'],
                        'type' => $collection['type'],
                        'size' => $collection['size'],
                        'unit' => $collection['unit'],
                        'total_amount' => $collection['total_amount'],
                        'file_location' => $collection['file_location'],
                    ]);

                    // Create new ledger entry
                    $ledger = new Ledger;
                    $ledger->file_id = $existingFile->id;
                    $ledger->paid_amount = $collection['paid_amount'] ?? 0; // Assuming paid_amount is optional
                    $ledger->purpose = "Booking";
                    $ledger->save();
                } else {
                    // Generate a random 8-character alphanumeric string for hv_code
                    $hvCode = 'hv-' . strtoupper(substr(str_shuffle('axuqwep0123456789'), 0, 8));

                    // Create new file entry
                    $file = File::create([
                        'hv_code' => $hvCode,
                        'form_no' => $collection['form_no'],
                        'id_no' => $collection['id_no'],
                        'security_no' => $collection['security_no'],
                        'file_status' => $collection['file_status'],
                        'type' => $collection['type'],
                        'size' => $collection['size'],
                        'unit' => $collection['unit'],
                        'total_amount' => $collection['total_amount'],
                        'file_location' => $collection['file_location'],
                    ]);

                    // Create ledger entry for new file
                    $ledger = new Ledger;
                    $ledger->file_id = $file->id;
                    $ledger->paid_amount = $collection['paid_amount'] ?? 0; // Assuming paid_amount is optional
                    $ledger->purpose = "Booking";
                    $ledger->save();
                }
            }

            return back()->with("success", "Excel data has been imported successfully");
        } catch (\Exception $exception) {
            return back()->with("error", "Error occurred: ".$exception->getMessage());
        }
    }


    public function file_data($id){
        $data=File::find($id);
        $ledger=Ledger::where('file_id',$data->id)->get();
        $total_paid=$ledger->sum('paid_amount');
        $val=strval($id);
        $client = Client::whereJsonContains('files', $val )->first();
        return view('backend_app.files.file_info',compact('data','ledger','total_paid','client'));
    }

    public function ledger_payment(Request $request){
        $data=new Ledger;
        if($request->total_amount < $request->paid_amount){
            return back()->with('error',"Paid amount can not be greater than Balance amount");
        }
        $data->file_id=$request->file_id;
        $data->paid_amount=$request->paid_amount;
        if($data->purpose === null){
            $pupose="Booking";
        }
        else{
            $pupose=$request->purpose;
        }
        $data->purpose=$pupose;
        $data->save();
        return back()->with("success","Payment has been added successfully into the ledger");
    }

    public function export_data(Request $request)
    {

        $payments = Ledger::where(['file_id' => $request->file_id])->get();

        //export from product
        $storage = [];
        foreach ($payments as $key=>$item) {

            $storage[] = [
                'S.No' => $key,
                'paid_amount' => $item->paid_amount,
                'purpose' => $item->purpose,
            ];
        }
        $filePath = storage_path('app/temp/'.$request->file_id.'file_ledger.xlsx');
        (new FastExcel($storage))->export($filePath);
        return response()->json(['file_url' => url('temp/'.$request->file_id.'file_ledger.xlsx')]);
    }
    public function delete_ledger($id){
        try {

        Ledger::destroy($id);
        return back()->with('success','Ledger data has been deleted successfully');
        //code...
    } catch (\Throwable $th) {
        return back()->with('error',$th->getMessage());
    }
    }

    public function update_ledger(Request $request,$id){
        try {
           $data= Ledger::find($id);
           $data->paid_amount=$request->paid_amount;
           $data->purpose=$request->purpose;
           $data->save();
           return back()->with('success','Ledger data has been updated successfully');
        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
        }
    }
    public function update_file_dealer(Request $request,$id){
        try{
        $data= File::find($id);
        $data->distributor_id=$request->distributor_id;
        $data->save();

        return back()->with('success','New distrubutor has been assigned successfully');
     } catch (\Throwable $th) {
         return back()->with('error',$th->getMessage());
     }
}

public function assigned_dealers(Request $request){

    try {

        if($request->selected_items === null){
            return back()->with("error","Please select any file");
        }

        foreach($request->selected_items as $item){
            $data=File::find($item);
            $data->distributor_id=$request->dealer_id;
            $data->save();
        }
        return back()->with("success",'Dealer has been assigned successfully');
    } catch (\Throwable $th) {
        return back()->with("error",$th->getMessage());
    }


 }

public function file_status($status){

    $data=File::where('file_status',$status)->paginate(21);
    $dealers=Distributor::all();
    return view('backend_app.files.all_files',compact('data','dealers'));

}

public function filter_file(Request $request)
{


    // Initialize query builder for the File model
    $query = File::query();

    // Check if 'tracking_no' parameter is present and not null
    if ($request->filled('tracking_no')) {
        // Add where clause to filter by 'hv_code'
        $query->where('hv_code', $request->tracking_no);
    }

    // Check if 'form_no' parameter is present and not null
    if ($request->filled('id_no')) {
        // Add where clause to filter by 'form_no'
        $query->where('id_no', $request->id_no);
    }

    // Check if 'file_status' parameter is present and not null
    if ($request->filled('file_status')) {
        // Add where clause to filter by 'file_status'
        $query->where('file_status', $request->file_status);
    }

    // Check if 'type' parameter is present and not null
    if ($request->filled('type')) {
        // Add where clause to filter by 'type'
        $query->where('type', $request->type);
    }

    // Check if 'size' parameter is present and not null
    if ($request->filled('size')) {
        // Add where clause to filter by 'size'
        $query->where('size', $request->size);
    }

    // Check if 'dealer' parameter is present and not null
    if ($request->filled('dealer')) {
        // Add where clause to filter by 'distributor_id'
        $query->where('distributor_id', $request->dealer);
    }

    // Retrieve filtered files with associated 'dealer' information and paginate the results
    $filteredFiles = $query->with('dealer')->latest()->paginate($request->page_view);
    // Transform the paginated results into the desired format
    $data = $filteredFiles->map(function ($item) {
        $paid_amount = Ledger::where('file_id', $item->id)->sum("paid_amount");
        $client = Client::whereJsonContains('files', (string)$item->id)->first();
        $clientName = $client ? $client->name : "none";
        $clientcnic = $client ? $client->cnic : "none";

        $dealer = $item->dealer ? $item->dealer->name : "none";

        return [
            'id'=>$item->id,
            'tracking' => $item->hv_code,
            'app_form_no' => $item->form_no,
            'id_no' => $item->id_no,
            'security_no' => $item->security_no,
            'file_status' => $item->file_status,
            'type' => $item->type,
            'size' => $item->size,
            'unit' => $item->unit,
            'total_amount' => $item->total_amount,
            'paid_amount' => $paid_amount,
            'balance_amount' => $item->total_amount - $paid_amount,
            'file_location' => $item->file_location,
            'dealer_name' => $dealer,
            'client_name' => $clientName,
            'client_cnic' => $clientcnic,
            'plot_no' => $item->plot_no,

        ];
    });

    // Create the response with the paginated data and pagination links
    $response = [
        'data' => $data,
        'pagination' => $filteredFiles->links()->toHtml()
    ];


    // Return the response as JSON
    return response()->json($response);
}


public function filter_file_sorting(Request $request)
{
    // Initialize query builder for the File model
    $query = File::query();

    // Check if 'tracking_no' parameter is present and not null
    if ($request->filled('tracking_no')) {
        // Add where clause to filter by 'hv_code'
        $query->where('hv_code', $request->tracking_no);
    }

    // Check if 'form_no' parameter is present and not null
    if ($request->filled('id_no')) {
        // Add where clause to filter by 'form_no'
        $query->where('id_no', $request->id_no);
    }

    // Check if 'file_status' parameter is present and not null
    if ($request->filled('file_status')) {
        // Add where clause to filter by 'file_status'
        $query->where('file_status', $request->file_status);
    }

    // Check if 'type' parameter is present and not null
    if ($request->filled('type')) {
        // Add where clause to filter by 'type'
        $query->where('type', $request->type);
    }

    // Check if 'size' parameter is present and not null
    if ($request->filled('size')) {
        // Add where clause to filter by 'size'
        $query->where('size', $request->size);
    }

    // Check if 'dealer' parameter is present and not null
    if ($request->filled('dealer')) {
        // Add where clause to filter by 'distributor_id'
        $query->where('distributor_id', $request->dealer);
    }

    // Retrieve filtered files with associated 'dealer' information, order by 'created_at' column in ascending order, and paginate the results
    $filteredFiles = $query->with('dealer')->latest()->orderBy('id_no', $request->sort_order)->paginate($request->page_view);


    // Transform the paginated results into the desired format
    $data = $filteredFiles->map(function ($item) {
        $paid_amount = Ledger::where('file_id', $item->id)->sum("paid_amount");
        $client = Client::whereJsonContains('files', (string)$item->id)->first();
        $clientName = $client ? $client->name : "none";
        $clientcnic = $client ? $client->cnic : "none";

        $dealer = $item->dealer ? $item->dealer->name : "none";

        return [
            'id' => $item->id,
            'tracking' => $item->hv_code,
            'app_form_no' => $item->form_no,
            'id_no' => $item->id_no,
            'security_no' => $item->security_no,
            'file_status' => $item->file_status,
            'type' => $item->type,
            'size' => $item->size,
            'unit' => $item->unit,
            'total_amount' => $item->total_amount,
            'paid_amount' => $paid_amount,
            'balance_amount' => $item->total_amount - $paid_amount,
            'file_location' => $item->file_location,
            'dealer_name' => $dealer,
            'client_name' => $clientName,
            'client_cnic' => $clientcnic,
            'plot_no' => $item->plot_no,
        ];
    });

    // Create the response with the paginated data and pagination links
    $response = [
        'data' => $data,
        'pagination' => $filteredFiles->links()->toHtml()
    ];

    // Return the response as JSON
    return response()->json($response);
}



public function bulk_status(Request $request){

    try {

        if($request->selected_items === null){
            return back()->with("error","Please select any file");
        }

        foreach($request->selected_items as $item){
            $data=File::with('dealer')->where('id',$item)->first();
            $data->file_status=$request->file_status;
            if($request->file_status === "processing" || $request->file_status  ==="closed" || $request->file_status === "ready" || $request->file_status === "Project Office"){
                $data->file_location="Project Office";
            }
            if($request->file_status === "delivered" || $request->file_status === "blocked"){

                $data->file_location=$data->dealer->company;
            }
            $data->save();
        }
        return back()->with("success",'Dealer has been assigned successfully');
    } catch (\Throwable $th) {
        return back()->with("error",$th->getMessage());
    }


}
public function export_files($type){
        $data=Tweet::all();

        $full_data = $data->map(function ($item) {
            $paid_amount = Ledger::where('file_id', $item->id)->sum("paid_amount");
            $client = Client::whereJsonContains('files', (string)$item->id)->first();
            $clientName = $client ? $client->name : "none";
            $clientcnic = $client ? $client->cnic : "none";

            $dealer = $item->dealer ? $item->dealer->name : "none";

            return [
                'id'=>$item->id,
                'tracking' => $item->hv_code,
                'app_form_no' => $item->form_no,
                'id_no' => $item->id_no,
                'security_no' => $item->security_no,
                'file_status' => $item->file_status,
                'type' => $item->type,
                'size' => $item->size,
                'unit' => $item->unit,
                'total_amount' => $item->total_amount,
                'paid_amount' => $paid_amount,
                'balance_amount' => $item->total_amount - $paid_amount,
                'file_location' => $item->file_location,
                'dealer_name' => $dealer,
                'client_name' => $clientName,
                'client_cnic' => $clientcnic,
                'plot_no' => $item->plot_no,

            ];
        });


        //


        if($type==="excel"){

            // Transform the paginated results into the desired format


            $filePath = storage_path('app/temp/all_files.xlsx');
            (new FastExcel($full_data))->export($filePath);
            return response()->download($filePath)->deleteFileAfterSend(true);

        }
        else{

                // Create an instance of the Dompdf class
                $dompdf = new Dompdf();

                // Load HTML content from a blade view
                $html = view('backend_app.pdf_templates.files',compact('full_data'))->render();

                // Load HTML to Dompdf
                $dompdf->loadHtml($html);

                // Set paper size and orientation
                $dompdf->setPaper('A4', 'portrait');

                // Render PDF (optional: save the PDF to a file instead of outputting it directly)
                $dompdf->render();

                // Output PDF to browser
                return $dompdf->stream('all_files.pdf');

        }
}

}
