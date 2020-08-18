<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GenerateKeyController extends Controller
{
    public function generateHashKey(Request $request)
    {
        $data = $request->validate(['email' => 'required',
            'userId' => 'required|integer',
            'mailingId' => 'required|integer']);

        $key = $this->formatData($data);
        return str_replace('=', '', $key);

    }
    private function formatData(array $data){
        return "SG" . "." . base64_encode(base64_encode($data['userId'])) .
            "." . base64_encode($data['email']) .
            "." . base64_encode(base64_encode($data['mailingId']));
    }
}

