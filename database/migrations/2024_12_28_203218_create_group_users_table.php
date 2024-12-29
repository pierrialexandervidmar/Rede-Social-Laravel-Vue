<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('group_users', function (Blueprint $table) {
            $table->id();
            
            // status se o usuário é permitido ou não no grupo | approved, pending
            $table->string('status', 25); 
            $table->string('role', 25); // admin, user
            
            // token que será enviado na url de convite que o admin encaminhará via email ao usuário
            // campo pode ser nulo, pois o grupo pode ter aprovação automática também.
            $table->string('token', 1024)->nullable();

            $table->timestamp('token_expire_date')->nullable();
            $table->timestamp('token_used')->nullable(); // quando aprovado, registra a data da aprovação
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('group_id')->constrained('groups');
            $table->foreignId('created_by')->constrained('users');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_users');
    }
};
