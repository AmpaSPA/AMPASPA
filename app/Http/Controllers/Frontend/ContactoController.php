<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Requests\CreateContactRequest;
use App\Http\Controllers\Controller;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.principal.contacto');
    }

    /**
     * @param Request $request
     */
    public function send(CreateContactRequest $request)
    {
        $data = $request->all();

        Mail::send('emails.correo', $data, function(Message $message) use ($request)
        {
            $message->from($request->correo);
            $message->subject($request->asunto);
            $message->to('AMPA@sanpedroapostol.es', 'AMPA Colegio San Pedro Apóstol');
        });

        return view('frontend.principal.enviocorrecto');
    }
}
