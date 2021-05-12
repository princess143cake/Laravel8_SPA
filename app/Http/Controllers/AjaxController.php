<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\File;
use Illuminate\Support\Facades\Storage;

class AjaxController extends Controller
{


    public function home()
    {
        return view('home.home');
    }

    public function inbound()
    {
        return view('inbound.inbound');
    }

    public function outbound()
    {
        return view('outbound.outbound');
    }



    public function ajax()
    {



        if (isset($_GET['call_type'])) {
            $call_type = $_GET['call_type'];

          
           
           
            $modalUser = view("layouts.modal.modal-user")->render();
            $activeHomeMenu = view("layouts.menu_active.active-home-menu")->render();
            $activeInboundMenu = view("layouts.menu_active.active-inbound-menu")->render();
            $activeOutboundMenu = view("layouts.menu_active.active-outbound-menu")->render();
            $script = view("layouts.script")->render();

            if ($call_type == "inbound") {

                $html = view("inbound.inbound")->render();
                echo json_encode(array(
                    'status' => 'success',
                    'title' => 'Inbound',
                    'description' => 'Inbound',
                    'url' => 'http://127.0.0.1:8000/inbound',
                    'menu' => $activeInboundMenu,
                    'active' => 'active',
                    'modal_user' => $modalUser,
                    'script' => $script,
                    
                    'data'=>   $html, // Get a content from $request->code
          
                    // 'data' => 'This is <strong>Inbound</strong> data coming from ajax url'
                ));
            } 

            else if ($call_type == "outbound") {

                //dd('php');
                $html = view("outbound.outbound")->render();
                echo json_encode(array(
                    'status' => 'success',
                    'title' => 'Outbound',
                    'description' => 'PHP description',
                    'menu' => $activeOutboundMenu,
                    'url' => 'http://127.0.0.1:8000/outbound',
                    'data'=>   $html, // Get a content from $request->code
          
                    // 'data' => 'This is <strong>PHP</strong> data coming from ajax url'
                ));
            } else if ($call_type == "home") {

                $html = view("home.home")->render();
                echo json_encode(array(
                    'status' => 'success',
                    'title' => 'Home',
                    'description' => 'Home description',
                    'url' => 'http://127.0.0.1:8000/home',
                    'data'=>   $html, // Get a content from $request->code
                    'menu' =>$activeHomeMenu,
                    // 'data' => 'This is <strong>Home</strong> data coming from ajax url'
                ));
            } 
        }
    }
}
