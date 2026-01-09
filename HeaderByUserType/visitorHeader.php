<?php
use Classes\transfert;
use Classes\Formatter;
use Classes\database;
use Classes\contract;
use Classes\equipe;
use Classes\joueur;
use Classes\coach;
use Classes\join;
require_once "..\AutoLoading\autoloading.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Management - Public Portal</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #e2e8f0;
            min-height: 100vh;
        }

        header {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(34, 197, 194, 0.2);
            padding: 1.5rem 2rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #22c55e;
        }

        .badge {
            background: rgba(34, 197, 194, 0.2);
            color: #06b6d4;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.875rem;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        .tabs {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            border-bottom: 1px solid rgba(34, 197, 194, 0.2);
        }

        .tab-btn {
            padding: 1rem 1.5rem;
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            font-size: 1rem;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
        }

        .tab-btn.active {
            color: #06b6d4;
            border-bottom-color: #06b6d4;
        }

        .tab-btn:hover {
            color: #06b6d4;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .search-bar {
            margin-bottom: 2rem;
            display: flex;
            gap: 1rem;
        }

        .search-input {
            flex: 1;
            padding: 0.75rem 1.5rem;
            background: rgba(30, 41, 59, 0.6);
            border: 1px solid rgba(34, 197, 194, 0.3);
            border-radius: 8px;
            color: #e2e8f0;
            font-size: 1rem;
        }

        .search-input::placeholder {
            color: #64748b;
        }

        .search-input:focus {
            outline: none;
            border-color: #06b6d4;
            background: rgba(30, 41, 59, 0.8);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: rgba(30, 41, 59, 0.6);
            border: 1px solid rgba(34, 197, 194, 0.2);
            border-radius: 8px;
            padding: 1.5rem;
        }

        .stat-label {
            color: #94a3b8;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            color: #06b6d4;
        }

        .table-container {
            background: rgba(30, 41, 59, 0.6);
            border: 1px solid rgba(34, 197, 194, 0.2);
            border-radius: 8px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: rgba(15, 23, 42, 0.6);
            border-bottom: 2px solid rgba(34, 197, 194, 0.2);
        }

        th {
            padding: 1rem;
            text-align: left;
            color: #06b6d4;
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
        }

        td {
            padding: 1rem;
            border-bottom: 1px solid rgba(34, 197, 194, 0.1);
        }

        tbody tr {
            transition: background-color 0.3s ease;
        }

        tbody tr:hover {
            background: rgba(34, 197, 194, 0.1);
        }

        .player-name {
            font-weight: 600;
            color: #e2e8f0;
        }

        .team-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: rgba(34, 197, 194, 0.15);
            color: #06b6d4;
            border-radius: 4px;
            font-size: 0.875rem;
        }

        .profile-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .profile-modal.active {
            display: flex;
        }

        .modal-content {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border: 1px solid rgba(34, 197, 194, 0.3);
            border-radius: 12px;
            padding: 2rem;
            max-width: 500px;
            width: 90%;
        }

        .close-modal {
            background: none;
            border: none;
            color: #94a3b8;
            font-size: 1.5rem;
            cursor: pointer;
            float: right;
        }

        .close-modal:hover {
            color: #06b6d4;
        }

        .profile-info {
            margin-top: 1rem;
            clear: both;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(34, 197, 194, 0.1);
        }

        .info-label {
            color: #94a3b8;
            font-weight: 600;
        }

        .info-value {
            color: #e2e8f0;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .pagination button {
            padding: 0.5rem 0.75rem;
            background: rgba(30, 41, 59, 0.6);
            border: 1px solid rgba(34, 197, 194, 0.2);
            color: #e2e8f0;
            cursor: pointer;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .pagination button.active {
            background: rgba(6, 182, 212, 0.3);
            border-color: #06b6d4;
            color: #06b6d4;
        }

        .pagination button:hover:not(.active) {
            border-color: #06b6d4;
            color: #06b6d4;
        }

        .no-results {
            text-align: center;
            padding: 2rem;
            color: #94a3b8;
        }

        .action-btn {
            padding: 0.5rem 1rem;
            background: rgba(34, 197, 194, 0.2);
            border: 1px solid rgba(34, 197, 194, 0.4);
            color: #06b6d4;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }

        .action-btn:hover {
            background: rgba(34, 197, 194, 0.4);
            color: #fff;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo">⚽ Sports Management</div>
            <div class="badge">👁️ Visitor - Read Only</div>
            <a href="../login_logout/logout.php" style="color:aliceblue" class="admin-user">
                    <div>Log out</div>
        </a>
        </div>
    </header>