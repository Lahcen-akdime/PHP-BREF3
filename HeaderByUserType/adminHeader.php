<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Sports Management System</title>
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css"> -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
            background: linear-gradient(135deg, #0f0f0f 0%, #1a1a1a 100%);
            color: #e0e0e0;
            min-height: 100vh;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header */
        header {
            background: rgba(20, 20, 20, 0.8);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 20px 0;
            margin-bottom: 30px;
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(10px);
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            background: linear-gradient(135deg, #00d4ff 0%, #0099ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .admin-user {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 16px;
            background: rgba(0, 212, 255, 0.1);
            border-radius: 8px;
            border: 1px solid rgba(0, 212, 255, 0.3);
        }

        .admin-badge {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #00d4ff 0%, #0099ff 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #000;
            font-size: 14px;
        }

        /* Nav Tabs */
        .nav-tabs {
            display: flex;
            gap: 8px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 30px;
            overflow-x: auto;
            padding-bottom: 12px;
        }

        .nav-tab {
            padding: 12px 20px;
            background: none;
            border: none;
            color: #888;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 500;
            white-space: nowrap;
        }

        .nav-tab.active {
            color: #00d4ff;
            border-bottom-color: #00d4ff;
        }

        .nav-tab:hover {
            color: #e0e0e0;
        }

        /* Module Container */
        .module {
            display: none;
        }

        .module.active {
            display: block;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Module Header */
        .module-header {
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .module-title {
            font-size: 20px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .module-icon {
            width: 32px;
            height: 32px;
            background: rgba(0, 212, 255, 0.2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .btn-new {
            padding: 10px 16px;
            background: linear-gradient(135deg, #00d4ff 0%, #0099ff 100%);
            color: #000;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 13px;
            transition: all 0.3s ease;
        }

        .btn-new:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 212, 255, 0.3);
        }

        /* Table */
        .table-wrapper {
            background: rgba(20, 20, 20, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: rgba(0, 0, 0, 0.4);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        th {
            padding: 16px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            color: #00d4ff;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 14px 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 13px;
        }

        tbody tr {
            transition: all 0.2s ease;
        }

        tbody tr:hover {
            background: rgba(0, 212, 255, 0.05);
        }

        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-active {
            background: rgba(34, 197, 94, 0.2);
            color: #22c55e;
        }

        .status-pending {
            background: rgba(234, 179, 8, 0.2);
            color: #eab308;
        }

        .status-inactive {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 6px;
        }

        .btn-action {
            padding: 6px 10px;
            background: rgba(0, 212, 255, 0.1);
            border: 1px solid rgba(0, 212, 255, 0.3);
            color: #00d4ff;
            border-radius: 4px;
            cursor: pointer;
            font-size: 11px;
            transition: all 0.2s ease;
        }

        .btn-action:hover {
            background: rgba(0, 212, 255, 0.2);
        }

        .btn-delete {
            background: rgba(239, 68, 68, 0.1);
            border-color: rgba(239, 68, 68, 0.3);
            color: #ef4444;
        }

        .btn-delete:hover {
            background: rgba(239, 68, 68, 0.2);
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px;
            background: rgba(0, 0, 0, 0.2);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .pagination-info {
            font-size: 12px;
            color: #888;
        }

        .pagination-controls {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .btn-page {
            padding: 6px 12px;
            background: rgba(0, 212, 255, 0.1);
            border: 1px solid rgba(0, 212, 255, 0.3);
            color: #00d4ff;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.2s ease;
            min-width: 36px;
        }

        .btn-page:hover:not(:disabled) {
            background: rgba(0, 212, 255, 0.2);
        }

        .btn-page:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .btn-page.active {
            background: linear-gradient(135deg, #00d4ff 0%, #0099ff 100%);
            color: #000;
            border-color: #00d4ff;
        }

        .page-size {
            padding: 6px 10px;
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #e0e0e0;
            border-radius: 4px;
            font-size: 12px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: rgba(20, 20, 20, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            border-color: rgba(0, 212, 255, 0.3);
            box-shadow: 0 8px 24px rgba(0, 212, 255, 0.1);
        }

        .stat-label {
            font-size: 12px;
            color: #888;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .stat-value {
            font-size: 28px;
            font-weight: bold;
            color: #00d4ff;
        }

        .stat-change {
            font-size: 11px;
            color: #22c55e;
            margin-top: 8px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .module-header {
                flex-direction: column;
                gap: 12px;
            }

            .btn-new {
                width: 100%;
            }

            table {
                font-size: 12px;
            }

            th,
            td {
                padding: 8px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .nav-tabs {
                flex-wrap: wrap;
            }
        }
    </style>
    <script src="./jsonData/getData.js" defer></script>
</head>

<body>
    <header>
        <div class="header-content">
            <div class="logo">⚽ Sports Manager</div>
            <div class="admin-user">
                <div class="admin-badge">A</div>
                <div>Administrator</div>
                <a href="logout.php" style="color:aliceblue" class="admin-user">
                    <div>Log out</div>
                </a>
            </div>
        </div>
    </header>