<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('job');
            $table->string('description');
            $table->string('country');
            $table->string('city');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();//est une fonctionnalité de sécurité courante utilisée dans les systèmes d'authentification. Il est généralement utilisé pour maintenir la session d'un utilisateur authentifié ouvert, même après la fermeture du navigateur. 
            $table->foreignId('current_team_id')->nullable();
            $table->text('profile_photo_path')->unique();
            $table->timestamps();//est couramment utilisée dans les migrations de bases de données dans le framework Laravel. Elle permet de créer automatiquement deux colonnes dans une table de base de données : created_at (date de création) et updated_at (date de mise à jour).
            $table->tinyInteger('role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
