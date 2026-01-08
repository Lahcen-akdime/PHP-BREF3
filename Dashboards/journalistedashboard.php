<?php
session_start();
if($_SESSION['user']!="journaliste"){
    header("location:logout.php");
}
else{
    require_once "HeaderByUserType/journalistHeader.php";
}
?>
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
