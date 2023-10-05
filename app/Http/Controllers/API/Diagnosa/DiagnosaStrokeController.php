<?php

namespace App\Http\Controllers\API\Diagnosa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DiagnosaStrokeController extends Controller
{
    public function sendFile(Request $request) {
        if (!$request->hasFile('file')) {
            return response()->json(['error' => "Invalid request."], 400);
        }

        $file = $request->file('file');
        $tmpDirectory = storage_path('tmp/'); // jgn lupa pake slash (/) di akhir string, kalo itu sebuah dir
        $tmpFileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $tmpFilePath = $tmpDirectory . $tmpFileName;

        if (!$file->move($tmpDirectory, $tmpFileName)) {
            return response()->json(['error' => "Sorry, there was an error uploading your file."], 400);
        }

        $remoteUrl = 'http://127.0.0.1:8080/diagnosa-stroke'; //url api server
        $postData = [
            'file' => new \CURLFile($tmpFilePath, $file->getClientMimeType(), $file->getClientOriginalName()),
        ];

        // dd($tmpFilePath);

        $response = $this->sendFileToRemoteServer($remoteUrl, $postData);
        // dd($response);
        // return response()->json(['response' => json_encode($response)], 200);

        if ($response['httpCode'] == 200) {
            // hapus kalo udh berhasil keupload ke server
            Storage::delete($tmpFilePath);

            return response()->json(['response' => $response['response']], 200);
        } else {
            return response()->json(['error' => $response['error']], 400);
        }
    }

    private function sendFileToRemoteServer($remoteUrl, $postData) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $remoteUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        return [
            'httpCode' => $httpCode,
            'response' => $response,
            'error' => ($httpCode != 200) ?
                "File upload to remote server failed. HTTP Code: " . $httpCode : null,
        ];
    }
}