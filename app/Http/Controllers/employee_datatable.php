<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\employee;
use Validator;

class employee_datatable extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (request()->ajax())
        {
            return datatables()->of(employee::latest()->get())
                    ->addColumn('action', function($data)
                    {
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);

        }
        return view('Datatable');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'FirstName'    =>  'required',
            'LastName'     =>  'required',
            'Email'        =>'required|unique:employee|max:255|email',
            'Hobies',
            'Gender',
            'Picture'         =>  'required|image|max:2048'
        );

        //$error = Validator::make($request->all(),$rules);
        $error = $this->validate::make($request->all(),$rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $image = $request->file('Picture');

        $new_name = rand() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('uploads'), $new_name);

        $form_data = array(
            'FirstName'        =>  $request->FirstName,
            'LastName'         =>  $request->LastName,
            'Email'            =>  $request->Email,
            'Hobbies'          =>  $request->Hobbies,
            'Gender'           =>  $request->Gender,
            'Picture'             =>  $new_name
        );

        employee::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = employee::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $image_name = $request->hidden_image;
        $image = $request->file('Picture');
        if($image != '')
        {
            $rules = array(
                'FirstName'    =>  'required',
                'LastName'     =>  'required',
                'Email'        =>'required|unique:employee|max:255|email',
                'Hobbies',
                'Gender',
                'Picture'         =>  'image|max:2048'
            );
            //$error = Validator::make($request->all(), $rules);
            $error= $this->validate::make($request->all(),$rules);
            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }

            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $image_name);
        }
        else
        {
            $rules = array(
                'FirstName'    =>  'required',
                'last_name'     =>  'required',
                'Email',
                'Hobbies',
                'Gender',
            );

            //$error = Validator::make($request->all(), $rules);
            $error= $this->validate::make($request->all(),$rules);

            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }
        }

        $form_data = array(
            'FirstName'       =>   $request->FirstName,
            'LastName'        =>   $request->LastName,
            'Email'           =>   $request->Email,
            'Hobbies'         =>   $request->Hobbies,
            'Gender'          =>   $request->Gender,
            'Picture'            =>   $image_name
        );
        employee::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = employee::findOrFail($id);
        $data->delete();
    }

    public function importCSV()
    {
        return view('Datatable');
    }

    public function saveCSVData(Request $request)
    {
        if($request->hasFile('csv')){
            $fileNameWithExt = $request->file('csv')->getClientOriginalName();
            $filename = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            $extension = $request->file('csv')->getClientOriginalExtension();
            if($extension != 'csv')
            {
                return back()->with('error','Uploaded file is not CSV.');
            }
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $request->file('csv')->storeAs('public/csv_files', $fileNameToStore);
            if (($handle = fopen (public_path () . '/storage/csv_files/'.$fileNameToStore, 'r' )) !== FALSE) {
                while ( ($data = fgetcsv ( $handle, 0, ',' )) !== FALSE ) {
                    $dataArray[] = $data;
                }
                fclose ( $handle );
            }
            $columns = array_shift($dataArray);//returns 1st row and removes from array

            if(!$this->verifyColumnHeaders($columns))
            {
                return back()->with('error','Cannot recognise columns, please follow the format.');
            }
            $success = 0;
            $failed = 0;

            foreach ($dataArray as $records ) {
                try {
                    if($records[0] == null || $records[1] == null || $records[2] == null)
                    {
                        $failed++;
                        continue;
                    }
                    if($this->has_numbers($records[0]) || $this->has_special_chars($records[0]) || $this->has_numbers($records[1]) || $this->has_special_chars($records[1]))
                    {
                        $failed++;
                        continue;
                    }
                    if(strpos($records[2],'@') == false)
                    {
                        $failed++;
                        continue;
                    }
                    $new_emp = new Employee();
                    $new_emp->first_name = $records[0];
                    $new_emp->last_name = $records[1];
                    $new_emp->email = $records[2];
                    $new_emp->gender = $records[3];
                    $new_emp->save();
                    $hobbiesArray = explode(',',$records[4]);
                    foreach($hobbiesArray as $hobby)
                    {
                        $new_hobby = new employee();
                        $new_hobby->hobby = $hobby;
                        $new_hobby->employee()->associate($new_emp);
                        $new_hobby->save();
                    }
                    $success++;
                } catch (\Throwable $th) {
                    $failed++;
                    continue;
                }

            }

            unlink(storage_path('app/public/csv/'.$fileNameToStore));
            return redirect('/employees')->with('success','Data saved... Succeed: '.$success.', Failed: '.$failed);
        }
        return back()->with('error','No file selected.');
    }





}


