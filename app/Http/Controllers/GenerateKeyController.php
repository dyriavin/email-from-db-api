<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GenerateKeyController extends Controller
{
    public function generateHashKey(Request $request)
    {
        $data = $request->validate(['email'=>'required','userId' => 'required|integer','mailingId' => 'required|integer']);
        return "SG".".".base64_encode($data['email']).".".base64_encode($data['userId']).".".base64_encode($data['mailingId']);
    }
}
