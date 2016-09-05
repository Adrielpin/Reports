<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Models\Config_email;
use Mail;
use Crypt;
use Request;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia e-mail link relatório';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {   

        $confis = Config_email::all();
        $url= getHostByName(getHostName());
        $token = Crypt::encrypt(strtotime('today +1 month'));

        foreach($confis as $conf){

            $conta = Crypt::encrypt($conf->conta);
            $periodo = Crypt::encrypt($conf->periodo);
            $tipo = Crypt::encrypt($conf->tipo);

            $attach = 'token='.$token.'&a='.$conta.'&b='.$periodo.'&c='.$tipo;

            $link = $url.'/relatorio/view?'.$attach;

            Mail::send('emails.welcome',['attach'=>$link, 'texto'=>$conf->texto], function ($message) {
                $message->from('adriel.pinheiro@clinks.com.br', 'teste com banco de dados');
                $message->to('adriel.pinheiro@clinks.com.br', 'Adriel Pinheiro');
                $message->subject('Relatório de desempenho com db');
            });

        }
    }
}
