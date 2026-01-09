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
$connection = database::getconnection();
$teamClass = new equipe($connection);
$Allteams = $teamClass->affichage();
$contratClass = new contract();
$joueurClass = new joueur();
$coachClass = new coach ();
$transfertClass = new transfert($joueurClass,$coachClass,$contratClass,$teamClass);
$joinClass = new join($connection);
$formatterClass = new Formatter();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Journalist Dashboard - Transfer Analytics</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1a1f3a 100%);
            color: #e0e7ff;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Header */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
            padding: 20px;
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(34, 197, 238, 0.2);
            border-radius: 12px;
            backdrop-filter: blur(10px);
        }

        .header-title {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .header-title h1 {
            font-size: 28px;
            font-weight: 700;
            background: linear-gradient(135deg, #22c5ee, #3dd5f3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header-subtitle {
            font-size: 13px;
            color: #94a3b8;
        }

        .user-badge {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 20px;
            background: rgba(34, 197, 238, 0.1);
            border: 1px solid rgba(34, 197, 238, 0.3);
            border-radius: 8px;
        }

        .user-badge-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #22c5ee, #3dd5f3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #0f172a;
        }

        /* Tabs Navigation */
        .tabs {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            border-bottom: 1px solid rgba(34, 197, 238, 0.1);
            overflow-x: auto;
            padding-bottom: 15px;
        }

        .tab-btn {
            padding: 10px 20px;
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            white-space: nowrap;
            position: relative;
            transition: color 0.3s ease;
        }

        .tab-btn:hover {
            color: #22c5ee;
        }

        .tab-btn.active {
            color: #22c5ee;
        }

        .tab-btn.active::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, #22c5ee, #3dd5f3);
        }

        /* Tab Content */
        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            padding: 20px;
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(34, 197, 238, 0.2);
            border-radius: 12px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            border-color: rgba(34, 197, 238, 0.5);
            transform: translateY(-5px);
        }

        .stat-label {
            font-size: 13px;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #22c5ee;
        }

        .stat-change {
            font-size: 12px;
            color: #4ade80;
            margin-top: 8px;
        }

        /* Filter Section */
        .filter-section {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
            flex-wrap: wrap;
            align-items: center;
        }

        .filter-group {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .filter-label {
            font-size: 13px;
            font-weight: 600;
            color: #94a3b8;
            text-transform: uppercase;
        }

        select, input {
            padding: 10px 15px;
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(34, 197, 238, 0.3);
            border-radius: 8px;
            color: #e0e7ff;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        select:hover, input:hover {
            border-color: rgba(34, 197, 238, 0.6);
        }

        select:focus, input:focus {
            outline: none;
            border-color: #22c5ee;
            box-shadow: 0 0 0 3px rgba(34, 197, 238, 0.1);
        }

        /* Tables */
        .table-container {
            overflow-x: auto;
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(34, 197, 238, 0.2);
            border-radius: 12px;
            backdrop-filter: blur(10px);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: rgba(34, 197, 238, 0.1);
            border-bottom: 1px solid rgba(34, 197, 238, 0.2);
        }

        th {
            padding: 16px;
            text-align: left;
            font-size: 12px;
            font-weight: 700;
            color: #22c5ee;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 14px 16px;
            border-bottom: 1px solid rgba(34, 197, 238, 0.1);
            font-size: 14px;
        }

        tbody tr:hover {
            background: rgba(34, 197, 238, 0.05);
        }

        .transfer-badge {
            display: inline-block;
            padding: 6px 12px;
            background: rgba(34, 197, 238, 0.2);
            color: #22c5ee;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .salary-badge {
            color: #fbbf24;
        }

        .buyback-badge {
            color: #f87171;
        }

        /* News Feed */
        .news-feed {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .news-item {
            padding: 20px;
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(34, 197, 238, 0.2);
            border-radius: 12px;
            border-left: 4px solid #22c5ee;
            transition: all 0.3s ease;
        }

        .news-item:hover {
            border-color: rgba(34, 197, 238, 0.5);
            transform: translateX(5px);
        }

        .news-date {
            font-size: 12px;
            color: #94a3b8;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .news-title {
            font-size: 16px;
            font-weight: 700;
            color: #22c5ee;
            margin-bottom: 8px;
        }

        .news-desc {
            font-size: 14px;
            color: #cbd5e1;
            line-height: 1.5;
        }

        /* Comparison Grid */
        .comparison-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .comparison-card {
            padding: 20px;
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(34, 197, 238, 0.2);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .comparison-card:hover {
            border-color: rgba(34, 197, 238, 0.5);
            transform: translateY(-5px);
        }

        .comparison-header {
            font-size: 16px;
            font-weight: 700;
            color: #22c5ee;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .comparison-metric {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid rgba(34, 197, 238, 0.1);
            font-size: 14px;
        }

        .comparison-metric:last-child {
            border-bottom: none;
        }

        .metric-label {
            color: #94a3b8;
        }

        .metric-value {
            color: #22c5ee;
            font-weight: 700;
        }

        /* Pagination */
        .pagination {
            display: flex;
            gap: 8px;
            justify-content: center;
            margin-top: 25px;
        }

        .page-btn {
            padding: 10px 14px;
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(34, 197, 238, 0.2);
            color: #94a3b8;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .page-btn:hover {
            border-color: rgba(34, 197, 238, 0.5);
            color: #22c5ee;
        }

        .page-btn.active {
            background: linear-gradient(135deg, #22c5ee, #3dd5f3);
            border-color: #22c5ee;
            color: #0f172a;
        }

        /* Export Button */
        .export-btn {
            padding: 10px 20px;
            background: linear-gradient(135deg, #22c5ee, #3dd5f3);
            border: none;
            color: #0f172a;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .export-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(34, 197, 238, 0.2);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .header-title h1 {
                font-size: 22px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .filter-section {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-group {
                flex-direction: column;
            }

            table {
                font-size: 12px;
            }

            th, td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-title">
                <h1>Transfer Analytics Pro</h1>
                <span class="header-subtitle">Advanced Market Intelligence & Analysis</span>
            </div>
            <div class="user-badge">
                <div class="user-badge-icon">J</div>
                <div>
                    <div style="font-size: 14px; font-weight: 600;">Journalist</div>
                    <div style="font-size: 12px; color: #94a3b8;">Data Expert</div>
                </div>
                <a href="../login_logout/logout.php" style="color:aliceblue" class="admin-user">
                    <div>Log out</div>
        </a>
            </div>
        </div>