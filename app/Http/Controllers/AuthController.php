<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // public function showLoginForm(){
    //     return view('auth.login');
    // }

    // public function showLogoutForm(){
    //     if(Auth::check()){
    //         return redirect('auth.personal');
    //     }
    //     return view('auth.logout');
    // }

    // public function showRegisterForm(){
    //     return view('auth.register');
    // }

    // public function showEditForm(){
    //     return view('auth.edit');
    // }


    // public function loginUser(){
    //     return true;
    // }
    // public function logoutUser(){
    //     return true;
    // }
    // public function registerUser(){
    //     return true;
    // }
    // public function deleteUser(){
    //     return true;
    // }
    // public function editUser(){
    //     return true;
    // }
}




// `AuthController` - это контроллер в Laravel, который хранится в `app/Http/Controllers` 
// и отвечает за обработку действий, связанных с аутентификацией пользователя. 
// Это могут быть действия регистрации, входа, выхода и восстановления пароля.

// Вот пример простого `AuthController`:



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $users;

    public function __construct(UserRepositoryInterface $users)
    {
        $this->users = $users;
    }

    public function login(Request $request)
    {
        // Валидация данных
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Проверка учетных данных пользователя
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Успешный вход
            return redirect()->intended('dashboard');
        }

        // Если что-то пошло не так (неверный логин/пароль)
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function register(Request $request)
    {
        // Валидация данных
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Создание нового пользователя
        $user = $this->users->create([
                     'name' => $request->name,
                     'email' => $request->email,
                     'password' => Hash::make($request->password),
                 ]);

        // Автоматический вход после регистрации
        Auth::login($user);

        // Редирект на домашнюю страницу
        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();

        // Редирект на страницу входа
        return redirect()->route('login');
    }
}


// В этом примере контроллер `AuthController` имеет три метода: `login`, `register` и `logout`,
// каждый из которых обрабатывает соответствующее действие аутентификации.
// Метод `__construct` используется для внедрения зависимости репозитория пользователей,
//  а также для установки посредника аутентификации, чтобы защитить определенные методы от неаутентифицированных пользователей.


// Каждый метод обрабатывает входящий HTTP-запрос, выполняет валидацию входных данных,
// работает с репозиторием пользователей для доступа к базе данных и возвращает соответствующий ответ: 
// обычно это редирект на другую страницу или JSON-ответ с сообщением об ошибке.