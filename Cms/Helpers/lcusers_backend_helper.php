<?php

//--------------------------------------------------
if (!function_exists('get_user_types')) {
    /**
     * Ritorna un array di oggetti con i tipi di utenti
     * [
        *      {
        *          'nome' => 'Privato',
        *          'key' => 'privato',
        *      },
        *      ....
     * ]
     */
    function get_user_types()
    {
       $user_types = [
            (object) [  
                'nome' => 'Privato',
                'key' => 'privato',
            ],
            (object) [   
                'nome' => 'Azienda',
                'key' => 'azienda',
            ],
        ];
        return $user_types;
    }
}

