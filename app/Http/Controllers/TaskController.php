<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        // si solo quiero mostrar en vez de paginate uso get
        $tasks = Task::orderBy('id', 'DESC')->paginate(8);
        // return $tasks;
        return [
            'pagination' => [
                'total'         => $tasks->total(), //lista todo
                'current_page'  => $tasks->currentPage(), //pagina actual
                'per_page'      => $tasks->perPage(), //por pagina
                'last_page'     => $tasks->lastPage(), //ultima pagina
                'from'          => $tasks->firstItem(), //desde
                'to'            => $tasks->lastItem(), //hasta ultimo elemento
                
            ],
            'tasks' => $tasks
        ];
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //la logica para guardar
        $this->validate($request, [
            'keep' => 'required|min:3'
        ]); 

        Task::create($request->all());

        return;
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
        //la logica de actualizacion
        $this->validate($request, [
            'keep' => 'required|min:3'
        ]); 

        Task::find($id)->update($request->all());

        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //la logica de eliminar
        $taks = Task::findOrFail($id);
        $taks->delete();
    }
}
