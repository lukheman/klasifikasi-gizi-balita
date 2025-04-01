<?php

namespace App\Filament\Auth;

use App\Models\OrangTua;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\Register as FilamentRegister;

use Illuminate\Database\Eloquent\Model;

class Register extends FilamentRegister { 

    public function form(Form $form): Form { 
        return $form->schema([
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),

                        TextInput::make('nik')
                            ->label('NIK'),
                        DatePicker::make('tanggal_lahir')
                            ->label('Tanggal Lahir')
                            ->maxDate(now()),
                        TextInput::make('telepon')
                            ->label('Telepon')
                            ->numeric()
                    ])
                    ->statePath('data');
    }

    public function handleRegistration(array $data): Model {

        $data_user = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => 'orangtua',
        ];


        $user = $this->getUserModel()::create($data_user);

        $data_orang_tua = [
            'nik' => $data['nik'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'telepon' => $data['telepon'],
            'id_user' => $user->id
        ];

        // return $this->getUserModel()::create($data_user);

        OrangTua::create($data_orang_tua);

        return $user;
    }

}
