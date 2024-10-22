<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioEmpresaUpdateFormRequest;
use App\Models\UsuarioEmpresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdateUsuarioEmpresaController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UsuarioEmpresaUpdateFormRequest $request)
    {
        $data = $request->validated();


        $empresa = Auth::guard('empresa')->user();

        if ($request->hasFile('image_logo')) {
            $imagePath = $request->file('image_logo')->store('logos', 'public');



            Storage::disk('public')->delete($empresa->image_logo_url);
            $data['image_logo_url'] = $imagePath;
        }
        $usuarioEmpresa = UsuarioEmpresa::find($empresa->id);

        $usuarioEmpresa->update($data);

        return response()->json(["usuario" => $usuarioEmpresa], 200);
    }
}
