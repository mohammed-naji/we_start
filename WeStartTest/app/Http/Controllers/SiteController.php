<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $name = 'Mohammed';
        $age = 28;

        $users = [
            ['id' => 1, 'name' => 'Mohammed', 'email' => 'moh@gmail.com'],
            ['id' => 2, 'name' => 'Ali', 'email' => 'ali@gmail.com'],
            ['id' => 3, 'name' => 'Amal', 'email' => 'amal@gmail.com']
        ];

        // dd(count($users));

        // var_dump($users);
        // exit;

        // dd($users);

        // return view('index')->with('name', $name)->with('age', $age);
        // compact('name', 'age')
        // [
        //     'name' => $name,
        //     'age' => $age
        // ]

        // return view('index', compact('name', 'age'));
        return view('index', [
            'abc' => $name,
            'my_age' => $age,
            'users' => $users
        ]);
    }

    public function about()
    {
        return 'about page';
    }

    public function contact()
    {
        return 'contact page';
    }

    public function team()
    {
        return 'team page';
    }

    public function services()
    {
        return 'services page';
    }

    public function services_single($id = null)
    {
        return 'Service ' . $id;
    }
}
