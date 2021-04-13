<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class ContactsController extends Controller
{
    public function index (Request $request)
    {
        if ($request->isMethod('post')) {
            $messages = [
                'required' => 'Поле :attribute обязательно к заполнению',
                'email' => 'Поле :attribute должно содержать правильный email адрес'
            ];

            $this->validate($request, [
                'name' => 'required',
                'sirname' => 'required',
                'email' => 'required|email',
                'message' => 'required|min:3'
            ], $messages);

            $data = $request->all();

            $result = Mail::send('email', ['data' => $data], function ($m) use ($data) {
                $mail_admin = env('MAIL_ADMIN');
                $m->from($data['email'], $data['name']);
                $m->to($mail_admin, 'Mr_Admin')->subject('Question');
            });

            if ($result) {
                return redirect()->route('contacts')->with('status', 'Сообщения отправлено!');
            }

        }

        $this->view('contact');

        return $this->render();
    }
}
