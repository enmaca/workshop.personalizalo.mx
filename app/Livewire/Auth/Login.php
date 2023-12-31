<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email = "";
    public $password = "";

    protected $rules = [
        'email' => 'required|string|email|max:255',
        'password' => 'required',
    ];

    public function mount()
    {
        if (auth()->user()) {
            return redirect()->intended('/');
        }
    }

    public function submit()
    {
        // validate the data
        $this->validate();

        $user = array(
            'email' => $this->email,
            'password' => $this->password,
        );

        if (Auth::attempt($user)) {
            return redirect()->intended('/');
        } else {
            $this->addError('email', trans('auth.failed'));
            return redirect()->back();
        }
    }
    public function render()
    {

        return view('uxmal::pages.livewire.login')->extends('uxmal::layouts.master-without-nav');
    }
}
