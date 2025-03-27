<?php

namespace App\Filament\Auth;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\Register as FilamentRegister;

class Register extends FilamentRegister { 

    public function form(Form $form): Form { 
        return $form->schema([
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),

                        TextInput::make('nik'),
                        Hidden::make('role')
                            ->default('orangtua')
                    ])
                    ->statePath('data');
    }

}
