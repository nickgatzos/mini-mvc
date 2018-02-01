<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 28/01/2018
 * Time: 11:58
 * Description: Controller class. Core functionality for communication between Model and View
 */



class Controller
{
    protected $dir = '/Applications/XAMPP/xamppfiles/htdocs/coursemates/source/'; //! EDIT THIS. POINT TO DIRECTORY THAT HOLDS `app`

    protected function model($model)
    {
        require_once "{$this->dir}/app/models/{$model}.php";
        return new $model();
    }

    protected function view($view, $data) {
        //--------------//
        // LOCALIZATION //
        //--------------//

        // Check if localization cookie is set. If not, set a cookie and use the default language.
        if (!isset($_COOKIE['locale'])) {
            setcookie('locale', 'en_UK');
            require_once "{$this->dir}/app/languages/en_UK.php";
        } else {
            // Otherwise, require the appropriate localization file
            require_once "{$this->dir}/app/languages/{$_COOKIE['locale']}.php";
        }


        //-----------------------------------//
        // Request the appropriate view file //
        //-----------------------------------//
        require_once "{$this->dir}/app/views/{$view}.php";
    }
}
