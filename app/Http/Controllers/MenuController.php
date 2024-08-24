<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        if(auth()->user()->role_id == 1) {
            return  [
                [
                    'items' => [
                        [
                            'label' => 'Dashboard',
                            'icon' => 'pi pi-fw pi-home',
                            'to' => '/'
                        ],
                        [
                            'label' => 'User',
                            'icon' => 'pi pi-fw pi-user',
                            'to' => '/users'
                        ]
                    ]
                ]
            ];

        }
        return [
            [
                'items' => [
                    [
                        'label' => 'Dashboard',
                        'icon' => 'pi pi-fw pi-home',
                        'to' => '/'
                    ],
                    [
                        'label' => 'Projects',
                        'icon' => 'pi pi-fw pi-list',
                        'to' => '/projects'
                    ],
                    [
                        'label' => 'Tasks',
                        'icon' => 'pi pi-fw pi-check-square',
                        'to' => '/tasks'
                    ],
                ]
            ]
        ];

    }
}
