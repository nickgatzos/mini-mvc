<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 28/01/2018
 * Time: 12:02
 */

class Home extends Controller
{
    protected $dir = ''; //! EDIT THIS. POINT TO DIRECTORY THAT HOLDS `app` IF YOU KEEP IT 1 FOLDER DOWN. ELSE ASSIGN $_SERVER['DOCUMENT_ROOT'] VALUE

    public function __construct()
    {


    }

    public function index()
    {

        // The assoc. array should have its keys and values exactly the same.
        // The values are used as identifiers in $LNG assoc array.
        $this->view('home/index', ['site_title' => 'site_title', 'site_desc' => 'site_desc']);

    }

    public function test()
    {
        echo "This is the test() method";
        $this->view('home/test', ['test_key' => 'test_key']);
    }
}