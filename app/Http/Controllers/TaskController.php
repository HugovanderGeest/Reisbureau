<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Met deze methode worden alle gegevens of taken in de database geretourneerd.

        return Task::orderBy('created_at', 'asc')->get();  //returns values in ascending order
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
        // Met deze methode kunnen we gebruikersinvoer ontvangen en opslaan in de database.

        $this->validate($request, [ //inputs are not empty or null
            'title' => 'required',
            'description' => 'required',
        ]);
  
        $task = new Task;
        $task->title = $request->input('title'); //retrieving user inputs
        $task->description = $request->input('description');  //retrieving user inputs
        $task->save(); //storing values as an object
        return $task; //returns the stored value if the operation was successful.
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Met deze methode kunnen we waarden van een specifiek object ophalen.
        return Task::findorFail($id); //searches for the object in the database using its id and returns it.

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
        //Met deze methode kan de gebruiker bestaande waarden in de database bijwerken.

          $this->validate($request, [ // the new values should not be null
          'title' => 'required',
          'description' => 'required',
      ]);

      $task = Task::findorFail($id); // uses the id to search values that need to be updated.
      $task->title = $request->input('title'); //retrieves user input
      $task->description = $request->input('description');////retrieves user input
      $task->save();//saves the values in the database. The existing data is overwritten.
      return $task; // retrieves the updated object from the database
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findorFail($id); //searching for object in database using ID
      if($task->delete()){ //deletes the object
          return 'deleted successfully'; //shows a message when the delete operation was successful.
    }
    } 
}