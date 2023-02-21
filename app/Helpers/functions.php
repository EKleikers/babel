<?php
// use Log;

function customCrypt($vWord)
{
    $customKey = "y/B?E(H+MbPeShVmYq3t6w9zXC&F)J@N";
    $newEncrypter = new \Illuminate\Encryption\Encrypter($customKey, Config::get('app.cipher'));
    return $newEncrypter->encrypt($vWord);
}

function customDecrypt($vWord)
{
    $customKey = "y/B?E(H+MbPeShVmYq3t6w9zXC&F)J@N";
    $newEncrypter = new \Illuminate\Encryption\Encrypter($customKey, Config::get('app.cipher'));
    return $newEncrypter->decrypt($vWord);
}
if (!function_exists('base_url')) {

    function base_url($atRoot = FALSE, $atCore = FALSE, $parse = FALSE)
    {
        if (isset($_SERVER['HTTP_HOST'])) {
            $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
            $hostname = $_SERVER['HTTP_HOST'];
            $dir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

            $core = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), NULL, PREG_SPLIT_NO_EMPTY);
            $core = $core[0];

            $tmplt = $atRoot ? ($atCore ? "%s://%s/%s/" : "%s://%s/") : ($atCore ? "%s://%s/%s/" : "%s://%s%s");
            $end = $atRoot ? ($atCore ? $core : $hostname) : ($atCore ? $core : $dir);
            $base_url = sprintf($tmplt, $http, $hostname, $end);
        } else
            $base_url = 'http://localhost/';

        if ($parse) {
            $base_url = parse_url($base_url);
            if (isset($base_url['path']))
                if ($base_url['path'] == '/')
                    $base_url['path'] = '';
        }

        return $base_url;
    }
}

function my_asset($path, $secure = null)
{
    $path = base_url(TRUE) . 'myadmin/resources/themes/metronic/assets/' . $path;
    return $path;
}


function my_pictures($path, $secure = null)
{
    $path = base_url(TRUE) . 'myadmin/public/images/' . $path;
    return $path;
}

function getGlobalThemeCSS($theme)
{
    if (checkX()) {
        $theme = 'white';
    }
    $s = '<link href="' . my_asset('layouts/layout/css/themes/' . $theme . '.css') . '" rel="stylesheet" type="text/css" />';
    return $s;
}

function getSubThemeCSS($theme)
{
    $s = '<link href="' . my_asset('layouts/layout/css/' . $theme . '.css') . '" rel="stylesheet" type="text/css" />';
    return $s;
}

function checkX()
{
    $client = DB::table('client')->first();
    $themeclient = 'blue';
    if ($client != null) {
        $themeclient = $client->defaulttheme;
    }
    if (Auth::user()) {
        $themeuser = Auth::user()->theme;
    } else {
        $themeuser = "loggedout";
    }
    if (($themeuser == "clientdefault" & $themeclient == "appsforcex") | $themeuser == "appsforcex") {
        return true;
    } else {
        return false;
    }
}

function notific8($message)
{
    $messages = [
        'errors' => [
            $message
        ]
    ];
    $messagebag = new \Illuminate\Support\MessageBag($messages);
    return $messagebag;
}

function countries()
{
    $countries = array(
        "AF" => trans('countries.AF'),
        "AX" => trans('countries.AX'),
        "AL" => trans('countries.AL'),
        "DZ" => trans('countries.DZ'),
        "AS" => trans('countries.AS'),
        "AD" => trans('countries.AD'),
        "AO" => trans('countries.AO'),
        "AI" => trans('countries.AI'),
        "AQ" => trans('countries.AQ'),
        "AG" => trans('countries.AG'),
        "AR" => trans('countries.AR'),
        "AM" => trans('countries.AM'),
        "AW" => trans('countries.AW'),
        "AU" => trans('countries.AU'),
        "AT" => trans('countries.AT'),
        "AZ" => trans('countries.AZ'),
        "BS" => trans('countries.BS'),
        "BH" => trans('countries.BH'),
        "BD" => trans('countries.BD'),
        "BB" => trans('countries.BB'),
        "BY" => trans('countries.BY'),
        "BE" => trans('countries.BE'),
        "BZ" => trans('countries.BZ'),
        "BJ" => trans('countries.BJ'),
        "BM" => trans('countries.BM'),
        "BT" => trans('countries.BT'),
        "BO" => trans('countries.BO'),
        "BA" => trans('countries.BA'),
        "BW" => trans('countries.BW'),
        "BV" => trans('countries.BV'),
        "BR" => trans('countries.BR'),
        "IO" => trans('countries.IO'),
        "BN" => trans('countries.BN'),
        "BG" => trans('countries.BG'),
        "BF" => trans('countries.BF'),
        "BI" => trans('countries.BI'),
        "KH" => trans('countries.KH'),
        "CM" => trans('countries.CM'),
        "CA" => trans('countries.CA'),
        "CV" => trans('countries.CV'),
        "KY" => trans('countries.KY'),
        "CF" => trans('countries.CF'),
        "TD" => trans('countries.TD'),
        "CL" => trans('countries.CL'),
        "CN" => trans('countries.CN'),
        "CX" => trans('countries.CX'),
        "CC" => trans('countries.CC'),
        "CO" => trans('countries.CO'),
        "KM" => trans('countries.KM'),
        "CG" => trans('countries.CG'),
        "CD" => trans('countries.CD'),
        "CK" => trans('countries.CK'),
        "CR" => trans('countries.CR'),
        "CI" => trans('countries.CI'),
        "HR" => trans('countries.HR'),
        "CU" => trans('countries.CU'),
        "CY" => trans('countries.CY'),
        "CZ" => trans('countries.CZ'),
        "DK" => trans('countries.DK'),
        "DJ" => trans('countries.DJ'),
        "DM" => trans('countries.DM'),
        "DO" => trans('countries.DO'),
        "EC" => trans('countries.EC'),
        "EG" => trans('countries.EG'),
        "SV" => trans('countries.SV'),
        "GQ" => trans('countries.GQ'),
        "ER" => trans('countries.ER'),
        "EE" => trans('countries.EE'),
        "ET" => trans('countries.ET'),
        "FK" => trans('countries.FK'),
        "FO" => trans('countries.FO'),
        "FJ" => trans('countries.FJ'),
        "FI" => trans('countries.FI'),
        "FR" => trans('countries.FR'),
        "GF" => trans('countries.GF'),
        "PF" => trans('countries.PF'),
        "TF" => trans('countries.TF'),
        "GA" => trans('countries.GA'),
        "GM" => trans('countries.GM'),
        "GE" => trans('countries.GE'),
        "DE" => trans('countries.DE'),
        "GH" => trans('countries.GH'),
        "GI" => trans('countries.GI'),
        "GR" => trans('countries.GR'),
        "GL" => trans('countries.GL'),
        "GD" => trans('countries.GD'),
        "GP" => trans('countries.GP'),
        "GU" => trans('countries.GU'),
        "GT" => trans('countries.GT'),
        "GG" => trans('countries.GG'),
        "GN" => trans('countries.GN'),
        "GW" => trans('countries.GW'),
        "GY" => trans('countries.GY'),
        "HT" => trans('countries.HT'),
        "HM" => trans('countries.HM'),
        "VA" => trans('countries.VA'),
        "HN" => trans('countries.HN'),
        "HK" => trans('countries.HK'),
        "HU" => trans('countries.HU'),
        "IS" => trans('countries.IS'),
        "IN" => trans('countries.IN'),
        "ID" => trans('countries.ID'),
        "IR" => trans('countries.IR'),
        "IQ" => trans('countries.IQ'),
        "IE" => trans('countries.IE'),
        "IM" => trans('countries.IM'),
        "IL" => trans('countries.IL'),
        "IT" => trans('countries.IT'),
        "JM" => trans('countries.JM'),
        "JP" => trans('countries.JP'),
        "JE" => trans('countries.JE'),
        "JO" => trans('countries.JO'),
        "KZ" => trans('countries.KZ'),
        "KE" => trans('countries.KE'),
        "KI" => trans('countries.KI'),
        "KP" => trans('countries.KP'),
        "KR" => trans('countries.KR'),
        "KW" => trans('countries.KW'),
        "KG" => trans('countries.KG'),
        "LA" => trans('countries.LA'),
        "LV" => trans('countries.LV'),
        "LB" => trans('countries.LB'),
        "LS" => trans('countries.LS'),
        "LR" => trans('countries.LR'),
        "LY" => trans('countries.LY'),
        "LI" => trans('countries.LI'),
        "LT" => trans('countries.LT'),
        "LU" => trans('countries.LU'),
        "MO" => trans('countries.MO'),
        "MK" => trans('countries.MK'),
        "MG" => trans('countries.MG'),
        "MW" => trans('countries.MW'),
        "MY" => trans('countries.MY'),
        "MV" => trans('countries.MV'),
        "ML" => trans('countries.ML'),
        "MT" => trans('countries.MT'),
        "MH" => trans('countries.MH'),
        "MQ" => trans('countries.MQ'),
        "MR" => trans('countries.MR'),
        "MU" => trans('countries.MU'),
        "YT" => trans('countries.YT'),
        "MX" => trans('countries.MX'),
        "FM" => trans('countries.FM'),
        "MD" => trans('countries.MD'),
        "MC" => trans('countries.MC'),
        "MN" => trans('countries.MN'),
        "ME" => trans('countries.ME'),
        "MS" => trans('countries.MS'),
        "MA" => trans('countries.MA'),
        "MZ" => trans('countries.MZ'),
        "MM" => trans('countries.MM'),
        "NA" => trans('countries.NA'),
        "NR" => trans('countries.NR'),
        "NP" => trans('countries.NP'),
        "NL" => trans('countries.NL'),
        "AN" => trans('countries.AN'),
        "NC" => trans('countries.NC'),
        "NZ" => trans('countries.NZ'),
        "NI" => trans('countries.NI'),
        "NE" => trans('countries.NE'),
        "NG" => trans('countries.NG'),
        "NU" => trans('countries.NU'),
        "NF" => trans('countries.NF'),
        "MP" => trans('countries.MP'),
        "NO" => trans('countries.NO'),
        "OM" => trans('countries.OM'),
        "PK" => trans('countries.PK'),
        "PW" => trans('countries.PW'),
        "PS" => trans('countries.PS'),
        "PA" => trans('countries.PA'),
        "PG" => trans('countries.PG'),
        "PY" => trans('countries.PY'),
        "PE" => trans('countries.PE'),
        "PH" => trans('countries.PH'),
        "PN" => trans('countries.PN'),
        "PL" => trans('countries.PL'),
        "PT" => trans('countries.PT'),
        "PR" => trans('countries.PR'),
        "QA" => trans('countries.QA'),
        "RE" => trans('countries.RE'),
        "RO" => trans('countries.RO'),
        "RU" => trans('countries.RU'),
        "RW" => trans('countries.RW'),
        "SH" => trans('countries.SH'),
        "KN" => trans('countries.KN'),
        "LC" => trans('countries.LC'),
        "PM" => trans('countries.PM'),
        "VC" => trans('countries.VC'),
        "WS" => trans('countries.WS'),
        "SM" => trans('countries.SM'),
        "ST" => trans('countries.ST'),
        "SA" => trans('countries.SA'),
        "SN" => trans('countries.SN'),
        "RS" => trans('countries.RS'),
        "SC" => trans('countries.SC'),
        "SL" => trans('countries.SL'),
        "SG" => trans('countries.SG'),
        "SK" => trans('countries.SK'),
        "SI" => trans('countries.SI'),
        "SB" => trans('countries.SB'),
        "SO" => trans('countries.SO'),
        "ZA" => trans('countries.ZA'),
        "GS" => trans('countries.GS'),
        "ES" => trans('countries.ES'),
        "LK" => trans('countries.LK'),
        "SD" => trans('countries.SD'),
        "SR" => trans('countries.SR'),
        "SJ" => trans('countries.SJ'),
        "SZ" => trans('countries.SZ'),
        "SE" => trans('countries.SE'),
        "CH" => trans('countries.CH'),
        "SY" => trans('countries.SY'),
        "TW" => trans('countries.TW'),
        "TJ" => trans('countries.TJ'),
        "TZ" => trans('countries.TZ'),
        "TH" => trans('countries.TH'),
        "TL" => trans('countries.TL'),
        "TG" => trans('countries.TG'),
        "TK" => trans('countries.TK'),
        "TO" => trans('countries.TO'),
        "TT" => trans('countries.TT'),
        "TN" => trans('countries.TN'),
        "TR" => trans('countries.TR'),
        "TM" => trans('countries.TM'),
        "TC" => trans('countries.TC'),
        "TV" => trans('countries.TV'),
        "UG" => trans('countries.UG'),
        "UA" => trans('countries.UA'),
        "AE" => trans('countries.AE'),
        "GB" => trans('countries.GB'),
        "US" => trans('countries.US'),
        "UM" => trans('countries.EM'),
        "UY" => trans('countries.UY'),
        "UZ" => trans('countries.UZ'),
        "VU" => trans('countries.VU'),
        "VE" => trans('countries.VE'),
        "VN" => trans('countries.VN'),
        "VG" => trans('countries.VG'),
        "VI" => trans('countries.VI'),
        "WF" => trans('countries.WF'),
        "EH" => trans('countries.EH'),
        "YE" => trans('countries.YE'),
        "ZM" => trans('countries.ZM'),
        "ZW" => trans('countries.ZW')
    );
    return $countries;
}







