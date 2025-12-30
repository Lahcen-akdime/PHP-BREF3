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
            </div>
        </div>

        <!-- Tabs -->
        <div class="tabs">
            <button class="tab-btn active" onclick="switchTab('transfers')">Transfer Tracking</button>
            <button class="tab-btn" onclick="switchTab('comparison')">Player Comparison</button>
            <button class="tab-btn" onclick="switchTab('news')">Private News Feed</button>
            <button class="tab-btn" onclick="switchTab('export')">Dynamic Filter</button>
        </div>

        <!-- Tab: Transfer Tracking -->
        <div id="transfers" class="tab-content active">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-label">Total Transfers</div>
                    <div class="stat-value">47</div>
                    <div class="stat-change">↑ 12 this month</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Total Investment</div>
                    <div class="stat-value">€2.3B</div>
                    <div class="stat-change">↑ 15% vs last period</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Avg Salary (Annual)</div>
                    <div class="stat-value">€2.8M</div>
                    <div class="stat-change">↑ 8% growth</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Active Buybacks</div>
                    <div class="stat-value">15</div>
                    <div class="stat-change">3 expiring soon</div>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Player</th>
                            <th>From → To</th>
                            <th>Transfer Fee</th>
                            <th>Annual Salary</th>
                            <th>Buyback Clause</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Kylian Mbappé</strong></td>
                            <td>PSG → Real Madrid</td>
                            <td>€180M</td>
                            <td class="salary-badge">€25M</td>
                            <td class="buyback-badge">€250M (3 years)</td>
                            <td><span class="transfer-badge">Completed</span></td>
                        </tr>
                        <tr>
                            <td><strong>Jude Bellingham</strong></td>
                            <td>Dortmund → Real Madrid</td>
                            <td>€103M</td>
                            <td class="salary-badge">€18M</td>
                            <td class="buyback-badge">€180M (2 years)</td>
                            <td><span class="transfer-badge">Active</span></td>
                        </tr>
                        <tr>
                            <td><strong>Luis Díaz</strong></td>
                            <td>Porto → Liverpool</td>
                            <td>€75M</td>
                            <td class="salary-badge">€12M</td>
                            <td class="buyback-badge">€120M (4 years)</td>
                            <td><span class="transfer-badge">Active</span></td>
                        </tr>
                        <tr>
                            <td><strong>Vinicius Jr</strong></td>
                            <td>Flamengo → Real Madrid</td>
                            <td>€45M</td>
                            <td class="salary-badge">€15M</td>
                            <td class="buyback-badge">€80M (5 years)</td>
                            <td><span class="transfer-badge">Active</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn">4</button>
                <button class="page-btn">→</button>
            </div>
        </div>

        <!-- Tab: Comparison Tool -->
        <div id="comparison" class="tab-content">
            <div style="margin-bottom: 20px;">
                <h2 style="color: #22c5ee; margin-bottom: 15px;">Annual Cost Comparison (Polymorphism)</h2>
                <p style="color: #94a3b8; font-size: 14px;">Compare annual costs across multiple players and coaches</p>
            </div>

            <div class="comparison-grid">
                <div class="comparison-card">
                    <div class="comparison-header">
                        <span>⚽</span>
                        Mbappé (Player)
                    </div>
                    <div class="comparison-metric">
                        <span class="metric-label">Salary</span>
                        <span class="metric-value">€25M</span>
                    </div>
                    <div class="comparison-metric">
                        <span class="metric-label">Benefits</span>
                        <span class="metric-value">€2.5M</span>
                    </div>
                    <div class="comparison-metric">
                        <span class="metric-label">Bonuses</span>
                        <span class="metric-value">€5M</span>
                    </div>
                    <div class="comparison-metric">
                        <span class="metric-label"><strong>Total Annual</strong></span>
                        <span class="metric-value"><strong>€32.5M</strong></span>
                    </div>
                </div>

                <div class="comparison-card">
                    <div class="comparison-header">
                        <span>⚽</span>
                        Bellingham (Player)
                    </div>
                    <div class="comparison-metric">
                        <span class="metric-label">Salary</span>
                        <span class="metric-value">€18M</span>
                    </div>
                    <div class="comparison-metric">
                        <span class="metric-label">Benefits</span>
                        <span class="metric-value">€1.8M</span>
                    </div>
                    <div class="comparison-metric">
                        <span class="metric-label">Bonuses</span>
                        <span class="metric-value">€3M</span>
                    </div>
                    <div class="comparison-metric">
                        <span class="metric-label"><strong>Total Annual</strong></span>
                        <span class="metric-value"><strong>€22.8M</strong></span>
                    </div>
                </div>

                <div class="comparison-card">
                    <div class="comparison-header">
                        <span>👨‍🏫</span>
                        Ancelotti (Coach)
                    </div>
                    <div class="comparison-metric">
                        <span class="metric-label">Base Salary</span>
                        <span class="metric-value">€12M</span>
                    </div>
                    <div class="comparison-metric">
                        <span class="metric-label">Bonus (Wins)</span>
                        <span class="metric-value">€3M</span>
                    </div>
                    <div class="comparison-metric">
                        <span class="metric-label">Title Bonus</span>
                        <span class="metric-value">€2M</span>
                    </div>
                    <div class="comparison-metric">
                        <span class="metric-label"><strong>Total Annual</strong></span>
                        <span class="metric-value"><strong>€17M</strong></span>
                    </div>
                </div>

                <div class="comparison-card">
                    <div class="comparison-header">
                        <span>⚽</span>
                        Díaz (Player)
                    </div>
                    <div class="comparison-metric">
                        <span class="metric-label">Salary</span>
                        <span class="metric-value">€12M</span>
                    </div>
                    <div class="comparison-metric">
                        <span class="metric-label">Benefits</span>
                        <span class="metric-value">€1.2M</span>
                    </div>
                    <div class="comparison-metric">
                        <span class="metric-label">Bonuses</span>
                        <span class="metric-value">€1.8M</span>
                    </div>
                    <div class="comparison-metric">
                        <span class="metric-label"><strong>Total Annual</strong></span>
                        <span class="metric-value"><strong>€15M</strong></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab: News Feed -->
        <div id="news" class="tab-content">
            <div style="margin-bottom: 20px;">
                <h2 style="color: #22c5ee; margin-bottom: 15px;">Private Transaction Log</h2>
                <p style="color: #94a3b8; font-size: 14px;">Chronological record of all system transactions</p>
            </div>

            <div class="news-feed">
                <div class="news-item">
                    <div class="news-date">2024-01-15 14:32:45</div>
                    <div class="news-title">Transfer Completed: Mbappé to Real Madrid</div>
                    <div class="news-desc">Financial transaction processed. Fee: €180M. Status: SUCCESS. Budget deducted from Real Madrid account. Contract generated with ID: CNT-2024-001.</div>
                </div>

                <div class="news-item">
                    <div class="news-date">2024-01-14 09:15:20</div>
                    <div class="news-title">Buyback Clause Activated: Vinicius Jr</div>
                    <div class="news-desc">Automatic trigger: Market value exceeded threshold. Clause value: €80M. Status: PENDING. Awaiting confirmation from Porto management.</div>
                </div>

                <div class="news-item">
                    <div class="news-date">2024-01-13 16:45:10</div>
                    <div class="news-title">Contract Generated: Bellingham New Terms</div>
                    <div class="news-desc">Contract ID: CNT-2024-002. Player: Jude Bellingham. Start Date: 2024-01-01 (readonly). Duration: 5 years. Salary: €18M annually.</div>
                </div>

                <div class="news-item">
                    <div class="news-date">2024-01-12 11:22:33</div>
                    <div class="news-title">Roster Updated: New Coach Added</div>
                    <div class="news-desc">Name: Carlo Ancelotti. Position: Head Coach. Experience: 25 years. Object created from Person abstract class. Inheritance: Coach → Person.</div>
                </div>

                <div class="news-item">
                    <div class="news-date">2024-01-11 08:50:15</div>
                    <div class="news-title">Salary Adjustment: Díaz Annual Review</div>
                    <div class="news-desc">Encapsulation method triggered: updateSalary(). New salary: €12M. Previous: €10.5M. Increase: 14.3%. Effective date: 2024-02-01.</div>
                </div>
            </div>

            <div class="pagination">
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn">→</button>
            </div>
        </div>

        <!-- Tab: Export / Dynamic Filter -->
        <div id="export" class="tab-content">
            <div style="margin-bottom: 20px;">
                <h2 style="color: #22c5ee; margin-bottom: 15px;">Dynamic Player Filter</h2>
                <p style="color: #94a3b8; font-size: 14px;">Filter players by market value in real-time (JavaScript)</p>
            </div>

            <div class="filter-section">
                <div class="filter-group">
                    <span class="filter-label">Market Value Range</span>
                    <input type="range" id="valueFilter" min="0" max="200" value="200" style="cursor: pointer;">
                </div>
                <div style="font-weight: 700; color: #22c5ee;">Max: €<span id="valueDisplay">200</span>M</div>
                <button class="export-btn" onclick="exportData()">📥 Export CSV</button>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Player Name</th>
                            <th>Position</th>
                            <th>Market Value</th>
                            <th>Current Salary</th>
                            <th>Annual Cost</th>
                            <th>ROI</th>
                        </tr>
                    </thead>
                    <tbody id="playerTable">
                        <tr class="player-row" data-value="180">
                            <td><strong>Kylian Mbappé</strong></td>
                            <td>Forward</td>
                            <td>€180M</td>
                            <td>€25M</td>
                            <td>€32.5M</td>
                            <td><span style="color: #4ade80;">+18%</span></td>
                        </tr>
                        <tr class="player-row" data-value="120">
                            <td><strong>Jude Bellingham</strong></td>
                            <td>Midfielder</td>
                            <td>€120M</td>
                            <td>€18M</td>
                            <td>€22.8M</td>
                            <td><span style="color: #4ade80;">+22%</span></td>
                        </tr>
                        <tr class="player-row" data-value="95">
                            <td><strong>Vinicius Jr</strong></td>
                            <td>Forward</td>
                            <td>€95M</td>
                            <td>€15M</td>
                            <td>€18.5M</td>
                            <td><span style="color: #4ade80;">+25%</span></td>
                        </tr>
                        <tr class="player-row" data-value="85">
                            <td><strong>Luis Díaz</strong></td>
                            <td>Winger</td>
                            <td>€85M</td>
                            <td>€12M</td>
                            <td>€15M</td>
                            <td><span style="color: #4ade80;">+28%</span></td>
                        </tr>
                        <tr class="player-row" data-value="75">
                            <td><strong>Florian Wirtz</strong></td>
                            <td>Winger</td>
                            <td>€75M</td>
                            <td>€10M</td>
                            <td>€12.5M</td>
                            <td><span style="color: #4ade80;">+25%</span></td>
                        </tr>
                        <tr class="player-row" data-value="70">
                            <td><strong>Foden</strong></td>
                            <td>Midfielder</td>
                            <td>€70M</td>
                            <td>€9M</td>
                            <td>€11.2M</td>
                            <td><span style="color: #4ade80;">+24%</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">→</button>
            </div>
        </div>
    </div>

    <script>
        // Tab Switching
        function switchTab(tabName) {
            const contents = document.querySelectorAll('.tab-content');
            const buttons = document.querySelectorAll('.tab-btn');

            contents.forEach(content => content.classList.remove('active'));
            buttons.forEach(btn => btn.classList.remove('active'));

            document.getElementById(tabName).classList.add('active');
            event.target.classList.add('active');
        }

        // Dynamic Filter
        const valueFilter = document.getElementById('valueFilter');
        const valueDisplay = document.getElementById('valueDisplay');
        const playerRows = document.querySelectorAll('.player-row');

        valueFilter.addEventListener('input', (e) => {
            const maxValue = parseInt(e.target.value);
            valueDisplay.textContent = maxValue;

            playerRows.forEach(row => {
                const playerValue = parseInt(row.getAttribute('data-value'));
                if (playerValue <= maxValue) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Export Function
        function exportData() {
            const visibleRows = Array.from(playerRows).filter(row => row.style.display !== 'none');
            
            let csv = 'Player Name,Position,Market Value,Current Salary,Annual Cost,ROI\n';
            
            visibleRows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const rowData = Array.from(cells).slice(0, 6).map(cell => `"${cell.textContent.trim()}"`).join(',');
                csv += rowData + '\n';
            });

            const blob = new Blob([csv], { type: 'text/csv' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `players-export-${new Date().toISOString().split('T')[0]}.csv`;
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
            document.body.removeChild(a);
        }
    </script>
</body>
</html>
