<?php

namespace App\Helpers;

class Helper
{
    public static function applClasses()
    {
        $activeAppID = 100001075;
        $protocol = empty($_SERVER['HTTPS']) === true ? 'http://' : 'https://';
        $x1 = $protocol . $_SERVER['HTTP_HOST'];
        //$x2 = "appsforceframe";
        $menuItem = NULL;
        $adminMenu = array();

        include_once $_SERVER['DOCUMENT_ROOT'] . '/myadmin/resources/helpers/helper.php';

        // retrieving logged in user and selected language. 
        $appsforceresponse = callAppsForceAPI($activeAppID, 'user');
        // retrieving system language. 
        
        $systlanguage = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

        if ($appsforceresponse == null) {
            header('Location: /issue?message=Error accessing User APIs');
            die();
        }
        if ($appsforceresponse['code'] != '200') {
            header('Location: /login');
            die();
        }
        $language = $appsforceresponse['data']['language'];

        if ($language == 'en' || $language == 'fr' || $language == 'de' || $language == 'it' || $language == 'hr' || $language == 'es' || $language == 'nl' || $language == 'sr') {
            $language = $language;
        } else if ($systlanguage == 'en' || $systlanguage == 'fr' || $systlanguage == 'de' || $systlanguage == 'it' || $systlanguage == 'hr' || $systlanguage == 'es' || $systlanguage == 'nl' || $systlanguage == 'sr') {
            $language = $systlanguage;
        } else {
            $language = 'en';
        }

        $lang = array(
            array(1 => 'en', 2 => 'fr', 3 => 'de', 4 => 'it', 5 => 'hr', 6 => 'es', 7 => 'nl', 8 => 'sr'),
            array('en' => 'Home',),
            array('en' => 'News', 'fr' => 'Nouvelles', 'de' => 'Nachrichten', 'it' => 'Notizia', 'hr' => 'Hírek', 'es' => 'Noticias', 'nl' => 'Nieuws'),
        );

        //Home
        $menuItem['badge'] = NULL;
        $menuItem['icon'] = NULL;
        $menuItem['name'] = $lang[1][$language];
        $menuItem['link'] = '/babel/home';
        $menuItem['active'] = 1;
        $menuItem['badge']['style'] = NULL;
        $menuItem['badge']['text'] = NULL;
        $menuItem['children'] = NULL;
        $adminMenu[] = $menuItem;
        
        //News
        $menuItem['badge'] = NULL;
        $menuItem['icon'] = NULL;
        $menuItem['name'] = $lang[2][$language];
        $menuItem['link'] = '/babel/news';
        $menuItem['active'] = 1;
        $menuItem['badge']['style'] = NULL;
        $menuItem['badge']['text'] = NULL;
        $menuItem['children'] = NULL;
        $adminMenu[] = $menuItem;

        $string = base64_encode(serialize($adminMenu));


        if (!isset($head, $topbar, $leftbar, $scripts, $footer, $appsforceresponse, $roleresponse)) {

            $head = callAppsForceAPI($activeAppID, 'include/head', 1);
            $topbar = callAppsForcePostAPI($activeAppID, 'includeMenu/topbar', $string, 1);
            $leftbar = callAppsForcePostAPI($activeAppID, 'includeMenu/leftbar', $string, 1);
            $scripts = callAppsForceAPI($activeAppID, 'include/scripts', 1);
            $footer = callAppsForceAPI($activeAppID, 'include/footer', 1);

            $appsforceresponse = callAppsForceAPI($activeAppID, 'user');
            $roleresponse = callAppsForceAPI($activeAppID, 'user/role');
        }

        if ($head == null | $topbar == null | $leftbar == null | $scripts == null | $footer == null | $appsforceresponse == null) {
            header('Location: /issue?message=Error accessing Graphics APIs 1st');
            die();
        }
        if ($head['code'] != '200' | $topbar['code'] != '200' | $leftbar['code'] != '200' | $scripts['code'] != '200' | $footer['code'] != '200'  | $appsforceresponse['code'] != '200') {
            header('Location: /login');
            die();
        }
        $head = $head['data'];
        $topbar = $topbar['data'];
        $leftbar = $leftbar['data'];
        $scripts = $scripts['data'];
        $footer = $footer['data'];
        $meta_tags = getMetaTags($head);
        $vuexyLeftbarCollapsed = $meta_tags["vuexyLeftbarCollapsed"];
        $vuexyThemeValue = $meta_tags["vuexyThemeValue"];
        $user = \Auth::user();
        if ($roleresponse["data"] != $user->role) {
            $user->role = $roleresponse["data"];
            $user->save();
        }
        $config = [
            'vuexyThemeValue' => $vuexyThemeValue,
            'vuexyLeftbarCollapsed' => $vuexyLeftbarCollapsed,
            'head' => $head,
            'topbar' => $topbar,
            'leftbar' => $leftbar,
            'scripts' => $scripts,
            'footer' => $footer,
        ];
        return $config;
    }
}
