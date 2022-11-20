<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use App\Filters\LoginFilter;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        // 'csrf'     => CSRF::class,
        'toolbar'  => DebugToolbar::class,
        'honeypot' => Honeypot::class,
        'isLoggedIn' => LoginFilter::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            // 'honeypot',
            // 'csrf' => ['except' => ['Notification']],
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['csrf', 'throttle']
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [
        'isLoggedIn' => ['before' =>
            [
                '/',
                '/home',
                '/proposal',
                '/pengajuan-proposal',
                '/jobsheet',
                '/alat',
                '/edit-alat/(:num)',
                '/delete-alat/(:num)',
                '/laporan-jobsheet',
                '/bahan',
                '/edit-bahan/(:num)',
                '/delete-bahan/(:num)',
                '/langkah-kerja',
                '/edit-langkah/(:num)',
                '/delete-langkah/(:num)',
                '/logbook',
                '/tambah-logbook',
                '/edit-logbook/(:num)',
                '/detail-logbook/(:num)',
                '/delete-logbook/(:num)',
                '/laporan-logbook',
                '/logbook-kelompok',
                '/prodi',
                '/tambah-prodi',
                '/edit-prodi/(:num)',
                '/delete-prodi/(:num)',
                '/satuan',
                '/tambah-satuan',
                '/edit-satuan/(:num)',
                '/delete-satuan/(:num)',
                '/detail-alat/(:num)',
                '/detail-bahan/(:num)',
                '/detail-langkah-kerja/(:num)',
                '/jobsheet-pdf/(:num)',
                '/detail-logbook-kelompok/(:num)',
                '/logbook-pdf/(:num)',
                '/penilaian',
                '/tambah-penilaian',
                '/edit-penilaian/(:num)',
                '/delete-penilaian/(:num)',
                '/distribusi',
                '/tambah-distribusi',
                '/edit-distribusi/(:num)',
                '/delete-distribusi/(:num)',
                '/manage-users',
                '/tambah-users',
                '/edit-users/(:num)',
                '/delete-users/(:num)',
                '/setting',
                '/profile',
                '/evaluasi',
                '/laporan-evaluasi',
            ]
        ]
    ];
}
