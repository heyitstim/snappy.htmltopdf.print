<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use App;
use App\Models\DailyTimeRecord;
use Illuminate\Support\Facades\Auth;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $data = DailyTimeRecord::latest()->paginate(1);
            return view('dtr',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $u_email = Auth::user()->email;

        $request->validate([
            'uemail' => 'required',
            'uname' => 'required',
            'timeperiod' => 'required',
            'uimage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($img_request = $request->file('uimage')) {

            $destinationPath = 'images/';
            $dtr_image = date('YmdHis') . $u_email . "." . $img_request->getClientOriginalExtension();

            $img_request->move($destinationPath, $dtr_image);
            $form_data['uimage'] = "$dtr_image";

            $model = new DailyTimeRecord;

            $model->email = request()->uemail;
            $model->name = request()->uname;
            $model->period = request()->timeperiod;
            $model->image_path = $dtr_image;

            $model->save();
        }
        return redirect('dtr');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function print_form(Request $request){
        $id = '1';
        $data = DailyTimeRecord::find($id);

        $name = $request->input('fname_field');
        $period = $request->input('timeperiod');
        $download = $request->input('downloadpdf');
        $form_radio = $request->input('form_radio');
        $pdf = App::make('snappy.pdf.wrapper');

        if($form_radio == 'c1form'){
            $pdf = PDF::loadView('print_forms.c1form', compact('name', 'period', 'download','data'));
        if ($request->has('downloadpdf')) {
            return $pdf->download('c1form.pdf');
        } else {
            return $pdf->inline();
        }
            }else{
            $pdf = PDF::loadView('print_forms.c2form', compact('name', 'period', 'download'));
            if ($request->has('downloadpdf')) {
                return $pdf->download('c2form.pdf');
            } else {
                return $pdf->inline();
            }
        }
    }

    public function print_formv2(){
        $id = '1';
        $data = DailyTimeRecord::find($id);

        return view('print_forms.c1form',compact('data'));
    }
}
