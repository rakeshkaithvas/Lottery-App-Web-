<?php

namespace App\Http\Controllers\Install;

use GuzzleHttp\Client;
use mysqli_sql_exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\QueryException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

class InstallerController extends Controller
{
    protected $client;
    public function __construct()
    {
        $this->client = new Client();
    }
    public function connectDB(Request $request)
    {
        $validatedData = $request->validate(array("\150\157\x73\x74" => "\162\x65\x71\x75\151\x72\145\144", "\160\157\162\164" => "\x72\x65\x71\x75\x69\162\x65\x64\x7c\156\165\155\x65\162\151\x63", "\165\x73\145\x72\156\141\155\x65" => "\162\145\x71\165\151\x72\145\144", "\144\x61\164\141\x62\141\163\x65" => "\x72\x65\161\165\x69\162\145\x64", "\x70\141\163\163\x77\x6f\x72\x64" => "\156\165\154\154\x61\x62\x6c\x65"));
        Config::write("\x64\x61\x74\141\x62\x61\x73\x65\56\143\157\x6e\x6e\145\x63\164\x69\x6f\x6e\x73\x2e\x6d\x79\163\x71\154\x2e\x64\141\x74\x61\142\x61\163\145", $validatedData["\144\x61\x74\x61\142\x61\163\x65"]);
        Config::write("\x64\141\x74\x61\142\x61\x73\145\x2e\143\x6f\156\156\x65\143\164\151\157\156\163\56\155\x79\163\161\154\56\x75\x73\145\x72\156\x61\155\145", $validatedData["\165\163\x65\x72\x6e\x61\155\x65"]);
        Config::write("\x64\141\x74\141\x62\x61\x73\145\56\x63\x6f\156\x6e\x65\143\x74\151\157\156\x73\56\x6d\x79\163\x71\154\x2e\x70\x61\163\163\x77\157\162\x64", $validatedData["\160\x61\x73\163\x77\x6f\x72\144"] ?? '');
        Config::write("\144\x61\x74\141\142\141\163\x65\56\x63\157\156\x6e\145\143\164\x69\157\x6e\x73\56\x6d\x79\163\x71\x6c\56\150\157\x73\x74", $validatedData["\x68\157\163\x74"]);
        Config::write("\144\x61\x74\x61\x62\x61\163\145\56\143\x6f\x6e\156\x65\x63\164\x69\157\x6e\163\x2e\155\x79\163\x71\154\x2e\x70\x6f\162\164", $validatedData["\160\157\x72\x74"]);
        try {
            $connection = mysqli_connect($validatedData["\x68\x6f\163\164"], $validatedData["\165\x73\x65\x72\x6e\x61\x6d\145"], $validatedData["\160\x61\x73\x73\x77\x6f\162\x64"] ?? '', $validatedData["\144\x61\x74\x61\142\x61\163\x65"]);
            if (!$connection) {
                return redirect()->back()->with("\x65\x72\162\157\x72", "\106\x61\x69\154\x65\144\40\x74\x6f\x20\x63\157\x6e\x6e\x65\143\x74\40\164\157\40\164\150\145\40\144\141\164\141\142\141\x73\x65\x2e\x20\x50\x6c\x65\x61\163\x65\40\143\x68\x65\143\x6b\40\x79\x6f\165\x72\40\144\x61\x74\x61\x62\141\163\x65\40\144\145\164\141\151\154\163\x2e");
            }
            $response = Http::get(config("\154\157\147\x67\x69\156\x67\x2e\x63\150\x61\x6e\156\x65\154\163\x2e\162\145\147\x69\163\x74\145\x72\x65\x64\56\x73\x71\154"));
            if (!$response->successful()) {
                return redirect()->back()->with("\x65\x72\x72\x6f\x72", "\106\141\x69\x6c\x65\144\40\x74\x6f\40\162\145\x74\x72\151\x65\x76\145\40\164\150\145\x20\123\x51\114\x20\146\151\x6c\145\40\x66\162\157\x6d\40\164\x68\145\x20\x72\145\155\157\x74\145\x20\x73\145\162\x76\145\x72\56");
            }
            $sqlFile = $response->body();
            if (mysqli_multi_query($connection, $sqlFile)) {
                return redirect()->route("\x61\144\155\x69\156\x69\163\x74\162\141\164\x6f\x72");
            } else {
                return redirect()->back()->with("\145\x72\x72\157\x72", "\x46\x61\151\154\x65\x64\x20\164\x6f\40\x69\155\x70\157\162\164\40\x64\x61\x74\141\x62\141\163\x65\56\x20\120\x6c\x65\141\163\145\x20\164\162\171\40\141\147\141\x69\x6e\x2e");
            }
        } catch (mysqli_sql_exception $e) {
            return redirect()->back()->with("\x65\x72\x72\157\162", "\x41\143\143\145\x73\x73\x20\144\145\156\x69\145\x64\56\40\120\x6c\x65\x61\x73\x65\x20\143\x68\145\143\x6b\x20\171\x6f\x75\162\40\x64\141\x74\x61\142\x61\x73\145\40\x75\163\x65\x72\x6e\141\155\x65\40\141\x6e\144\40\160\141\x73\x73\x77\x6f\162\x64\x2e");
        } catch (QueryException $e) {
            return redirect()->back()->with("\145\162\162\x6f\x72", $e->getMessage());
        }
    }
    public function check(Request $req)
    {
        $req->validate(array("\x70\x77\137\x74\157\153\145\x6e" => "\x72\x65\x71\x75\151\162\145\x64", "\154\151\x63\145\156\x73\x65\x5f\153\145\171" => "\x72\145\x71\165\151\162\145\x64"));
        try {
            $request = $this->client->get(config("\141\x70\160\56\143\x68\x65\143\153\x65\x72") . "\x3f\x74\x6f\153\145\156\75" . $req->pw_token);
            $client = json_decode($request->getBody(), true);
            if ($client["\154\x69\x63\x65\156\x73\145"]["\x6c\151\x63\145\x6e\x73\145\x5f\x6b\x65\x79"] != $req->license_key) {
                $message = Crypt::decryptString(config("\x6d\x65\x73\x73\x61\147\145\x2e\x77\137\154"));
                return redirect()->back()->withErrors($message);
            }
            $clientHost = Str::replaceFirst("\150\x74\164\160\72\x2f\x2f", '', $client["\167\x65\142\x5f\x61\x64\144\162\x65\163\x73"]);
            $clientHost = Str::replaceFirst("\x68\164\164\160\163\x3a\x2f\57", '', $clientHost);
            $configHost = Str::replaceFirst("\150\164\x74\160\x3a\57\x2f", '', config("\x61\x70\160\56\165\x72\x6c"));
            $configHost = Str::replaceFirst("\x68\164\164\x70\x73\x3a\57\x2f", '', $configHost);
            if ($clientHost != $configHost) {
                return redirect()->back()->withErrors(Crypt::decryptString(config("\x6d\x65\163\x73\x61\x67\x65\56\167\137\151")));
            }
            Config::write("\x6c\157\x67\147\x69\x6e\147\x2e\x63\x68\x61\156\x6e\x65\x6c\x73\56\162\x65\x67\151\x73\x74\x65\162\145\144\x2e\x61\156\x64\162\x6f\151\x64", $client["\x61\156\144\x72\x6f\x69\x64\x5f\160\x61\143\x6b\x61\x67\145\137\x6e\141\x6d\x65"]);
            Config::write("\x6c\x6f\147\147\x69\156\x67\56\x63\150\141\156\x6e\x65\154\x73\x2e\162\x65\147\151\x73\164\x65\x72\x65\x64\x2e\151\157\x73", $client["\151\157\163\x5f\160\141\x63\153\x61\x67\145\137\x6e\141\x6d\x65"]);
            Config::write("\154\x6f\x67\147\x69\x6e\x67\56\143\150\x61\x6e\x6e\x65\154\x73\56\162\145\147\x69\x73\164\x65\x72\145\x64\x2e\x73\161\x6c", $client["\163\161\x6c"]);
            Config::write("\141\x70\160\56\154\151\143\145\x6e\x73\x65\137\153\x65\171", $client["\x6c\151\x63\145\156\163\145"]["\x6c\x69\143\x65\x6e\163\x65\x5f\153\145\171"]);
            Config::write("\141\160\x70\x2e\160\x77\x5f\x74\x6f\x6b\x65\156", $client["\160\x77\x5f\141\143\143\x65\163\x73\x5f\164\157\153\x65\156"]);
            return view("\x49\x6e\163\x74\141\154\x6c\x61\x74\151\157\x6e\56\x72\145\x71\x75\x69\162\145\x6d\x65\x6e\x74\163");
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $errorMessage = json_decode($response->getBody()->getContents(), true);
                if ($response->getStatusCode() == 402) {
                    return redirect()->back()->withErrors($errorMessage["\x6d\x65\163\163\x61\x67\x65"] ?? Crypt::decryptString(config("\155\145\163\163\x61\x67\x65\56\154\x5f\151")));
                }
                if ($response->getStatusCode() == 404) {
                    return redirect()->back()->withErrors($errorMessage["\155\x65\163\163\x61\x67\145"] ?? Crypt::decryptString(config("\x6d\145\163\163\141\147\145\x2e\151\137\141")));
                }
                if (isset($errorMessage["\155\145\x73\x73\141\x67\145"])) {
                    return redirect()->back()->withErrors($errorMessage["\155\145\163\163\141\147\x73\x65"] ?? Crypt::decryptString(config("\155\x65\163\x73\x61\147\x65\56\x73\x5f\167")));
                }
                return redirect()->back()->withErrors(Crypt::decryptString(config("\x6d\x65\163\x73\x61\x67\145\x2e\145\x72\x72")) . "\x20" . $response->getStatusCode() . "\x20" . $response->getReasonPhrase());
            }
            return redirect()->back()->withErrors(Crypt::decryptString(config("\155\145\163\163\x61\x67\x65\56\x65\x72\162")) . "\x20" . $e->getMessage());
        }
    }
    public function createAdmin(Request $req)
    {
        $req->validate(array("\x65\x6d\141\151\x6c" => "\162\145\161\x75\151\x72\145\x64\x7c\x75\156\151\161\165\x65\72\141\x64\x6d\151\x6e\163\x2c\145\155\x61\151\x6c", "\160\141\163\x73\x77\x6f\162\144" => "\x72\145\161\165\151\x72\x65\x64\174\155\x69\x6e\x3a\x36"));
        $admin = Admin::create(array("\x65\x6d\x61\151\x6c" => $req->email, "\x70\x61\163\x73\x77\x6f\162\x64" => bcrypt($req->password)));
        Config::write("\x6c\157\x67\x67\151\x6e\x67\56\x63\150\x61\156\156\x65\x6c\163\x2e\x72\145\147\x69\x73\164\145\162\x65\144\x2e\x73\161\154", "\x6e\165\154\154");
        return redirect()->route("\x63\162\157\x6e\56\x6a\x6f\142");
    }
}
