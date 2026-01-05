<?php
require_once "config.php";
require_once "equipe.php";
require_once "joueur.php";
require_once "coach.php";
require_once "Formatter.php";
require_once "joinClass.php";
if (!$_SESSION['user'] == "admin") {
    header("location:logout.php");
} else {
    require_once "HeaderByUserType/adminHeader.php";
}
$allplayers = $joueurClass->read("joueur", $connection);
$allCoaches = $coachClass->read("coach", $connection);
?>
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
            <div style="display: flex; gap: 12px; margin-bottom: 20px; align-items: center; flex-wrap: wrap;">
                <label for="roster-filter" style="font-size: 13px; color: #888; text-transform: uppercase; font-weight: 600;">Filter by:</label>
                <select id="roster-filter" style="padding: 8px 12px; background: rgba(0, 0, 0, 0.4); border: 1px solid rgba(0, 212, 255, 0.3); color: #e0e0e0; border-radius: 6px; font-size: 13px; cursor: pointer; transition: all 0.2s ease; min-width: 150px;">
                    <option value="all">All Members</option>
                    <option value="player">Players</option>
                    <option value="coach">Coaches</option>
                </select>
                <a href="formulaireDajoute.php/joueurForm.php"><button class="btn-new">+ Ajouter un joueur</button></a>
                <a href="formulaireDajoute.php/coachForm.php"><button class="btn-new">+ Ajouter un coach</button></a>
                <input type="text" id="roster-search" placeholder="Search by name or email..." style="padding: 8px 12px; background: rgba(0, 0, 0, 0.4); border: 1px solid rgba(0, 212, 255, 0.3); color: #e0e0e0; border-radius: 6px; font-size: 13px; flex: 1; min-width: 200px; transition: all 0.2s ease;" />
            </div>
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
            <table id="datatableid">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>valeur_m</th>
                        <th>Cout</th>
                        <th>Actions</th>
                        <th>Joueur Equipe</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($allplayers as $key) { ?>
                        <tr>
                            <td><?= $key['name'] ?></td>
                            <td>Player</td>
                            <td><?= $key['role'] ?></td>
                            <td><span class="status-badge status-active">Active</span></td>
                            <td><?= $formatterClass->currency($key['valeur_m']) ?></td>
                            <td><?= $formatterClass->currency($joueurClass->getAnnualCost($key['id'], $connection)) ?></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action">Edit</button>
                                    <a href="delete.php?id=<?= $key['id'] ?>&table=joueur" class="btn-action btn-delete">Delete</a>
                                </div>
                            </td>
                            <td><?= $joinClass->equipename("joueur", $key['id']) ?></td>
                        </tr>
                </tbody>
            <?php } ?>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Style of coaching</th>
                    <th>Status</th>
                    <th>annes_ex</th>
                    <th>Cout</th>
                    <th>Actions</th>
                    <th>Coach Equipe</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($allCoaches as $key) { ?>
                    <tr>
                        <td><?= $key['name'] ?></td>
                        <td>Coach</td>
                        <td><?= $key['style_c'] ?></td>
                        <td><span class="status-badge status-active">Active</span></td>
                        <td><?= $key['annes_ex'] ?></td>
                        <td><?= $formatterClass->currency($coachClass->getAnnualCost($key['id'], $connection)) ?></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-action">Edit</button>
                                <a href="delete.php?id=<?= $key['id'] ?>&table=coach"></a><button class="btn-action btn-delete">Delete</button>
                            </div>
                        </td>
                        <td><?= $joinClass->equipename("coach", $key['id']) ?></td>
                    </tr>
                <?php } ?>
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
                    foreach ($GLOBALS['teams'] as $key) {
                        echo "<tr>
                                <td>$key[name]</td>
                                <td>$key[manager_name]</td>
                                <td>" . $formatterClass->currency($key['budget']) .  "<a href='budgetedit.php?id=$key[id]'><button class='btn-action'>Modifier</button></a></td>
                                <td><span class='status-badge status-active'>Active</span></td>
                                <td>
                                    <div class='action-buttons'>
                                        <button class='btn-action'>Edit</button>
                                        <a href='delete.php?id=$key[id]&table=equipe'><button class='btn-action btn-delete'>Delete</button></a>
                                        <a href='playersJoinList.php?id=$key[id]'><button class='btn-action'>Details</button></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>";
                    }
                    ?>
                </tbody>
            </table id="datatableid">
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
            <a href="./formulaireDajoute.php/transfertPlayerForm.php"><button class="btn-new">+ Déclencher a player Transfert</button></a>
            <a href="./formulaireDajoute.php/transfertCoachForm.php"><button class="btn-new">+ Déclencher a coach Transfert</button></a>
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
            <table id="datatableid">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Player</th>
                        <th>From Team</th>
                        <th>To Team</th>
                        <th>Price Total</th>
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
    // let select = document.getElementById("roster-filter");
    // let readSpace = document.getElementById("readSpace");
    // select.addEventListener("change", (e) => {
    //     console.log(select.value);
    // })
    let search = document.getElementById("roster-search");
    // let readSpace = document.getElementById("readSpace");
    search.addEventListener("change", (e) => {
        console.log(search.value);
    })
</script>
</body>

</html>