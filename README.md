Ambiente:

    docker build --no-cache -t webapps .
    docker compose up 
    cp .env.example .env
    docker exec -it webapps composer install
    docker exec -it webapps php artisan key:generate
    docker exec -it webapps php artisan migrate

Usuário de teste:

    docker exec -it webapps php artisan tinker

    $user = new \App\Models\User;
    $user->email = 'admin@admin.com';
    $user->name = 'admin';
    $user->codpes = 0;
    $user->password = Hash::make('admin');
    $user->local = true;
    \Spatie\Permission\Models\Permission::findOrCreate('admin', 'senhaunica');
    $user->givePermissionTo('admin');
    $user->save();

Acessar http://localhost:8000/loginlocal