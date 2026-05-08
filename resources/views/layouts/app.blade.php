<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Perpustakaan</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <style>
        /* ============================================
           CSS DESIGN SYSTEM - Modern Dashboard Premium
           ============================================ */

        :root {
            /* Color Palette */
            --primary: #4f46e5;
            --primary-light: #818cf8;
            --primary-dark: #3730a3;
            --secondary: #0ea5e9;
            --success: #10b981;
            --success-light: #d1fae5;
            --warning: #f59e0b;
            --warning-light: #fef3c7;
            --danger: #ef4444;
            --danger-light: #fee2e2;
            --info: #06b6d4;
            --info-light: #cffafe;

            /* Sidebar */
            --sidebar-bg: #0f172a;
            --sidebar-hover: #1e293b;
            --sidebar-active: #4f46e5;
            --sidebar-text: #94a3b8;
            --sidebar-text-active: #ffffff;
            --sidebar-width: 260px;

            /* Layout */
            --topbar-height: 65px;
            --body-bg: #f1f5f9;
            --card-bg: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --border-color: #e2e8f0;

            /* Shadows */
            --shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.07), 0 2px 4px -2px rgba(0,0,0,0.05);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.08), 0 4px 6px -4px rgba(0,0,0,0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.1), 0 8px 10px -6px rgba(0,0,0,0.05);

            /* Transitions */
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Dark Mode */
        [data-theme="dark"] {
            --body-bg: #0f172a;
            --card-bg: #1e293b;
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
            --text-muted: #64748b;
            --border-color: #334155;
            --sidebar-bg: #020617;
            --sidebar-hover: #0f172a;
        }

        /* ============ RESET & BASE ============ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--body-bg);
            color: var(--text-primary);
            overflow-x: hidden;
            transition: var(--transition);
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* ============ SIDEBAR ============ */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            z-index: 1000;
            transition: var(--transition);
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: var(--sidebar-hover);
            border-radius: 4px;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 20px 24px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }

        .sidebar-brand .brand-icon {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: white;
            flex-shrink: 0;
        }

        .sidebar-brand .brand-text {
            color: #fff;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: -0.3px;
        }

        .sidebar-brand .brand-sub {
            color: var(--sidebar-text);
            font-size: 11px;
            font-weight: 400;
        }

        .sidebar-menu {
            padding: 16px 12px;
        }

        .menu-label {
            color: var(--sidebar-text);
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            padding: 8px 16px 8px;
            margin-top: 8px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 16px;
            color: var(--sidebar-text);
            border-radius: 10px;
            margin-bottom: 2px;
            transition: var(--transition);
            font-size: 14px;
            font-weight: 500;
            position: relative;
        }

        .sidebar-link:hover {
            background: var(--sidebar-hover);
            color: var(--sidebar-text-active);
            transform: translateX(4px);
        }

        .sidebar-link.active {
            background: var(--sidebar-active);
            color: var(--sidebar-text-active);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4);
        }

        .sidebar-link .link-icon {
            width: 20px;
            text-align: center;
            font-size: 15px;
            flex-shrink: 0;
        }

        .sidebar-link .badge-notif {
            margin-left: auto;
            background: var(--danger);
            color: white;
            font-size: 10px;
            padding: 2px 7px;
            border-radius: 20px;
            font-weight: 600;
        }

        /* ============ MAIN CONTENT ============ */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: var(--transition);
        }

        /* ============ TOPBAR ============ */
        .topbar {
            height: var(--topbar-height);
            background: var(--card-bg);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .topbar-left .page-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .topbar-left .breadcrumb-text {
            font-size: 13px;
            color: var(--text-muted);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .topbar-btn {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            background: var(--card-bg);
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            position: relative;
        }

        .topbar-btn:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .topbar-btn .notif-dot {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 8px;
            height: 8px;
            background: var(--danger);
            border-radius: 50%;
            border: 2px solid var(--card-bg);
        }

        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 12px 6px 6px;
            border-radius: 12px;
            cursor: pointer;
            transition: var(--transition);
            border: 1px solid var(--border-color);
        }

        .user-dropdown:hover {
            background: var(--body-bg);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 14px;
        }

        .user-info .user-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .user-info .user-role {
            font-size: 11px;
            color: var(--text-muted);
        }

        /* ============ CONTENT AREA ============ */
        .content-area {
            padding: 28px;
        }

        /* ============ STAT CARDS ============ */
        .stat-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 24px;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            border-radius: 16px 16px 0 0;
        }

        .stat-card.blue::before { background: linear-gradient(90deg, #4f46e5, #818cf8); }
        .stat-card.green::before { background: linear-gradient(90deg, #10b981, #34d399); }
        .stat-card.yellow::before { background: linear-gradient(90deg, #f59e0b, #fbbf24); }
        .stat-card.red::before { background: linear-gradient(90deg, #ef4444, #f87171); }
        .stat-card.cyan::before { background: linear-gradient(90deg, #06b6d4, #22d3ee); }
        .stat-card.purple::before { background: linear-gradient(90deg, #8b5cf6, #a78bfa); }
        .stat-card.pink::before { background: linear-gradient(90deg, #ec4899, #f472b6); }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-xl);
        }

        .stat-card .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 16px;
        }

        .stat-card.blue .stat-icon { background: rgba(79,70,229,0.1); color: #4f46e5; }
        .stat-card.green .stat-icon { background: rgba(16,185,129,0.1); color: #10b981; }
        .stat-card.yellow .stat-icon { background: rgba(245,158,11,0.1); color: #f59e0b; }
        .stat-card.red .stat-icon { background: rgba(239,68,68,0.1); color: #ef4444; }
        .stat-card.cyan .stat-icon { background: rgba(6,182,212,0.1); color: #06b6d4; }
        .stat-card.purple .stat-icon { background: rgba(139,92,246,0.1); color: #8b5cf6; }
        .stat-card.pink .stat-icon { background: rgba(236,72,153,0.1); color: #ec4899; }

        .stat-card .stat-value {
            font-size: 28px;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 4px;
            color: var(--text-primary);
        }

        .stat-card .stat-label {
            font-size: 13px;
            color: var(--text-secondary);
            font-weight: 500;
        }

        /* ============ MODERN CARD ============ */
        .modern-card {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            transition: var(--transition);
            overflow: hidden;
        }

        .modern-card .card-header-custom {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modern-card .card-header-custom h5 {
            font-size: 16px;
            font-weight: 700;
            margin: 0;
            color: var(--text-primary);
        }

        .modern-card .card-body-custom {
            padding: 24px;
        }

        /* ============ MODERN TABLE ============ */
        .table-modern {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table-modern thead th {
            background: var(--body-bg);
            color: var(--text-secondary);
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            padding: 14px 16px;
            border-bottom: 1px solid var(--border-color);
            white-space: nowrap;
        }

        .table-modern tbody td {
            padding: 14px 16px;
            font-size: 14px;
            color: var(--text-primary);
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
            transition: var(--transition);
        }

        .table-modern tbody tr:hover td {
            background: rgba(79, 70, 229, 0.03);
        }

        .table-modern tbody tr:last-child td {
            border-bottom: none;
        }

        /* ============ BUTTONS ============ */
        .btn-modern {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-modern.btn-add {
            background: var(--success);
            color: white;
        }
        .btn-modern.btn-add:hover { background: #059669; color: white; }

        .btn-modern.btn-edit {
            background: var(--warning);
            color: white;
        }
        .btn-modern.btn-edit:hover { background: #d97706; color: white; }

        .btn-modern.btn-delete {
            background: var(--danger);
            color: white;
        }
        .btn-modern.btn-delete:hover { background: #dc2626; color: white; }

        .btn-modern.btn-detail {
            background: var(--info);
            color: white;
        }
        .btn-modern.btn-detail:hover { background: #0891b2; color: white; }

        .btn-modern.btn-primary-custom {
            background: var(--primary);
            color: white;
        }
        .btn-modern.btn-primary-custom:hover { background: var(--primary-dark); color: white; }

        .btn-modern.btn-return {
            background: linear-gradient(135deg, #10b981, #06b6d4);
            color: white;
        }
        .btn-modern.btn-return:hover { box-shadow: 0 4px 15px rgba(16,185,129,0.4); color: white; }

        .btn-sm-modern {
            padding: 6px 12px;
            font-size: 12px;
            border-radius: 8px;
        }

        /* ============ BADGES ============ */
        .badge-modern {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .badge-success { background: var(--success-light); color: #065f46; }
        .badge-warning { background: var(--warning-light); color: #92400e; }
        .badge-danger { background: var(--danger-light); color: #991b1b; }
        .badge-info { background: var(--info-light); color: #155e75; }
        .badge-primary { background: rgba(79,70,229,0.1); color: #4338ca; }

        /* ============ FORMS ============ */
        .form-modern {
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 10px 16px;
            font-size: 14px;
            transition: var(--transition);
            background: var(--card-bg);
            color: var(--text-primary);
            width: 100%;
        }

        .form-modern:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .form-label-modern {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 6px;
            display: block;
        }

        select.form-modern {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px 12px;
            padding-right: 40px;
        }

        /* ============ SEARCH BOX ============ */
        .search-box {
            position: relative;
            max-width: 320px;
        }

        .search-box input {
            padding-left: 42px;
        }

        .search-box .search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 14px;
        }

        /* ============ ALERTS ============ */
        .alert-modern {
            padding: 14px 20px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            animation: slideDown 0.4s ease;
            border: none;
        }

        .alert-modern.alert-success-modern {
            background: linear-gradient(135deg, rgba(16,185,129,0.1), rgba(6,182,212,0.05));
            color: #065f46;
            border-left: 4px solid var(--success);
        }

        .alert-modern.alert-danger-modern {
            background: linear-gradient(135deg, rgba(239,68,68,0.1), rgba(236,72,153,0.05));
            color: #991b1b;
            border-left: 4px solid var(--danger);
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ============ PAGINATION ============ */
        .pagination-modern {
            display: flex;
            gap: 4px;
            list-style: none;
            padding: 0;
            margin: 20px 0 0;
            justify-content: center;
        }

        .pagination-modern .page-item .page-link {
            min-width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-secondary);
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            transition: var(--transition);
            padding: 0 8px;
        }

        .pagination-modern .page-item .page-link:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .pagination-modern .page-item.active .page-link {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .pagination-modern .page-item.disabled .page-link {
            opacity: 0.4;
            pointer-events: none;
        }

        /* ============ LOADING SPINNER ============ */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
        }

        .loading-overlay.active {
            display: flex;
        }

        .spinner-modern {
            width: 50px;
            height: 50px;
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* ============ CUSTOM CONFIRM MODAL ============ */
        .confirm-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            z-index: 9998;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .confirm-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .confirm-modal {
            background: var(--surface);
            border-radius: 16px;
            padding: 32px;
            width: 90%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            transform: scale(0.9);
            transition: transform 0.3s ease;
            border: 1px solid var(--border-color);
        }

        .confirm-overlay.active .confirm-modal {
            transform: scale(1);
        }

        .confirm-icon {
            width: 64px;
            height: 64px;
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin: 0 auto 16px;
        }

        .confirm-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 8px;
        }

        .confirm-text {
            color: var(--text-muted);
            font-size: 14px;
            margin-bottom: 24px;
            line-height: 1.5;
        }

        .confirm-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
        }

        .btn-cancel-modal {
            padding: 10px 20px;
            border-radius: 8px;
            background: #e2e8f0;
            color: #475569;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            flex: 1;
        }

        .btn-cancel-modal:hover {
            background: #cbd5e1;
        }

        .btn-confirm-modal {
            padding: 10px 20px;
            border-radius: 8px;
            background: var(--danger);
            color: white;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            flex: 1;
        }

        .btn-confirm-modal:hover {
            background: #dc2626;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        /* ============ CUSTOM SUCCESS MODAL ============ */
        .success-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            z-index: 9998;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .success-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .success-modal {
            background: var(--surface);
            border-radius: 16px;
            padding: 32px;
            width: 90%;
            max-width: 350px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            transform: scale(0.9);
            transition: transform 0.3s ease;
            border: 1px solid var(--border-color);
        }

        .success-overlay.active .success-modal {
            transform: scale(1);
        }

        .success-icon {
            width: 64px;
            height: 64px;
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin: 0 auto 16px;
            animation: bounceIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @keyframes bounceIn {
            0% { transform: scale(0); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        .success-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 8px;
        }

        .success-text {
            color: var(--text-muted);
            font-size: 14px;
            margin-bottom: 24px;
            line-height: 1.5;
        }

        .btn-success-modal {
            padding: 10px 32px;
            border-radius: 8px;
            background: var(--success);
            color: white;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-block;
        }

        .btn-success-modal:hover {
            background: #059669;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        /* ============ RESPONSIVE ============ */
        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 20px;
            color: var(--text-primary);
            cursor: pointer;
        }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar-toggle {
                display: block;
            }

            .sidebar-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.5);
                z-index: 999;
                display: none;
            }

            .sidebar-overlay.show {
                display: block;
            }
        }

        /* ============ UTILITY ANIMATIONS ============ */
        .fade-in {
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .stagger-1 { animation-delay: 0.05s; }
        .stagger-2 { animation-delay: 0.1s; }
        .stagger-3 { animation-delay: 0.15s; }
        .stagger-4 { animation-delay: 0.2s; }
        .stagger-5 { animation-delay: 0.25s; }
        .stagger-6 { animation-delay: 0.3s; }
        .stagger-7 { animation-delay: 0.35s; }

        /* ============ EMPTY STATE ============ */
        .empty-state {
            text-align: center;
            padding: 48px 24px;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.3;
        }

        .empty-state p {
            font-size: 14px;
        }
    </style>
    @yield('styles')
</head>
<body>

<!-- Loading Spinner Overlay -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="spinner-modern"></div>
</div>

<!-- Custom Confirm Modal -->
<div class="confirm-overlay" id="customConfirmOverlay">
    <div class="confirm-modal">
        <div class="confirm-icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div class="confirm-title">Konfirmasi Hapus</div>
        <div class="confirm-text">Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.</div>
        <div class="confirm-actions">
            <button type="button" class="btn-cancel-modal" onclick="closeConfirmModal()">Batal</button>
            <button type="button" class="btn-confirm-modal" id="btnConfirmDelete">Ya, Hapus!</button>
        </div>
    </div>
</div>

<!-- Sidebar Overlay (Mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<!-- ============ SIDEBAR ============ -->
<aside class="sidebar" id="sidebar">
    <!-- Brand -->
    <div class="sidebar-brand">
        <img src="{{ asset('images/LibraSys.png') }}" alt="LibraSys Logo" style="width: 42px; height: 42px; object-fit: contain; flex-shrink: 0; border-radius: 8px; background: white; padding: 2px;">
        <div>
            <div class="brand-text">Perpustakaan</div>
            <div class="brand-sub">Sistem Manajemen</div>
        </div>
    </div>

    <!-- Menu -->
    <nav class="sidebar-menu">
        <div class="menu-label">Menu Utama</div>

        <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="link-icon"><i class="fas fa-th-large"></i></span>
            Dashboard
        </a>

        <div class="menu-label">Data Master</div>

        <a href="{{ route('siswas.index') }}" class="sidebar-link {{ request()->routeIs('siswas.*') ? 'active' : '' }}">
            <span class="link-icon"><i class="fas fa-user-graduate"></i></span>
            Siswa
        </a>

        <a href="{{ route('pengunjungs.index') }}" class="sidebar-link {{ request()->routeIs('pengunjungs.*') ? 'active' : '' }}">
            <span class="link-icon"><i class="fas fa-users"></i></span>
            Pengunjung
        </a>

        <a href="{{ route('bukus.index') }}" class="sidebar-link {{ request()->routeIs('bukus.*') ? 'active' : '' }}">
            <span class="link-icon"><i class="fas fa-book"></i></span>
            Buku
        </a>

        <div class="menu-label">Transaksi</div>

        <a href="{{ route('peminjamans.index') }}" class="sidebar-link {{ request()->routeIs('peminjamans.*') ? 'active' : '' }}">
            <span class="link-icon"><i class="fas fa-hand-holding-heart"></i></span>
            Peminjaman
            @php
                $pinjamAktif = \App\Models\Peminjaman::where('status','dipinjam')->count();
            @endphp
            @if($pinjamAktif > 0)
                <span class="badge-notif">{{ $pinjamAktif }}</span>
            @endif
        </a>

        <div class="menu-label">Pengaturan</div>

        <a href="{{ route('users.index') }}" class="sidebar-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
            <span class="link-icon"><i class="fas fa-cog"></i></span>
            Users
        </a>
    </nav>
</aside>

<!-- ============ MAIN CONTENT ============ -->
<div class="main-content">
    <!-- Topbar -->
    <header class="topbar">
        <div class="topbar-left">
            <button class="sidebar-toggle" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <div>
                <div class="page-title">@yield('title', 'Dashboard')</div>
                <div class="breadcrumb-text">@yield('breadcrumb', 'Sistem Perpustakaan')</div>
            </div>
        </div>

        <div class="topbar-right">
            <!-- Dark Mode Toggle -->
            <button class="topbar-btn" onclick="toggleDarkMode()" title="Toggle Dark Mode" id="darkModeBtn">
                <i class="fas fa-moon" id="darkModeIcon"></i>
            </button>

            <!-- Notifications -->
            <div class="dropdown">
                <button class="topbar-btn" title="Notifikasi" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                    <i class="fas fa-bell"></i>
                    @php
                        $unreadNotifications = auth()->check() ? auth()->user()->unreadNotifications : collect([]);
                    @endphp
                    @if($unreadNotifications->count() > 0)
                        <span class="notif-dot"></span>
                    @endif
                </button>
                <div class="dropdown-menu dropdown-menu-end" style="width: 320px; border-radius: 12px; border: 1px solid var(--border-color); box-shadow: var(--shadow-lg); padding: 0; overflow: hidden; z-index: 1050;">
                    <div style="padding: 16px; border-bottom: 1px solid var(--border-color); background: var(--body-bg); display: flex; justify-content: space-between; align-items: center;">
                        <h6 style="margin: 0; font-weight: 700; font-size: 14px;">Notifikasi Terbaru</h6>
                        <span class="badge badge-primary" style="background: rgba(79,70,229,0.1); color: #4f46e5; padding: 4px 8px; border-radius: 4px;">{{ $unreadNotifications->count() }} Baru</span>
                    </div>
                    <div style="max-height: 340px; overflow-y: auto;">
                        @forelse($unreadNotifications as $notification)
                            <a href="{{ route('notifications.read', $notification->id) }}" class="dropdown-item" style="padding: 16px; border-bottom: 1px solid var(--border-color); white-space: normal; transition: background 0.2s;">
                                <div style="display: flex; gap: 14px; align-items: flex-start;">
                                    <div style="width: 36px; height: 36px; border-radius: 50%; background: {{ $notification->data['color'] ?? 'var(--primary)' }}; display: flex; align-items: center; justify-content: center; color: white; flex-shrink: 0; font-size: 14px;">
                                        <i class="{{ $notification->data['icon'] ?? 'fas fa-bell' }}"></i>
                                    </div>
                                    <div style="flex-grow: 1;">
                                        <div style="font-size: 13px; font-weight: 700; color: var(--text-primary); margin-bottom: 3px;">{{ $notification->data['title'] ?? 'Notifikasi' }}</div>
                                        <div style="font-size: 12px; color: var(--text-secondary); line-height: 1.4;">{{ $notification->data['message'] ?? '' }}</div>
                                        <div style="font-size: 11px; color: var(--text-muted); margin-top: 6px;"><i class="far fa-clock me-1"></i>{{ $notification->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div style="padding: 40px 16px; text-align: center; color: var(--text-muted);">
                                <i class="far fa-bell-slash" style="font-size: 32px; margin-bottom: 12px; opacity: 0.3;"></i>
                                <div style="font-size: 13px;">Tidak ada notifikasi baru</div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- User Dropdown -->
            <div class="dropdown">
                <div class="user-dropdown" data-bs-toggle="dropdown">
                    @auth
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="user-info">
                        <div class="user-name">{{ Auth::user()->name }}</div>
                        <div class="user-role">{{ ucfirst(Auth::user()->role ?? 'Admin') }}</div>
                    </div>
                    @endauth
                    <i class="fas fa-chevron-down" style="font-size:10px; color:var(--text-muted);"></i>
                </div>
                <ul class="dropdown-menu dropdown-menu-end" style="border-radius:12px; border:1px solid var(--border-color); box-shadow:var(--shadow-lg); padding:8px;">
                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="#" class="dropdown-item" style="border-radius:8px; font-size:14px; padding:8px 16px;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Content Area -->
    <div class="content-area fade-in">
        <!-- Alert Messages -->
        @if(session('success'))
            <!-- Custom Success Modal -->
            <div class="success-overlay active" id="customSuccessOverlay">
                <div class="success-modal">
                    <div class="success-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="success-title">Berhasil!</div>
                    <div class="success-text">{{ session('success') }}</div>
                    <button type="button" class="btn-success-modal" onclick="document.getElementById('customSuccessOverlay').classList.remove('active')">Oke</button>
                </div>
            </div>
            <script>
                // Auto close success modal after 3.5 seconds
                setTimeout(() => {
                    const overlay = document.getElementById('customSuccessOverlay');
                    if (overlay) overlay.classList.remove('active');
                }, 3500);
            </script>
        @endif

        @if(session('error'))
            <div class="alert-modern alert-danger-modern" id="alertError">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
                <button onclick="this.parentElement.remove()" style="margin-left:auto; background:none; border:none; font-size:18px; cursor:pointer; color:inherit;">&times;</button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-modern alert-danger-modern">
                <i class="fas fa-exclamation-triangle"></i>
                <div>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        @yield('content')
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // ============ SIDEBAR TOGGLE ============
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('show');
        document.getElementById('sidebarOverlay').classList.toggle('show');
    }

    // ============ DARK MODE ============
    function toggleDarkMode() {
        const html = document.documentElement;
        const icon = document.getElementById('darkModeIcon');

        if (html.getAttribute('data-theme') === 'dark') {
            html.setAttribute('data-theme', 'light');
            icon.className = 'fas fa-moon';
            localStorage.setItem('theme', 'light');
        } else {
            html.setAttribute('data-theme', 'dark');
            icon.className = 'fas fa-sun';
            localStorage.setItem('theme', 'dark');
        }
    }

    // Load saved theme
    (function() {
        const saved = localStorage.getItem('theme');
        if (saved === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
            document.getElementById('darkModeIcon').className = 'fas fa-sun';
        }
    })();

    // ============ AUTO-DISMISS ALERTS ============
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert-modern');
        alerts.forEach(function(alert) {
            alert.style.transition = 'opacity 0.5s, transform 0.5s';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);

    // ============ LOADING SPINNER ============
    function showLoading() {
        document.getElementById('loadingOverlay').classList.add('active');
    }

    function hideLoading() {
        document.getElementById('loadingOverlay').classList.remove('active');
    }

    // ============ DELETE CONFIRMATION ============
    let formToSubmitId = null;

    function confirmDelete(formId) {
        formToSubmitId = formId;
        document.getElementById('customConfirmOverlay').classList.add('active');
    }

    function closeConfirmModal() {
        document.getElementById('customConfirmOverlay').classList.remove('active');
        formToSubmitId = null;
    }

    document.getElementById('btnConfirmDelete').addEventListener('click', function() {
        if (formToSubmitId) {
            document.getElementById('customConfirmOverlay').classList.remove('active');
            showLoading();
            document.getElementById(formToSubmitId).submit();
        }
    });

    // ============ GLOBAL FORM SUBMIT ============
    document.addEventListener('submit', function(e) {
        // Hanya tampilkan loading untuk form POST (Create/Update/Delete)
        // Abaikan method GET (seperti form pencarian)
        if (e.target.method && e.target.method.toUpperCase() === 'POST') {
            showLoading();

            // Sembunyikan loading jika request ternyata sangat lama/gagal di browser
            setTimeout(() => {
                hideLoading();
            }, 10000);
        }
    });

    // Sembunyikan loading saat user menekan tombol 'Back' di browser (BFCache)
    window.addEventListener('pageshow', function(e) {
        if (e.persisted) {
            hideLoading();
        }
    });
</script>

@yield('scripts')
</body>
</html>