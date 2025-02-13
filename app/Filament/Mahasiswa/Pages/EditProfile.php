<?php

namespace App\Filament\Mahasiswa\Pages;

use Exception;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Facades\Filament;
use App\Models\MahasiswaDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Validation\Rules\Password;
use Filament\Notifications\Actions\Action;
use Illuminate\Contracts\Auth\Authenticatable;
use Filament\Forms\Concerns\InteractsWithForms;

class EditProfile extends Page implements HasForms
{
    use InteractsWithForms;
    protected static bool $shouldRegisterNavigation = false;
    protected static string $view = 'filament.mahasiswa.pages.edit-profile';

    public ?array $profileData = [];
    public ?array $passwordData = [];
    public ?array $infoMahasiswa = [];
    public function mount(): void
    {
        $this->fillForms();
        $this->informasiMahasiswaForm->fill(MahasiswaDetail::where('user_id', Auth::user()->id)->first()->attributesToArray());
    }
    protected function getForms(): array
    {
        return [
            'editProfileForm',
            'editPasswordForm',
            'informasiMahasiswaForm',
        ];
    }
    public function editProfileForm(Form $form): Form
    {
        return  
            $form->schema([
            Section::make('Informasi Akun')
                ->description('Update your account\'s profile information and email address.')
                ->schema([
                    TextInput::make('name')
                        ->required(),
                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->unique(ignoreRecord: true),
            ]),
        ])
        ->model($this->getUser())
        ->statePath('profileData');
    }

    public function informasiMahasiswaForm(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Mahasiswa')
                    ->schema([
                        TextInput::make('nim'),
                        TextInput::make('sks')
                    ])
            ])
            ->statePath('infoMahasiswa');
    }

    public function editPasswordForm(Form $form): Form
    {
        return  
            $form->schema([
            Section::make('Update Password')
                ->description('Ensure your account is using long, random password to stay secure.')
                ->schema([
                    TextInput::make('Current password')
                        ->password()
                        ->required()
                        ->currentPassword(),
                    TextInput::make('password')
                        ->password()
                        ->required()
                        ->rule(Password::default())
                        ->autocomplete('new-password')
                        ->dehydrateStateUsing(fn ($state): string => Hash::make($state))
                        ->live(debounce: 500)
                        ->same('passwordConfirmation'),
                    TextInput::make('passwordConfirmation')
                        ->password()
                        ->required()
                        ->dehydrated(false),
            ]),
        ])
        ->model($this->getUser())
        ->statePath('passwordData');
    }

    protected function getUpdateProfileFormActions(): array
    {
        return [
            Action::make('updateProfileAction')
                ->button()
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('editProfileForm'),
        ];
    }
    protected function getUpdatePasswordFormActions(): array
    {
        return [
            Action::make('updatePasswordAction')
                ->button()
                ->label(__('filament-panels::pages/auth/edit-profile.form.actions.save.label'))
                ->submit('editPasswordForm'),
        ];
    }

    protected function getInformasiMahasiswaFormActions(): array
    {
        return [
            Action::make('updateInformasiMahasiswaAction')
                ->button()
                ->label(__('filament-panels::pages/auth/edit-profile.form.actions.save.label'))
                ->submit('informasiMahasiswaForm'),
        ];
    }

    protected function getUser(): Authenticatable & Model
    {
        $user = Filament::auth()->user();
            if (! $user instanceof Model) {
            throw new Exception('The authenticated user object must be an Eloquent model to allow the profile page to update it.');
        }
        return $user;
    }
    protected function fillForms(): void
    {
        $data = $this->getUser()->attributesToArray();
        $this->editProfileForm->fill($data);
        $this->editPasswordForm->fill();
    }

    public function updateProfile(): void
    {
        $data = $this->editProfileForm->getState();
        $this->handleRecordUpdate($this->getUser(), $data);
        $this->sendSuccessNotification(); 
    }
    public function updatePassword(): void
    {
        $data = $this->editPasswordForm->getState();
        $this->handleRecordUpdate($this->getUser(), $data);
        if (request()->hasSession() && array_key_exists('password', $data)) {
            request()->session()->put(['password_hash_' . Filament::getAuthGuard() => $data['password']]);
        }
        $this->editPasswordForm->fill();
        $this->sendSuccessNotification(); 
    }

    public function updateInfoMahasiswa(): void
    {
        $data = $this->informasiMahasiswaForm->getState();

        MahasiswaDetail::where('user_id', Auth::user()->id)->first()->update($data);

        $this->sendSuccessNotification(); 
    }

    private function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update($data);
        return $record;
    }

    private function sendSuccessNotification() {
        Notification::make()
            ->success()
            ->title(__('filament-panels::pages/auth/edit-profile.notifications.saved.title'))
            ->send();

    }
}
