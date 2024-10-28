<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchesController;
use App\Http\Controllers\ContactsController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Redireciona a rota raiz para a lista de contatos com ramais
Route::get('/', function () {
    return redirect('contactsWithBranches');
});

// Rotas de contatos e ramais, aplicando middleware de autenticação
Route::middleware(['auth'])->group(function () {
    Route::resource('contacts', ContactsController::class);
    Route::resource('branches', BranchesController::class);

});

// Rota pública para listar contatos com ramais
Route::get('/contactsWithBranches', [ContactsController::class, 'listWithBranches'])->name('contacts.with.branches');

// Rotas de autenticação
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
    // Rota para logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// //CRIANDO O ADMIN
// Route::get('/create-admin', function () {
//     if (!User::where('email', 'admin@example.com')->exists())

//  {
//         User::create([
//             'name' => 'Renatag',
//             'email' => 'devrenatagodoy@gmail.com',
//             'password' => Hash::make('123456'), 
//         ]);

//         return 'Admin criado com sucesso!';
//     }

//     return 'Usuário Admin já existe!';
// });