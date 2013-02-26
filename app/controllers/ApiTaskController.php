<?php

class ApiTaskController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// Retrieve all tasks for this user.
		$tasks = Task::where('user_id', Auth::user()->id)->get();

		return Response::json($tasks->toArray(),200);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// Retrieve the JSON input
		$input = Input::json();

		// Create a new Task with the specified values.
		$task = new Task;
		$task->user_id = Auth::user()->id;
		$task->title = $input->title;
		$task->completed = ($input->completed ? true : false);

		$task->save();

		return Response::json($task->toArray(),201);
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show($id)
	{
		// Retrieve the task for the user
		$task = Task::where('user_id', Auth::user()->id)->where('id', $id)->first();

		// Respond if found
		if($task)
			return Response::json($task->toArray(),200);
		else
			return Response::json(array(
				'error' => true,
				'message' => 'Task not found.'
			),404);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update($id)
	{
		// Retrieve task for the user.
		$task = Task::where('user_id', Auth::user()->id)->where('id', $id)->first();

		// Check if the task exists.
		if(!$task)
			return Response::json(array(
				'error' => true,
				'message' => 'Task not found.'
			),404);

		// Retrieve JSON input
		$input = Input::json();

		// Update model
		$task->title = $input->title;
		$task->completed = $input->completed ? true : false;

		$task->save();

		return Response::json($task->toArray(),201);

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		// Retrieve task for the user.
		$task = Task::where('user_id', Auth::user()->id)->where('id', $id)->first();

		// Check to see if the task exists
		if(is_null($task))
			return Response::json(array(
				'error' => true,
				'message' => 'Task not found.'
			),404);

		$task->delete();

		return Response::json(array(
			'error' => false,
			'message' => 'Task deleted.'
		),200);
	}

}
