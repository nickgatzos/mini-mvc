<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 28/01/2018
 * Time: 11:42
 * Description: App class
 */

class App
{
    protected $controller = 'home';  // Default controller
    protected $method = 'index';        // Default controller method
    protected $params = [];             // Default parameters (/[param1]/[param2])
    protected $error = ['404' => 'Error404']; // Assign HTTP error codes to appropriate controller pages
    protected $dir = ''; //! EDIT THIS. POINT TO DIRECTORY THAT HOLDS `app` IF YOU KEEP IT 1 FOLDER DOWN. ELSE ASSIGN $_SERVER['DOCUMENT_ROOT'] VALUE

    // Bootstrap method
    public function __construct()
    {

        $url = $this->parseUrl(); // Parse URL

        // Check if $url is set. If not, redirect to home.
        if (!isset($url)) {
            header('Location: home', true, 301);
        }

        // Check if Controller exists
        if (file_exists("{$this->dir}/app/controllers/" . ucfirst($url[0]) . ".php")) {
            // If exists, set the controller to the $url[0] value
            $this->controller = ucfirst($url[0]);

            // Require that specific Controller
            require_once "{$this->dir}/app/controllers/" . ucfirst($this->controller) . ".php";

            //! Just echoing current controller
//!            echo '| Controller: ' . $this->controller;

            // New instance of controller
            $this->controller = new $this->controller();


            // Check if Method inside Controller instance exists
            if (isset($url[1])) {

                // If the Method specified in $url[1] value exists
                if (method_exists($this->controller, $url[1])) {

                    // Check if $url[1] contains value 'view' or 'model' / ! Inheritance issues with Controller.php (protected/public)
                    // If index is selected, set Controller to Error404 and display error message. Index will only be visible when no method is used.
                    if (strtolower($url[1]) == 'view' || strtolower($url[1]) == 'model' || strtolower($url[1]) == 'index') {

                        // If so, set Controller to Error404 and display error page
                        $this->controller = $this->error['404'];
                        require_once "{$this->dir}/app/controllers/{$this->controller}.php";
                        $this->controller = new $this->controller(); // New instance of Controller

                    } else {
                        // Otherwise, proceed with retrieving the method and if need be, parse params
                        // Set the current Method value to $url[1] value
                        $this->method = $url[1];
//!                    echo " | Method: {$this->method} | ";

                        // Check if the $url array length is higher than 2 (controller/index/[param])
                        if (count($url) > 2) {
                            $params_url = array_slice($url, 2); // Set params_url to include every param except for Controller and Method;
                            $this->params = $params_url ? array_values($params_url) : [];

//!                        print_r($params_url);
                        }

                        call_user_func_array([$this->controller, $this->method], $this->params);
                    }
                } else {
//!                 // Set Controller to Error404 and display error page
                    $this->controller = $this->error['404'];
                    require_once "{$this->dir}/app/controllers/{$this->controller}.php";
                    $this->controller = new $this->controller(); // New instance of Controller
                }
            } else {
                $this->method = 'index';
                call_user_func([$this->controller, $this->method]);
            }

        // If Controller doesn't exist, set the Controller to 404
        } else {
            $this->controller = $this->error['404'];
            require_once "{$this->dir}/app/controllers/{$this->controller}.php";
            $this->controller = new $this->controller(); // New instance of Controller

        }

    }

    // Parses URL
    public function parseUrl()
    {
        // Checks if url is set.
        if (isset($_GET['url'])) {
            // Returns URL that is exploded, trimmed off trailing / and sanitised
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }


}