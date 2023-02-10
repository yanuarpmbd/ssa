<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Table Columns
    |--------------------------------------------------------------------------
    */

    'column.name' => 'Nama',
    'column.guard_name' => 'Nama Guard',
    'column.roles' => 'Roles',
    'column.permissions' => 'Izin',
    'column.updated_at' => 'Dirubah Pada',

    /*
    |--------------------------------------------------------------------------
    | Form Fields
    |--------------------------------------------------------------------------
    */

    'field.name' => 'Nama',
    'field.guard_name' => 'Nama Guard',
    'field.permissions' => 'Izin',
    'field.select_all.name' => 'Pilih Semua',
    'field.select_all.message' => 'Aktifkan semua izin yang <span class="text-primary font-medium">Tersedia</span> untuk Peran ini.',

    /*
    |--------------------------------------------------------------------------
    | Navigation & Resource
    |--------------------------------------------------------------------------
    */

    'nav.group' => 'Pengaturan',
    'nav.role.label' => 'Roles',
    'nav.role.icon' => 'heroicon-o-shield-check',
    'resource.label.role' => 'Role',
    'resource.label.roles' => 'Roles',

    /*
    |--------------------------------------------------------------------------
    | Section & Tabs
    |--------------------------------------------------------------------------
    */
    'section' => 'Entitas',
    'resources' => 'Sumber Daya',
    'widgets' => 'Widget',
    'pages' => 'Halaman',
    'custom' => 'Izin Kustom',

    /**
     * Role Setting Page
     */
    'page' => [
        'name' => 'Pengaturan',
        'icon' => 'heroicon-o-adjustments',
        'save' => 'Simpan',
        'generate' => 'Simpan & Generate'
    ],
    'labels.super_admin.toggle_input' => 'Role Super Admin',
    'labels.super_admin.text_input' => 'Nama Role',
    'labels.filament_user.toggle_input' => 'Role Pengguna',
    'labels.filament_user.text_input' => 'Nama Role',
    'labels.role_policy.toggle_input' => 'Role Policy Terdaftar?',
    'labels.role_policy.message' => 'Pastikan policy terdaftar dan izin dipaksakan',
    'labels.prefixes.placeholder' => 'Awalan Permission Bawaan',
    'labels.prefixes.resource' => 'Resources',
    'labels.prefixes.resource.placeholder' => 'Tambah atau Hapus Izin Resources ...',
    'labels.prefixes.page' => 'Page',
    'labels.prefixes.widget' => 'Widget',
    'labels.entities.placeholder' => 'Generator Permission Entitas & Tab',
    'labels.entities.message' => 'Generator & Tab adalah ',
    'labels.entities.resources' => 'Sumber Daya',
    'labels.entities.pages' => 'Halaman',
    'labels.entities.widgets' => 'Widget',
    'labels.entities.custom_permissions' => 'Kustom Permission',
    'labels.entities.custom_permissions.message' => 'Tab adalah ',
    'labels.status.enabled' => 'Aktifkan',
    'labels.status.disabled' => 'Non Aktifkan',
    'labels.status.yes' => 'Ya',
    'labels.status.no' => 'Tidak',
    'labels.exclude.placeholder' => 'Mode Pengecualian',
    'labels.exclude.message' => 'Dengan mengaktifkan mode pengecualian, generator izin batal membuat izin untuk entitas yang kamu pilih.',
    'labels.exclude.resources' => 'Sumber Daya',
    'labels.exclude.resources.placeholder' => 'Pilih sumber daya ...',
    'labels.exclude.pages' => 'Halaman',
    'labels.exclude.pages.placeholder' => 'Pilih halaman ...',
    'labels.exclude.widgets' => 'Widget',
    'labels.exclude.widgets.placeholder' => 'Pilih widget ...',

    /**
     * Messages
     */
    'forbidden' => 'Kamu tidak punya izin akses',
    'update' => 'Pengaturan Shield Sudah Diperbarui!',
    'generate' => 'Pengaturan Shield Sudah Diperbarui & Izin Telat Dibuat Tanpa Policy!',
];
