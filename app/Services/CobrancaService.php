<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class CobrancaService
{
    public function sincronizarCobranca($data)
    {
        DB::table('cobrancas');
    }
}
