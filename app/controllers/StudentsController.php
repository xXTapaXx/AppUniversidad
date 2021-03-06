<?php

class StudentsController extends \BaseController {


    public function __construct()
    {

        $this->beforeFilter('auth');

    }

    /**
	 * Display a listing of the resource.
	 * GET /students
	 *
	 * @return Response
	 */
	public function index()
	{
		//

        $students = Student::join('careers','students.idcareer','=','careers.idcareer')->
        select('students.idstudent','students.dni','students.firstname','students.lastname','students.image','careers.career')->get();

        // consulta los datos de roles
        $careers = Career::all();

        // los envia a la vista
        return View::make('students.index',array('students'=>$students,'careers'=>$careers));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /students/create
	 *
	 * @return Response
	 */
	public function create()
	{
        Return View::make('students.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /students
	 *
	 * @return Response
	 */
	public function store()
	{
        // guarda la informacion del usuario con sus datos

         $student = new Student;
         $student->dni = Input::get('dni'); // toma los datos del formulario por su name
         $student->firstname = Input::get('firstname');
         $student->lastname = Input::get('lastname');
         $student->idcareer = Input::get('career');


        if (Input::hasFile('image-file'))
        {
            $student->image = $student->dni;
            Input::file('image-file')->move(public_path()."/images/students/",$student->dni);

        }else{
            $student->image = 'student_pic.png';
        }

        // guarda los datos
         $student->save();

        // mensaje
        Session::flash('message', 'Successfully created student');

        // redirecciona a la pantalla principal de students
        return Redirect::to('/admin/students');
	}

	/**
	 * Display the specified resource.
	 * GET /students/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $student = Student::join('careers','students.idcareer','=','careers.idcareer')->where('students.idstudent','=',$id)->
        select('students.idstudent','students.dni','students.firstname','students.lastname','students.image','careers.career')->get();

        // envia los datos a la vista
        return $student;
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /students/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        // devuelve los datos de studiante
        $students = Student::join('careers','students.idcareer','=','careers.idcareer')->where('students.idstudent','=',$id)->
        select('students.idstudent','students.dni','students.firstname','students.lastname','students.image','careers.career')->get();

        // envia los datos a la vista
        return $students;
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /students/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        // buscar la informacion del estudiante
        $student = Student::find($id);

        // actualiza la informacion del usuario con sus datos
        $student->dni = Input::get('dni'); // toma los datos del formulario por su name
        $student->firstname = Input::get('firstname');
        $student->lastname = Input::get('lastname');
        $student->idcareer = Input::get('career');

        if (Input::hasFile('image-file-edit'))
        {
            $student->image = $student->dni;
            Input::file('image-file-edit')->move(public_path()."/images/students/",$student->dni);

        }

        // guardar los datos
        $student->save();

        // mensaje
        Session::flash('message', 'Successfully updated student');

        // redirecciona a la pantalla principal de students
        return Redirect::to('/admin/students');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /students/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        // buscar la informacion del estudiante
        $student = Student::find($id);

        // elimina el usuario
        $student->delete();

        // mensaje
        Session::flash('message', 'Successfully deleted  student');

        // redirecciona a la pantalla principal de students
        return Redirect::to('/admin/students');
	}




}