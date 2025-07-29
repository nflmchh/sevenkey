<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="format-detection" content="telephone=no">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">

    <title>@yield('title', 'SevenKey - Business Management System')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            /* Primary Colors - Inspired by Metronic */
            --bs-primary: #1b84ff;
            --bs-primary-rgb: 27, 132, 255;
            --bs-primary-hover: #0f6fdf;
            --bs-primary-active: #0d5cbd;
            
            /* Secondary Colors */
            --bs-secondary: #6c757d;
            --bs-secondary-rgb: 108, 117, 125;
            
            /* Success Colors */
            --bs-success: #17c653;
            --bs-success-rgb: 23, 198, 83;
            
            /* Warning Colors */
            --bs-warning: #ffc700;
            --bs-warning-rgb: 255, 199, 0;
            
            /* Danger Colors */
            --bs-danger: #f1416c;
            --bs-danger-rgb: 241, 65, 108;
            
            /* Info Colors */
            --bs-info: #7239ea;
            --bs-info-rgb: 114, 57, 234;
            
            /* Dark Colors */
            --bs-dark: #181c32;
            --bs-dark-rgb: 24, 28, 50;
            
            /* Light Colors */
            --bs-light: #f5f8fa;
            --bs-light-rgb: 245, 248, 250;
            
            /* Body Colors */
            --bs-body-color: #3f4254;
            --bs-body-bg: #f5f8fa;
            
            /* Border Colors */
            --bs-border-color: #e4e6ef;
            --bs-border-color-translucent: rgba(228, 230, 239, 0.75);
            
            /* Sidebar Colors */
            --sidebar-bg: #1e2129;
            --sidebar-hover: #2a2d3a;
            --sidebar-active: var(--bs-primary);
            --sidebar-text: #a1a5b7;
            --sidebar-text-active: #ffffff;
            
            /* Card Colors */
            --card-bg: #ffffff;
            --card-border: #e4e6ef;
            --card-shadow: 0 0.5rem 1.5rem 0.5rem rgba(0, 0, 0, 0.075);
            
            /* Typography */
            --font-family-sans-serif: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            --font-weight-normal: 400;
            --font-weight-medium: 500;
            --font-weight-semibold: 600;
            --font-weight-bold: 700;
            --font-weight-bolder: 800;
        }

        /* Global Typography */
        body {
            font-family: var(--font-family-sans-serif);
            font-weight: var(--font-weight-normal);
            color: var(--bs-body-color);
            background-color: var(--bs-body-bg);
            line-height: 1.6;
        }

        /* Custom Bootstrap Variables Override */
        .btn-primary {
            background-color: var(--bs-primary);
            border-color: var(--bs-primary);
            font-weight: var(--font-weight-medium);
            padding: 0.75rem 1.5rem;
            border-radius: 0.475rem;
            transition: all 0.15s ease-in-out;
        }

        .btn-primary:hover {
            background-color: var(--bs-primary-hover);
            border-color: var(--bs-primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(var(--bs-primary-rgb), 0.3);
        }

        .btn-primary:active {
            background-color: var(--bs-primary-active);
            border-color: var(--bs-primary-active);
            transform: translateY(0);
        }

        .btn-secondary {
            background-color: var(--bs-secondary);
            border-color: var(--bs-secondary);
            color: #ffffff;
            font-weight: var(--font-weight-medium);
        }

        .btn-success {
            background-color: var(--bs-success);
            border-color: var(--bs-success);
        }

        .btn-warning {
            background-color: var(--bs-warning);
            border-color: var(--bs-warning);
            color: #1f2937;
        }

        .btn-danger {
            background-color: var(--bs-danger);
            border-color: var(--bs-danger);
        }

        .btn-info {
            background-color: var(--bs-info);
            border-color: var(--bs-info);
        }

        /* Card Styling */
        .card {
            background-color: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 0.75rem;
            box-shadow: var(--card-shadow);
            transition: all 0.15s ease-in-out;
        }

        .card:hover {
            box-shadow: 0 0.5rem 2rem 0.5rem rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .card-header {
            background-color: transparent;
            border-bottom: 1px solid var(--bs-border-color);
            padding: 1.5rem 1.5rem 1rem;
            font-weight: var(--font-weight-semibold);
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Form Controls */
        .form-control {
            border: 1px solid var(--bs-border-color);
            border-radius: 0.475rem;
            padding: 0.75rem 1rem;
            font-weight: var(--font-weight-normal);
            transition: all 0.15s ease-in-out;
        }

        .form-control:focus {
            border-color: var(--bs-primary);
            box-shadow: 0 0 0 0.25rem rgba(var(--bs-primary-rgb), 0.15);
        }

        .form-select {
            border: 1px solid var(--bs-border-color);
            border-radius: 0.475rem;
            padding: 0.75rem 1rem;
        }

        .form-select:focus {
            border-color: var(--bs-primary);
            box-shadow: 0 0 0 0.25rem rgba(var(--bs-primary-rgb), 0.15);
        }

        .form-label {
            font-weight: var(--font-weight-medium);
            color: var(--bs-body-color);
            margin-bottom: 0.5rem;
        }

        /* Alert Styling */
        .alert {
            border: none;
            border-radius: 0.75rem;
            padding: 1rem 1.5rem;
            font-weight: var(--font-weight-medium);
        }

        .alert-success {
            background-color: rgba(var(--bs-success-rgb), 0.1);
            color: var(--bs-success);
        }

        .alert-danger {
            background-color: rgba(var(--bs-danger-rgb), 0.1);
            color: var(--bs-danger);
        }

        .alert-warning {
            background-color: rgba(var(--bs-warning-rgb), 0.1);
            color: #b45309;
        }

        .alert-info {
            background-color: rgba(var(--bs-info-rgb), 0.1);
            color: var(--bs-info);
        }

        /* Badge Styling */
        .badge {
            font-weight: var(--font-weight-medium);
            padding: 0.5rem 0.75rem;
            border-radius: 0.425rem;
        }

        /* Table Styling */
        .table {
            --bs-table-bg: transparent;
        }

        .table thead th {
            font-weight: var(--font-weight-semibold);
            color: var(--bs-body-color);
            border-bottom: 1px solid var(--bs-border-color);
            padding: 1rem 0.75rem;
            background-color: var(--bs-light);
        }

        .table tbody td {
            padding: 1rem 0.75rem;
            border-bottom: 1px solid var(--bs-border-color);
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(var(--bs-primary-rgb), 0.05);
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bs-light);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--bs-border-color);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--bs-secondary);
        }

        /* Utility Classes */
        .text-primary {
            color: var(--bs-primary) !important;
        }

        .bg-primary {
            background-color: var(--bs-primary) !important;
        }

        .border-primary {
            border-color: var(--bs-primary) !important;
        }

        .fw-medium {
            font-weight: var(--font-weight-medium) !important;
        }

        .fw-semibold {
            font-weight: var(--font-weight-semibold) !important;
        }

        .fw-bolder {
            font-weight: var(--font-weight-bolder) !important;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .card {
                border-radius: 0.5rem;
            }
            
            .card-header,
            .card-body {
                padding: 1rem;
            }
            
            .btn {
                padding: 0.625rem 1.25rem;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    @yield('content')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>
