<?php

namespace App\Http\Controllers;

use App\ContractIndefinite;
use App\ContractService;
use Illuminate\Http\Request;
use App\User;

class ContractsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list_contracts()
    {
        return view('contracts.list');
    }

    public function indefined_list_users()
    {
        $users = User::select('users.*')
            ->join('contract_indefinite', 'users.id', '=', 'contract_indefinite.user_id')
            ->get();

        return view('contracts.indefined-list', [
            'users' => $users,
        ]);
    }

    public function indefined_update(Request $request, $id)
    {
        $contract = ContractIndefinite::find($id);
        $id_contract = $contract->id;
        $id = $contract->user_id;
        $user = \Auth::user();
         //obtener id
        $user_id = $request->input('user_id');

        if ($user->role == 'admin' && $user_id == $id) {

            //valdiar datos
            $valdiate = $this->validate($request, [
                'user_id' => ['required', 'int', 'unique:contract_indefinite,user_id,' . $id_contract],
                'salario' => ['required', 'int'],
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
            $contract->user_id = $user_id;
            $contract->contract_id = 1;
            $contract->salario_minimo = $salario_final;
            $contract->transporte = $transporte;
            $contract->parafiscales = $parafiscales;
            $contract->salud = $salud;
            $contract->pension = $pension;

            $contract->update();

            return redirect()->route('indefined.list')->with([
                'message' => 'Contrato actualizado correctamente'
            ]);
        } else {
            return redirect()->route('indefined.list')->with([
                'message' => 'Contrato no se ha actualizado correctamente'
            ]);
        }
    }

    public function indefined_delete(Request $request, $id)
    {
        $contract = ContractIndefinite::find($id);
        $id = $contract->user_id;
        $user = \Auth::user();
        $user_id = $request->input('user_id');

        if ($user->role == 'admin' && $user_id == $id) {
            $contract->delete();

            return redirect()->route('indefined.list')->with([
                'message' => 'Contrato eliminado correctamente'
            ]);
        } else {
            return redirect()->route('indefined.list')->with([
                'message' => 'Contrato no se ha eliminado correctamente'
            ]);
        }
    }

    //METODOS CONTRATO POR SERVICIOS

    public function services_list_users()
    {
        $users = User::select('users.*')
            ->join('contract_services', 'users.id', '=', 'contract_services.user_id')
            ->get();

        return view('contracts.services-list', [
            'users' => $users,
        ]);
    }

    public function services_update(Request $request, $id)
    {
        $contract = ContractService::find($id);
        $id_contract = $contract->id;
        $id = $contract->user_id;
        $user = \Auth::user();
        $user_id = $request->input('user_id');

        if ($user->role == 'admin' && $user_id == $id) {
            //valdiar datos
            $valdiate = $this->validate($request, [
                'user_id' => ['required', 'int', 'unique:contract_services,user_id,' . $id_contract],
                'salario' => ['required', 'int'],
                'retefuente' => ['required', 'int'],
            ]);

            $salario = $request->input('salario');
            $retefuente = intval($request->input('retefuente'));
            $retefuente = $salario * $retefuente / 100;
            $salario_final = $salario - $retefuente;


            //asignar datos
            $contract->user_id = $user_id;
            $contract->contract_id = 2;
            $contract->salario = $salario_final;
            $contract->retefuente = $retefuente;

            $contract->update();

            return redirect()->route('services.list')->with([
                'message' => 'Contrato actualizado correctamente'
            ]);
        } else {
            return redirect()->route('services.list')->with([
                'message' => 'Contrato no se ha actualizado correctamente'
            ]);
        }
    }

    public function services_delete(Request $request, $id)
    {
        $contract = ContractService::find($id);
        $id = $contract->user_id;
        $user = \Auth::user();
        $user_id = $request->input('user_id');

        if ($user->role == 'admin' && $user_id == $id) {
            $contract->delete();

            return redirect()->route('services.list')->with([
                'message' => 'Contrato eliminado correctamente'
            ]);
        } else {
            return redirect()->route('services.list')->with([
                'message' => 'Contrato no se ha eliminado correctamente'
            ]);
        }
    }
}
