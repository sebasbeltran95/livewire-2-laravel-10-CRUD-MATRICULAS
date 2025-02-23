<?php

namespace App\Http\Livewire;

use App\Models\Matricula;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\QueryException;

class Matriculas extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $estudiante, $modulo;
    public $idx,$estudiantex, $modulox;
    public $search  = "";

    protected $listeners = ['render', 'delete'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getMatriculasProperty()
    {
        if ($this->search == "") {
            return Matricula::orderBy('id','DESC')->paginate(5);
        } else {
            return Matricula::orWhere('estudiante', 'LIKE', '%'.$this->search.'%')
                ->orWhere('modulo', 'LIKE', '%'.$this->search.'%')
                ->paginate(3);
        }
 
    }

    public function crear()
    {
        try {
            $this->validate([
                'estudiante' => 'required|string|max:100',
                'modulo' => 'required|string|max:100',
            ],[
                'estudiante.required' => 'El campo Nombre Estudiante es obligatorio',
                'estudiante.string' => 'El campo Nombre Estudiante recibe solo cadena de texto',
                'estudiante.max' => 'El campo Nombre Estudiante debe contener maximo 100 caracteres',
                'modulo.required' => 'El Modulo es obligatorio',
                'modulo.string' => 'El Modulo recibe solo cadena de texto',
                'modulo.max' => 'El Modulo debe contener maximo 100 caracteres',
            ]);

            $user = new Matricula();
            $user->estudiante =  $this->estudiante;
            $user->modulo =  $this->modulo;
            $user->save();
            $this->reset();
            $msj = ['!Registrado!', 'Se registro la matricula', 'success'];
            $this->emit('ok', $msj);

        } catch (QueryException $e) {

            $msj = ['!ERROR!', 'se ha presentado un error: ', $e, 'danger'];
            $this->emit('ok', $msj);

        }
    }


    public function datacliente($obj)
    {
        $this->idx = $obj['id'];
        $this->estudiantex =  $obj['estudiante'];
        $this->modulox = $obj['modulo'];
    }
    public function actua()
    {
        try {

            $this->validate([
                'estudiantex' => 'required|string|max:100',
                'modulox' => 'required|string|max:100',
            ],[
                'estudiantex.required' => 'El campo Nombre Estudiante es obligatorio',
                'estudiantex.string' => 'El campo Nombre Estudiante recibe solo cadena de texto',
                'estudiantex.max' => 'El campo Nombre Estudiante debe contener maximo 100 caracteres',
                'modulox.required' => 'El Modulo es obligatorio',
                'modulox.string' => 'El Modulo recibe solo cadena de texto',
                'modulox.max' => 'El Modulo debe contener maximo 100 caracteres',
            ]);

    
            $data = Matricula::find($this->idx);
            $data->estudiante = $this->estudiantex;
            $data->modulo = $this->modulox;
            $data->save();
            $msj = ['!Actualizado!', 'Se actualizo la matricula', 'success'];
            $this->emit('ok', $msj);

        } catch (QueryException $e) {

            $msj = ['!ERROR!', 'se ha presentado un error: ', $e, 'danger'];
            $this->emit('ok', $msj);

        }
    }

    public function delete($post)
    {
        try { 

            Matricula::where('id',$post)->first()->delete();

         } catch (QueryException $e) {

            $msj = ['!ERROR!', 'se ha presentado un error: ', $e, 'danger'];
            $this->emit('ok', $msj);

        }
    }

    public function render()
    {
        return view('livewire.matriculas')->extends('layouts.plantilla')->section('content');
    }
}
