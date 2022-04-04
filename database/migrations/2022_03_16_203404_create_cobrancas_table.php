<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cobrancas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cobranca_id')->unique();
            $table->uuid('uuid')->unique();
            $table->uuid('banco_id');
            $table->string('cliente_nome');
            $table->string('cliente_documento', 30)->nullable();
            $table->date('vencimento');
            $table->unsignedDouble('valor');
            $table->unsignedBigInteger('numero_banco')->nullable();
            $table->string('operacao');
            $table->index(['banco_id', 'numero_banco']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cobrancas');
    }
};
