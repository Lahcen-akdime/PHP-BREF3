<?php
require_once "config.php";
require_once "equipe.php";
$teamClass = new equipe($connection);
$GLOBALS['teams'] = $teamClass -> affichage() ;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Sports Management System</title>
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
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
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

            th, td {
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
</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo">⚽ Sports Manager</div>
            <div class="admin-user">
                <div class="admin-badge">A</div>
                <div>Administrator</div>
            </div>
        </div>
    </header>

    <div class="container">
        <!-- Navigation Tabs -->
        <div class="nav-tabs">
            <button class="nav-tab active" data-module="roster">👥 Roster Management</button>
            <button class="nav-tab" data-module="teams">🏢 Team Management</button>
            <button class="nav-tab" data-module="contracts">📋 Contract Control</button>
            <button class="nav-tab" data-module="transactions">💰 Transactions</button>
        </div>

        <!-- Module 1: Roster Management -->
        <div class="module active" id="roster">
            <div class="module-header">
                <div class="module-title">
                    <div class="module-icon">👥</div>
                    Gestion du Roster (Joueurs & Coachs)
                </div>
                <a href="formulaireDajoute.php/joueurForm.php"><button class="btn-new">+ Ajouter un joueur</button></a>
                <a href="formulaireDajoute.php/coachForm.php"><button class="btn-new">+ Ajouter un coach</button></a>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-label">Total Players</div>
                    <div class="stat-value">47</div>
                    <div class="stat-change">↑ 3 this month</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Active Coaches</div>
                    <div class="stat-value">8</div>
                    <div class="stat-change">↑ 1 this month</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">New Recruits</div>
                    <div class="stat-value">5</div>
                    <div class="stat-change">Pending verification</div>
                </div>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Position</th>
                            <th>Status</th>
                            <th>Jersey</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Marcus Johnson</td>
                            <td>Player</td>
                            <td>Forward</td>
                            <td><span class="status-badge status-active">Active</span></td>
                            <td>#23</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action">Edit</button>
                                    <button class="btn-action btn-delete">Delete</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Sarah Williams</td>
                            <td>Coach</td>
                            <td>Head Coach</td>
                            <td><span class="status-badge status-active">Active</span></td>
                            <td>-</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action">Edit</button>
                                    <button class="btn-action btn-delete">Delete</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>David Brown</td>
                            <td>Player</td>
                            <td>Guard</td>
                            <td><span class="status-badge status-active">Active</span></td>
                            <td>#5</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action">Edit</button>
                                    <button class="btn-action btn-delete">Delete</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Elena Rodriguez</td>
                            <td>Player</td>
                            <td>Center</td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td>#15</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action">Edit</button>
                                    <button class="btn-action btn-delete">Delete</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>James Patterson</td>
                            <td>Coach</td>
                            <td>Assistant Coach</td>
                            <td><span class="status-badge status-active">Active</span></td>
                            <td>-</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action">Edit</button>
                                    <button class="btn-action btn-delete">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="pagination">
                    <div class="pagination-info">Showing 1-5 of 47 members</div>
                    <div class="pagination-controls">
                        <button class="btn-page" onclick="prevPage('roster')">← Prev</button>
                        <button class="btn-page active">1</button>
                        <button class="btn-page">2</button>
                        <button class="btn-page">3</button>
                        <button class="btn-page" onclick="nextPage('roster')">Next →</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Module 2: Team Management -->
        <div class="module" id="teams">
            <div class="module-header">
                <div class="module-title">
                    <div class="module-icon">🏢</div>
                    Management des Équipes
                </div>
                <a href="formulaireDajoute.php/equipeForm.php"><button class="btn-new">+ Créer Équipe</button></a>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-label">Total Teams</div>
                    <div class="stat-value">6</div>
                    <div class="stat-change">All active</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Total Budget</div>
                    <div class="stat-value">$12.5M</div>
                    <div class="stat-change">↓ $500K available</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Avg Team Size</div>
                    <div class="stat-value">9</div>
                    <div class="stat-change">Members per team</div>
                </div>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Team Name</th>
                            <th>Manager</th>
                            <th>Budget</th>
                            <!-- <th>Members</th> -->
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($GLOBALS['teams'] as $key ) {
                            echo "<tr>
                                <td>$key[name]</td>
                                <td>$key[manager_name]</td>
                                <td>$key[budget]</td>
                                <td><span class='status-badge status-active'>Active</span></td>
                                <td>
                                    <div class='action-buttons'>
                                        <button class='btn-action'>Edit</button>
                                        <button class='btn-action btn-delete'>Delete</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <div class="pagination">
                    <div class="pagination-info">Showing 1-5 of 6 teams</div>
                    <div class="pagination-controls">
                        <button class="btn-page" onclick="prevPage('teams')">← Prev</button>
                        <button class="btn-page active">1</button>
                        <button class="btn-page" onclick="nextPage('teams')">Next →</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Module 3: Contract Control -->
        <div class="module" id="contracts">
            <div class="module-header">
                <div class="module-title">
                    <div class="module-icon">📋</div>
                    Contrôle Contractuel
                </div>
                <button class="btn-new">+ Générer Contrat</button>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-label">Total Contracts</div>
                    <div class="stat-value">47</div>
                    <div class="stat-change">All verified</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Expiring Soon</div>
                    <div class="stat-value">8</div>
                    <div class="stat-change">Within 3 months</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Locked Fields</div>
                    <div class="stat-value">100%</div>
                    <div class="stat-change">Start dates secured</div>
                </div>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Contract ID</th>
                            <th>Player/Staff</th>
                            <th>Team</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>CNT-2024-001</td>
                            <td>Marcus Johnson</td>
                            <td>Elite Warriors</td>
                            <td>2024-01-15</td>
                            <td>2025-12-31</td>
                            <td><span class="status-badge status-active">Active</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action">View</button>
                                    <button class="btn-action btn-delete">Revoke</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>CNT-2024-002</td>
                            <td>Sarah Williams</td>
                            <td>Elite Warriors</td>
                            <td>2023-06-01</td>
                            <td>2025-06-01</td>
                            <td><span class="status-badge status-pending">Expiring</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action">View</button>
                                    <button class="btn-action btn-delete">Revoke</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>CNT-2024-003</td>
                            <td>David Brown</td>
                            <td>Phoenix Rising</td>
                            <td>2024-03-20</td>
                            <td>2026-03-20</td>
                            <td><span class="status-badge status-active">Active</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action">View</button>
                                    <button class="btn-action btn-delete">Revoke</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>CNT-2024-004</td>
                            <td>Elena Rodriguez</td>
                            <td>Dragon's Pride</td>
                            <td>2024-07-10</td>
                            <td>2025-07-10</td>
                            <td><span class="status-badge status-active">Active</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action">View</button>
                                    <button class="btn-action btn-delete">Revoke</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>CNT-2024-005</td>
                            <td>James Patterson</td>
                            <td>Phoenix Rising</td>
                            <td>2023-09-01</td>
                            <td>2025-09-01</td>
                            <td><span class="status-badge status-pending">Expiring</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action">View</button>
                                    <button class="btn-action btn-delete">Revoke</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="pagination">
                    <div class="pagination-info">Showing 1-5 of 47 contracts</div>
                    <div class="pagination-controls">
                        <button class="btn-page" onclick="prevPage('contracts')">← Prev</button>
                        <button class="btn-page active">1</button>
                        <button class="btn-page">2</button>
                        <button class="btn-page">3</button>
                        <button class="btn-page" onclick="nextPage('contracts')">Next →</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Module 4: Transactions -->
        <div class="module" id="transactions">
            <div class="module-header">
                <div class="module-title">
                    <div class="module-icon">💰</div>
                    Exécution des Transactions
                </div>
                <button class="btn-new">+ Déclencher Transfert</button>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-label">Total Transfers</div>
                    <div class="stat-value">23</div>
                    <div class="stat-change">This season</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Total Volume</div>
                    <div class="stat-value">$8.7M</div>
                    <div class="stat-change">Processed</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Failed Transfers</div>
                    <div class="stat-value">0</div>
                    <div class="stat-change">Zero failures</div>
                </div>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Player</th>
                            <th>From Team</th>
                            <th>To Team</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>TXN-001</td>
                            <td>Marcus Johnson</td>
                            <td>Phoenix Rising</td>
                            <td>Elite Warriors</td>
                            <td>$450,000</td>
                            <td><span class="status-badge status-active">Completed</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action">View</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>TXN-002</td>
                            <td>David Brown</td>
                            <td>Dragon's Pride</td>
                            <td>Phoenix Rising</td>
                            <td>$380,000</td>
                            <td><span class="status-badge status-active">Completed</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action">View</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>TXN-003</td>
                            <td>Elena Rodriguez</td>
                            <td>Thunder Force</td>
                            <td>Dragon's Pride</td>
                            <td>$520,000</td>
                            <td><span class="status-badge status-active">Completed</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action">View</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>TXN-004</td>
                            <td>James Patterson</td>
                            <td>Inferno Squad</td>
                            <td>Elite Warriors</td>
                            <td>$290,000</td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action">View</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>TXN-005</td>
                            <td>Lisa Anderson</td>
                            <td>Thunder Force</td>
                            <td>Phoenix Rising</td>
                            <td>$410,000</td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action">View</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="pagination">
                    <div class="pagination-info">Showing 1-5 of 23 transactions</div>
                    <div class="pagination-controls">
                        <button class="btn-page" onclick="prevPage('transactions')">← Prev</button>
                        <button class="btn-page active">1</button>
                        <button class="btn-page">2</button>
                        <button class="btn-page" onclick="nextPage('transactions')">Next →</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tab Navigation
        document.querySelectorAll('.nav-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                const moduleId = this.getAttribute('data-module');
                
                // Remove active class from all tabs and modules
                document.querySelectorAll('.nav-tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.module').forEach(m => m.classList.remove('active'));
                
                // Add active class to clicked tab and corresponding module
                this.classList.add('active');
                document.getElementById(moduleId).classList.add('active');
            });
        });

        // Pagination functions
        function prevPage(module) {
            alert(`Navigate to previous page for ${module} module`);
        }

        function nextPage(module) {
            alert(`Navigate to next page for ${module} module`);
        }
    </script>
</body>
</html>
