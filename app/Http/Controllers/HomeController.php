<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ContractIndefinite;
use App\ContractService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    //metodos contrato indefinido
    public function indefined_create()
    {

        $contract_services = ContractService::orderBy('id', 'desc')->first();

        $users = User::where('id', '!=', $contract_services->user_id)
            ->where('id', '!=', 1)
            ->where('id', '!=', 2)
            ->orderBy('id', 'desc')
            ->paginate();
        return view('contracts.indefined', [
            'users' => $users,
        ]);
    }

    public function indefined_save(Request $request)
    {
        //obtener id
        $user_id = $request->input('user_id');
        //valdiar datos
        $valdiate = $this->validate($request, [
            'salario' => ['required', 'int'],
            'user_id' => ['required', 'int', 'unique:contract_indefinite,user_id,' . $user_id],
        ]);

        //capturar datos
        $salario = $request->input('salario');
        $parafiscales = $salario * 4 / 100;
        $salud = $salario * 4 / 100;
        $pension = $salario * 4 / 100;
        $transporte = $salario * 6 / 100;
        $total_deducibles = $parafiscales + $salud + $pension;
        $salario_final = $salario - $total_deducibles + $transporte;

        //asignar datos
        $contract = new ContractIndefinite();
        $contract->user_id = $user_id;
        $contract->contract_id = 1;
        $contract->salario_minimo = $salario_final;
        $contract->transporte = $transporte;
        $contract->parafiscales = $parafiscales;
        $contract->salud = $salud;
        $contract->pension = $pension;

        $contract->save();

        return redirect()->route('home')->with([
            'message' => 'Contrato creado correctamente'
        ]);
    }

    //metodos por servicios
    public function services_create()
    {

        $contract_indefined = ContractIndefinite::orderBy('id', 'desc')->first();

        $users = User::where('id', '!=', $contract_indefined->user_id)
            ->where('id', '!=', 1)
            ->where('id', '!=', 2)
            ->orderBy('id', 'desc')
            ->paginate();

        return view('contracts.services', [
            'users' => $users,
        ]);
    }


    public function services_save(Request $request)
    {
        //obtener id
        $user_id = $request->input('user_id');
        //valdiar datos
        $valdiate = $this->validate($request, [
            'salario' => ['required', 'int'],
            'retefuente' => ['required', 'int'],
            'user_id' => ['required', 'int'/*, 'unique:contract_services,user_id,'. $user_id*/],
        ]);

        //capturar datos
        $salario = $request->input('salario');
        $retefuente = intval($request->input('retefuente'));
        $retefuente = $salario * $retefuente / 100;
        $salario_final = $salario - $retefuente;


        //asignar datos
        $contract = new ContractService();
        $contract->user_id = $user_id;
        $contract->contract_id = 2;
        $contract->salario = $salario_final;
        $contract->retefuente = $retefuente;

        $contract->save();

        return redirect()->route('home')->with([
            'message' => 'Contrato creado correctamente'
        ]);
    }
}
