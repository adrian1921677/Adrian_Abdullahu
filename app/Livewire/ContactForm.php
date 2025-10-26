<?php

namespace App\Livewire;

use Livewire\Component;

class ContactForm extends Component
{
    public $name = '';
    public $email = '';
    public $message = '';
    public $success = false;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'message' => 'required|min:10',
    ];

    public function submit()
    {
        $this->validate();

        // Here you would typically send an email
        // For now, we'll just simulate success
        sleep(1);

        $this->success = true;
        $this->reset(['name', 'email', 'message']);

        session()->flash('message', 'Vielen Dank! Ich melde mich bald zurück.');
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
