<?php

namespace Softbengalltd\Larainitializer\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Softbengalltd\Larainitializer\Helpers\EnvWriter;



class LarainitializerController extends BaseController
{
    public function create($step)
    {
        switch ($step) {
            case 'basic':
                return view('larainitializer::basic', ['locales' => EnvWriter::get_locale_array()]);
                break;
            case 'email':
                return view('larainitializer::email');
                break;
            case 'database':
                return view('larainitializer::database');
                break;
        }
    }

    public function store(Request $request)
    {
        if ($request->step == 'basic') {
            $validated = $request->validate([
                'app_name' => 'required|max:255',
                'app_locale' => 'required'
            ]);
            EnvWriter::setEnvValue('APP_NAME', $validated['app_name']);
            EnvWriter::setEnvValue('APP_LOCALE', $validated['app_locale']);
            return redirect()->route('squartup.setup.form', ['email']);
        } elseif ($request->step == 'email') {
            $validated = $request->validate([
                'mail_username' => 'required|max:255',
                'mail_password' => 'required',
                'mail_from_address' => 'required'
            ]);
            EnvWriter::setEnvValue('MAIL_USERNAME', $validated['mail_username']);
            EnvWriter::setEnvValue('MAIL_PASSWORD', $validated['mail_password']);
            EnvWriter::setEnvValue('MAIL_FROM_ADDRESS', $validated['mail_from_address']);
            return redirect()->route('squartup.setup.form', ['database']);
        } elseif ($request->step == 'database') {
            if ($request->db_connection == 'mysql') {
                $validated = $request->validate([
                    'db_connection' => 'required',
                    'db_host' => 'required',
                    'db_port' => 'required',
                    'db_database' => 'required',
                    'db_username' => 'required',
                    'db_password' => 'nullable'
                ]);

                EnvWriter::setEnvValue('DB_CONNECTION', $validated['db_connection']);
                EnvWriter::setEnvValue('DB_HOST', $validated['db_host']);
                EnvWriter::setEnvValue('DB_PORT', $validated['db_port']);
                EnvWriter::setEnvValue('DB_DATABASE', $validated['db_database']);
                EnvWriter::setEnvValue('DB_USERNAME', $validated['db_username']);
                EnvWriter::setEnvValue('DB_PASSWORD', $validated['db_password']);
                return redirect()->back()->with('success', 'Sqlite database creaed');
            } elseif ($request->db_connection == 'sqlite') {
                EnvWriter::removeEnvValue('DB_HOST');
                EnvWriter::removeEnvValue('DB_PORT');
                EnvWriter::removeEnvValue('DB_DATABASE');
                EnvWriter::removeEnvValue('DB_USERNAME');
                EnvWriter::removeEnvValue('DB_PASSWORD');
                EnvWriter::setEnvValue('DB_CONNECTION', 'sqlite');
                return redirect()->back()->with('success', 'Sqlite database creaed');
            }
        }





    }

}
