<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Admin - Rumah BUMN Telkom Pekalongan')</title>
        <meta name="description" content="@yield('description', 'Panel Admin Rumah BUMN Telkom Pekalongan')">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- Base Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        
        <!-- Admin Booking Specific Styles -->
        <style>
        /* Admin Booking Styles */
        .admin-booking-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .admin-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 0;
            margin-bottom: 30px;
            border-radius: 15px;
        }

        .admin-header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            text-align: center;
        }

        .admin-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
        }

        .stat-icon.total { background: linear-gradient(135deg, #3498db, #2980b9); }
        .stat-icon.pending { background: linear-gradient(135deg, #f39c12, #e67e22); }
        .stat-icon.confirmed { background: linear-gradient(135deg, #27ae60, #229954); }
        .stat-icon.cancelled { background: linear-gradient(135deg, #e74c3c, #c0392b); }

        .stat-content h3 {
            margin: 0 0 5px 0;
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
        }

        .stat-content p {
            margin: 0;
            color: #6c757d;
            font-size: 14px;
        }

        .admin-table-container {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .admin-table-header {
            background: #f8f9fa;
            padding: 20px 25px;
            border-bottom: 1px solid #dee2e6;
        }

        .admin-table-header h2 {
            margin: 0;
            color: #2c3e50;
            font-size: 20px;
            font-weight: 600;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }

        .admin-table th {
            background: #f8f9fa;
            padding: 15px 20px;
            text-align: left;
            font-weight: 600;
            color: #2c3e50;
            border-bottom: 1px solid #dee2e6;
            font-size: 14px;
        }

        .admin-table td {
            padding: 15px 20px;
            border-bottom: 1px solid #f1f3f4;
            vertical-align: middle;
            font-size: 14px;
        }

        .admin-table tr:hover {
            background: #f8f9fa;
        }

        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-badge.pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-badge.confirmed {
            background: #d4edda;
            color: #155724;
        }

        .status-badge.cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn-action {
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 500;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .btn-view {
            background: #e3f2fd;
            color: #1976d2;
        }

        .btn-view:hover {
            background: #bbdefb;
            color: #1565c0;
        }

        .btn-edit {
            background: #fff3e0;
            color: #f57c00;
        }

        .btn-edit:hover {
            background: #ffe0b2;
            color: #ef6c00;
        }

        .btn-delete {
            background: #ffebee;
            color: #d32f2f;
        }

        .btn-delete:hover {
            background: #ffcdd2;
            color: #c62828;
        }

        .btn-confirm {
            background: #e8f5e8;
            color: #2e7d32;
        }

        .btn-confirm:hover {
            background: #c8e6c9;
            color: #1b5e20;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }

        .empty-state-icon {
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-state h3 {
            margin: 0 0 10px 0;
            color: #495057;
        }

        .empty-state p {
            margin: 0;
            font-size: 14px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .admin-booking-container {
                padding: 15px;
            }

            .admin-stats {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .admin-table-container {
                overflow-x: auto;
            }

            .admin-table {
                min-width: 600px;
            }

            .admin-header h1 {
                font-size: 24px;
            }

            .action-buttons {
                flex-direction: column;
                align-items: stretch;
            }
        }

        /* Booking Page Specific Styles for public users */
        .booking-info-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .info-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .info-card * {
            color: white !important;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
        }

        .info-icon {
            background: rgba(255, 255, 255, 0.2);
            padding: 12px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .info-content h3 {
            margin: 0 0 5px 0;
            font-size: 18px;
            font-weight: 600;
            color: white !important;
        }

        .info-content p {
            margin: 0;
            font-size: 14px;
            opacity: 0.9;
            color: white !important;
        }

        .rooms-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }

        .room-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #f0f0f0;
        }

        .room-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .room-image {
            position: relative;
            height: 200px;
            background: linear-gradient(45deg, #f0f2f5, #e9ecef);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .room-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .room-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 10px;
            color: #95a5a6;
            text-align: center;
        }

        .room-placeholder span {
            font-weight: 600;
            font-size: 16px;
        }

        .room-status {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .room-status.available {
            background: #d4edda;
            color: #155724;
        }

        .room-content {
            padding: 25px;
        }

        .room-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .room-header h3 {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            color: #2c3e50;
            line-height: 1.3;
        }

        .room-description {
            color: #6c757d;
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .room-details {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #6c757d;
        }

        .detail-item svg {
            color: #3498db;
        }

        .room-facilities h4 {
            margin: 0 0 10px 0;
            font-size: 14px;
            font-weight: 600;
            color: #2c3e50;
        }

        .facilities-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 20px;
        }

        .facility-tag {
            background: #ecf0f1;
            color: #2c3e50;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 500;
        }

        .facility-more {
            background: #3498db;
            color: white;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 500;
        }

        .room-actions {
            display: flex;
            gap: 10px;
        }

        .btn-book {
            flex: 1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-book:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
            text-decoration: none;
            color: white;
        }

        .btn-details {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            color: #6c757d;
            padding: 12px 16px;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .btn-details:hover {
            background: #e9ecef;
            color: #495057;
        }

        .no-rooms {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }

        .no-rooms-icon {
            margin-bottom: 20px;
        }

        .no-rooms h3 {
            margin: 0 0 10px 0;
            color: #495057;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(5px);
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            background: white;
            border-radius: 15px;
            width: 90%;
            max-width: 700px;
            max-height: 85vh;
            overflow-y: auto;
            animation: slideUp 0.3s ease;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        @keyframes slideUp {
            from { 
                transform: translateY(30px);
                opacity: 0;
            }
            to { 
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 25px;
            border-bottom: 1px solid #dee2e6;
        }

        .modal-header h3 {
            margin: 0;
            color: #2c3e50;
        }

        .modal-close {
            background: none;
            border: none;
            cursor: pointer;
            color: #6c757d;
        }

        .modal-body {
            padding: 25px;
        }

        .loading {
            text-align: center;
            padding: 40px;
            color: #6c757d;
        }
        </style>

        <!-- Additional Styles -->
        @stack('styles')
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div class="min-h-screen">
            <!-- Navigation (if needed for admin) -->
            @if(isset($includeNavigation) && $includeNavigation)
                @include('layouts.navigation')
            @endif

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        
        <!-- Additional Scripts -->
        @stack('scripts')
    </body>
</html>